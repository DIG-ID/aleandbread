<?php
/**
 * Schema.org structured data for the Event CPT.
 *
 * @package    AleanBread
 * @subpackage Schema
 *
 * Outputs JSON-LD Event schema on single event posts.
 *
 * ACF field map (CPT: event, group: events_cpt):
 *  events_cpt_title              text
 *  events_cpt_description        textarea
 *  events_cpt_image              image (returns id)
 *  events_cpt_event_date_start   date_time_picker (Y-m-d H:i:s)
 *  events_cpt_event_date_end     date_time_picker (Y-m-d H:i:s)
 *  events_cpt_place              text
 *  events_cpt_button             link (array)
 */

/**
 * Output JSON-LD Event schema on single event CPT posts.
 */
function aleandbread_output_event_schema() {
	if ( ! is_singular( 'event' ) ) {
		return;
	}

	$post_id = get_the_ID();
	$schema  = aleandbread_build_event_schema( $post_id );

	if ( empty( $schema ) ) {
		return;
	}

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT )
		. '</script>' . "\n";
}
add_action( 'wp_head', 'aleandbread_output_event_schema' );

/**
 * Build a schema.org/Event array from ACF fields.
 *
 * @param int $post_id The event post ID.
 * @return array|null The schema array, or null if required fields are missing.
 */
function aleandbread_build_event_schema( $post_id ) {
	$eds = get_field( 'events_cpt_event_date_start', $post_id, false );
	$ede = get_field( 'events_cpt_event_date_end', $post_id, false );

	// startDate and endDate are required for Event rich results.
	if ( ! $eds || ! $ede ) {
		return null;
	}

	$tz   = wp_timezone();
	$dt_s = DateTimeImmutable::createFromFormat( 'Y-m-d H:i:s', (string) $eds, $tz );
	$dt_e = DateTimeImmutable::createFromFormat( 'Y-m-d H:i:s', (string) $ede, $tz );

	if ( ! $dt_s || ! $dt_e ) {
		return null;
	}

	// Resolve image: prefer ACF field, fall back to featured image.
	$image_id  = get_field( 'events_cpt_image', $post_id ) ?: get_post_thumbnail_id( $post_id );
	$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'full' ) : '';

	$title       = get_field( 'events_cpt_title', $post_id ) ?: get_the_title( $post_id );
	$description = get_field( 'events_cpt_description', $post_id );
	$place       = get_field( 'events_cpt_place', $post_id );

	$schema = array(
		'@context'            => 'https://schema.org',
		'@type'               => 'Event',
		'name'                => sanitize_text_field( $title ),
		'startDate'           => $dt_s->format( DateTime::ATOM ),
		'endDate'             => $dt_e->format( DateTime::ATOM ),
		'url'                 => get_permalink( $post_id ),
		'eventStatus'         => 'https://schema.org/EventScheduled',
		'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
		'organizer'           => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'url'   => home_url(),
		),
	);

	if ( $image_url ) {
		$schema['image'] = $image_url;
	}

	if ( $description ) {
		$schema['description'] = wp_strip_all_tags( $description );
	}

	// Location — Place with name; address can be added later if needed.
	if ( $place ) {
		$schema['location'] = array(
			'@type' => 'Place',
			'name'  => sanitize_text_field( $place ),
		);
	}

	// Offers — use button URL as ticket/registration link if available.
	$button = get_field( 'events_cpt_button', $post_id );
	if ( ! empty( $button['url'] ) ) {
		$schema['offers'] = array(
			'@type'        => 'Offer',
			'url'          => esc_url( $button['url'] ),
			'availability' => 'https://schema.org/InStock',
		);
	}

	return $schema;
}
