<?php
/**
 * Schema.org WebPage type overrides for static page templates.
 *
 * Tells Yoast SEO to output the correct WebPage sub-type for specific page
 * templates. No additional JSON-LD is injected — Yoast handles all other
 * WebPage properties (name, url, breadcrumb, etc.) automatically.
 *
 * @package    AleanBread
 * @subpackage Schema
 */

/**
 * Override Yoast's WebPage schema type based on the current page template.
 *
 * @param string $type The schema type Yoast is about to output.
 * @return string Modified schema type.
 */
function aleandbread_yoast_schema_type_for_pages( $type ) {
	if ( ! is_page() ) {
		return $type;
	}

	$template_map = array(
		'page-templates/page-contact.php' => 'ContactPage',
		'page-templates/page-about.php'   => 'AboutPage',
	);

	$template = get_page_template_slug();

	if ( isset( $template_map[ $template ] ) ) {
		return $template_map[ $template ];
	}

	return $type;
}
add_filter( 'wpseo_schema_webpage_type', 'aleandbread_yoast_schema_type_for_pages' );
