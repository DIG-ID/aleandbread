<?php
/**
 * Template functions for Ale and Bread theme.
 *
 * @package AleanBread
 */

/**
 * Event notices.
 *
 * @param string $message The message to display.
 * @return void
 */
function aab_event_meta_notice( string $message ): void {
	// Show notices only to users who can edit posts (admins/editors).
	if ( ! is_user_logged_in() || ! current_user_can( 'edit_posts' ) ) {
		return;
	}

	echo '<p class="text-sm mt-2 p-2 rounded bg-yellow-50 text-yellow-900 border border-yellow-200">';
	echo esc_html( $message );
	echo '</p>';
}

/**
 * Render event meta block.
 *
 * @param int|string|null $post_id Optional post ID.
 * @return void
 */
function aab_event_meta( $post_id = null ): void {
	$post_id = $post_id ?: get_the_ID();

	$theme_uri = get_stylesheet_directory_uri();

	$eds = get_field( 'events_cpt_event_date_start', $post_id, false );
	$ede = get_field( 'events_cpt_event_date_end', $post_id, false );
	$el  = get_field( 'events_cpt_place', $post_id );

	$dt_s = $eds ? DateTimeImmutable::createFromFormat( 'Y-m-d H:i:s', (string) $eds, wp_timezone() ) : null;
	$dt_e = $ede ? DateTimeImmutable::createFromFormat( 'Y-m-d H:i:s', (string) $ede, wp_timezone() ) : null;

	if ( ! $dt_s || ! $dt_e ) {
		aab_event_meta_notice( __( 'Veranstaltung: Start- und/oder Enddatum fehlt. Überprüfen Sie die Felder der Veranstaltung.', 'aleandbread' ) );
		return;
	}

	$fmt_time = get_option( 'time_format' );
	$fmt_date = get_option( 'date_format' );

	$ts_s = $dt_s->getTimestamp();
	$ts_e = $dt_e->getTimestamp();

	$time_html = wp_date( $fmt_time, $ts_s );

	/* translators: PHP date format for wp_date(). Start day when event spans multiple days (e.g. "12." or "12"). */
	$fmt_range_day = _x( 'j.', 'Event date format: range start day', 'aleandbread' );

	/* translators: PHP date format for wp_date(). Start date when range spans months within same year (e.g. "12. Dez" or "Dec 12"). */
	$fmt_range_day_month = _x( 'j. F', 'Event date format: range start day and month', 'aleandbread' );

	// Guard: if end is before start, clamp to start (bad data safety).
	if ( $dt_e < $dt_s ) {
		aab_event_meta_notice( __( 'Ereignis: Das Enddatum liegt vor dem Startdatum. Es wurde automatisch angepasst.', 'aleandbread' ) );
		$dt_e = $dt_s;
		$ts_e = $ts_s;
	}

	$date_html = '';

	$same_day   = $dt_s->format( 'Y-m-d' ) === $dt_e->format( 'Y-m-d' );
	$same_month = $dt_s->format( 'Y-m' ) === $dt_e->format( 'Y-m' );
	$same_year  = $dt_s->format( 'Y' ) === $dt_e->format( 'Y' );

	if ( $same_day ) {
		$date_html = wp_date( $fmt_date, $ts_s );
	} elseif ( $same_month ) {
		$date_html = wp_date( $fmt_range_day, $ts_s ) . ' - ' . wp_date( $fmt_date, $ts_e );
	} elseif ( $same_year ) {
		$date_html = wp_date( $fmt_range_day_month, $ts_s ) . ' - ' . wp_date( $fmt_date, $ts_e );
	} else {
		$date_html = wp_date( $fmt_date, $ts_s ) . ' - ' . wp_date( $fmt_date, $ts_e );
	}

	// NON-SINGLE: show only date.
	if ( ! is_singular( 'event' ) ) {
		if ( ! empty( $date_html ) ) {
			?>
			<div class="flex items-center gap-2">
				<img class="inline-block w-4 h-4" src="<?php echo esc_url( $theme_uri . '/assets/svgs/calendar.svg' ); ?>" alt="<?php echo esc_attr__( 'Calendar', 'aleandbread' ); ?>" />
				<span class="block-text-bold mb-0.5"><?php echo esc_html( $date_html ); ?></span>
			</div>
			<?php
		}
		return;
	}

	// SINGLE: show all info.
	?>

	<?php if ( ! empty( $time_html ) ) : ?>
		<div class="flex items-center gap-2">
			<img class="inline-block w-4 h-4" src="<?php echo esc_url( $theme_uri . '/assets/svgs/clock.svg' ); ?>" alt="<?php echo esc_attr__( 'Uhr', 'aleandbread' ); ?>" />
			<span class="block-text-bold -mb-0.5"><?php echo esc_html( $time_html ); ?></span>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $date_html ) ) : ?>
		<div class="flex items-center gap-2">
			<img class="inline-block w-4 h-4" src="<?php echo esc_url( $theme_uri . '/assets/svgs/calendar.svg' ); ?>" alt="<?php echo esc_attr__( 'Kalender', 'aleandbread' ); ?>" />
			<span class="block-text-bold mb-0.5"><?php echo esc_html( $date_html ); ?></span>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $el ) ) : ?>
		<div class="flex items-center gap-2">
			<img class="inline-block w-4 h-4" src="<?php echo esc_url( $theme_uri . '/assets/svgs/location.svg' ); ?>" alt="<?php echo esc_attr__( 'Standort', 'aleandbread' ); ?>" />
			<span class="block-text-bold mb-0.5"><?php echo esc_html( $el ); ?></span>
		</div>
	<?php endif; ?>

	<?php
}
