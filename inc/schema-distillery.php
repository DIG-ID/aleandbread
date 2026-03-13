<?php
/**
 * Schema.org LocalBusiness structured data for the Distillery Aktienmühle page.
 *
 * Injects a LocalBusiness (FoodEstablishment) JSON-LD block so that Google
 * and AI bots can identify the physical establishment, its address, and its
 * contact information.
 *
 * @package    AleanBread
 * @subpackage Schema
 */

/**
 * Output JSON-LD LocalBusiness schema for the Distillery Aktienmühle page.
 *
 * @return void
 */
function aleandbread_output_distillery_schema() {
	if ( ! is_page_template( 'page-templates/distillery-Aktienmühle.php' ) ) {
		return;
	}

	$post_id = get_the_ID();
	$schema  = aleandbread_build_distillery_schema( $post_id );

	if ( empty( $schema ) ) {
		return;
	}

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT )
		. '</script>' . "\n";
}
add_action( 'wp_head', 'aleandbread_output_distillery_schema' );

/**
 * Build the LocalBusiness schema array from ACF fields.
 *
 * @param int $post_id The page post ID.
 * @return array The schema array ready for JSON encoding.
 */
function aleandbread_build_distillery_schema( $post_id ) {
	$title       = get_field( 'distillery_aktienmuhle_title', $post_id );
	$description = get_field( 'distillery_aktienmuhle_description', $post_id );
	$address_raw = get_field( 'distillery_aktienmuhle_address', $post_id );
	$gallery     = get_field( 'distillery_aktienmuhle_swiper', $post_id );

	// Fallback name to page title if ACF field is empty.
	$name = ! empty( $title ) ? sanitize_text_field( $title ) : get_the_title( $post_id );

	$schema = array(
		'@context'           => 'https://schema.org',
		'@type'              => 'LocalBusiness',
		'name'               => $name,
		'url'                => get_permalink( $post_id ),
		'parentOrganization' => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'url'   => home_url(),
		),
	);

	if ( ! empty( $description ) ) {
		$schema['description'] = sanitize_text_field( $description );
	}

	// Address — stored as a free-text textarea.
	if ( ! empty( $address_raw ) ) {
		$schema['address'] = array(
			'@type'         => 'PostalAddress',
			'streetAddress' => sanitize_textarea_field( $address_raw ),
		);
	}

	// Gallery images — use all available images for richer indexing.
	if ( ! empty( $gallery ) && is_array( $gallery ) ) {
		$images = array();
		foreach ( $gallery as $image_id ) {
			$url = wp_get_attachment_image_url( $image_id, 'full' );
			if ( $url ) {
				$images[] = esc_url_raw( $url );
			}
		}
		if ( ! empty( $images ) ) {
			$schema['image'] = $images;
		}
	}

	return $schema;
}
