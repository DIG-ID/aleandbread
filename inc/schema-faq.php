<?php
/**
 * Schema.org structured data for the FAQ page template.
 *
 * @package    AleanBread
 * @subpackage Schema
 *
 * Outputs JSON-LD FAQPage schema by flattening all question/answer pairs
 * from both ACF repeater groups into a single mainEntity array.
 *
 * ACF field map (page template: page-templates/page-faq.php):
 *  faq (repeater)
 *    title         (text)     — group label, not used in schema
 *    faq_accordion (repeater)
 *      question    (text)
 *      response    (textarea)
 */

/**
 * Output JSON-LD FAQPage schema on the FAQ page template.
 */
function aleandbread_output_faq_schema() {
	if ( ! is_page_template( 'page-templates/page-faq.php' ) ) {
		return;
	}

	$faq_groups = get_field( 'faq' );

	if ( empty( $faq_groups ) || ! is_array( $faq_groups ) ) {
		return;
	}

	$main_entity = array();

	foreach ( $faq_groups as $group ) {
		if ( empty( $group['faq_accordion'] ) || ! is_array( $group['faq_accordion'] ) ) {
			continue;
		}

		foreach ( $group['faq_accordion'] as $item ) {
			$question = isset( $item['question'] ) ? trim( $item['question'] ) : '';
			$answer   = isset( $item['response'] ) ? trim( $item['response'] ) : '';

			if ( ! $question || ! $answer ) {
				continue;
			}

			$main_entity[] = array(
				'@type' => 'Question',
				'name'  => sanitize_text_field( $question ),
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => wp_strip_all_tags( $answer ),
				),
			);
		}
	}

	if ( empty( $main_entity ) ) {
		return;
	}

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $main_entity,
	);

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT )
		. '</script>' . "\n";
}
add_action( 'wp_head', 'aleandbread_output_faq_schema' );
