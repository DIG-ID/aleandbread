<?php
/**
 * Theme custom shortcoes
 *
 * @package aleandbread
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Voucher example shortcode.
 *
 * @param array  $atts    The shortcode attributes.
 * @param string $content The shortcode content.
 * @param string $tag     The shortcode tag.
 * @return string The shortcode output.
 */
function aab_shortcode_voucher_example( $atts = [], $content = null, $tag = '' ): string {
	$atts = shortcode_atts(
		[
			'class' => '',
		],
		(array) $atts,
		$tag
	);

	// ACF optional safety.
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}

	$title  = get_field( 'voucher_title', 'option' );
	$image1 = get_field( 'voucher_images_1', 'option' );
	$image2 = get_field( 'voucher_images_2', 'option' );
	$image3 = get_field( 'voucher_images_3', 'option' );

	// Support ACF image field returning array or ID.
	$image1_id = is_array( $image1 ) && isset( $image1['ID'] ) ? (int) $image1['ID'] : (int) $image1;
	$image2_id = is_array( $image2 ) && isset( $image2['ID'] ) ? (int) $image2['ID'] : (int) $image2;
	$image3_id = is_array( $image3 ) && isset( $image3['ID'] ) ? (int) $image3['ID'] : (int) $image3;

	// If nothing to show, output nothing.
	if ( empty( $title ) && ! $image1_id && ! $image2_id && ! $image3_id ) {
		return '';
	}

	$extra_class = trim( (string) $atts['class'] );

	ob_start();
	?>
	<section class="section-voucher-example my-16 <?php echo esc_attr( $extra_class ); ?>">

		<div class="theme-grid">
			<div class="col-span-12">
				<?php if ( ! empty( $title ) ) : ?>
					<h3 class="mb-12 md:mb-16 xl:mb-24"><?php echo esc_html( (string) $title ); ?></h3>
				<?php endif; ?>
			</div>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-6 xl:grid-cols-12 grid-rows-2 gap-4">
			<div class="col-span-2 md:col-span-3 xl:col-span-8 md:row-span-2">
				<?php
				if ( $image1_id ) {
					echo wp_get_attachment_image( $image1_id, 'full', false, [ 'class' => 'w-full h-auto' ] );
				}
				?>
			</div>

			<div class="col-span-1 md:col-span-3 xl:col-span-4 md:row-span-1">
				<?php
				if ( $image2_id ) {
					echo wp_get_attachment_image( $image2_id, 'full', false, [ 'class' => 'w-full h-auto' ] );
				}
				?>
			</div>

			<div class="col-span-1 md:col-span-3 xl:col-span-4 md:row-span-1">
				<?php
				if ( $image3_id ) {
					echo wp_get_attachment_image( $image3_id, 'full', false, [ 'class' => 'w-full h-auto' ] );
				}
				?>
			</div>
		</div>

	</section>
	<?php

	return (string) ob_get_clean();
}

add_shortcode( 'aab_voucher_example', 'aab_shortcode_voucher_example' );