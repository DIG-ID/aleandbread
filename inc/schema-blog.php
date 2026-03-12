<?php
/**
 * Schema.org structured data for the Blog CPT.
 *
 * @package AleanBread
 *
 * Outputs JSON-LD for:
 *  - Recipe posts  → schema.org/Recipe  (rich snippets: ingredients, steps, times)
 *  - Article posts → Yoast handles this by default; no duplicate output here.
 *
 * ACF field map (all inside the `blog_cpt` group):
 *  blog_post_format          radio: 'article' | 'recipe'
 *  image                     image (returns id)
 *  recipe.servings           text
 *  recipe.prep_time          number (minutes)
 *  recipe.ingredients        repeater → ingredient (text)
 *  recipe.steps              repeater → step (textarea)
 *  recipe.serving_suggestion textarea
 */

/**
 * Output JSON-LD schema on single blog CPT posts.
 */
function aleandbread_output_blog_schema() {
	if ( ! is_singular( 'blog' ) ) {
		return;
	}

	$post_id     = get_the_ID();
	$fields      = get_field( 'blog_cpt', $post_id );
	$post_format = isset( $fields['blog_post_format'] ) ? $fields['blog_post_format'] : 'article';

	// Only inject schema for recipes — Yoast covers Article by default.
	if ( 'recipe' !== $post_format ) {
		return;
	}

	$schema = aleandbread_build_recipe_schema( $post_id, $fields );

	if ( empty( $schema ) ) {
		return;
	}

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT )
		. '</script>' . "\n";
}
add_action( 'wp_head', 'aleandbread_output_blog_schema' );

/**
 * Build a schema.org/Recipe array from ACF fields.
 *
 * @param int   $post_id The post ID.
 * @param array $fields  The blog_cpt ACF field group values.
 * @return array The schema array ready for JSON encoding.
 */
function aleandbread_build_recipe_schema( $post_id, $fields ) {
	$recipe = isset( $fields['recipe'] ) && is_array( $fields['recipe'] ) ? $fields['recipe'] : array();

	// Resolve image: prefer ACF field, fall back to featured image.
	$image_id  = ! empty( $fields['image'] ) ? $fields['image'] : get_post_thumbnail_id( $post_id );
	$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'full' ) : '';

	$schema = array(
		'@context'      => 'https://schema.org',
		'@type'         => 'Recipe',
		'name'          => get_the_title( $post_id ),
		'description'   => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
		'url'           => get_permalink( $post_id ),
		'datePublished' => get_the_date( 'c', $post_id ),
		'dateModified'  => get_the_modified_date( 'c', $post_id ),
		'author'        => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'url'   => home_url(),
		),
	);

	if ( $image_url ) {
		$schema['image'] = $image_url;
	}

	// Servings.
	if ( ! empty( $recipe['servings'] ) ) {
		$schema['recipeYield'] = sanitize_text_field( $recipe['servings'] );
	}

	// Prep time in minutes → ISO 8601 duration (e.g. PT10M).
	// No cookTime — these are drink/cocktail recipes.
	$prep_minutes = ! empty( $recipe['prep_time'] ) ? absint( $recipe['prep_time'] ) : 0;

	if ( $prep_minutes > 0 ) {
		$schema['prepTime']  = 'PT' . $prep_minutes . 'M';
		$schema['totalTime'] = 'PT' . $prep_minutes . 'M';
	}

	// Ingredients — repeater: recipe.ingredients → ingredient (text).
	if ( ! empty( $recipe['ingredients'] ) && is_array( $recipe['ingredients'] ) ) {
		$schema['recipeIngredient'] = array_map(
			function ( $row ) {
				return sanitize_text_field( $row['ingredient'] );
			},
			$recipe['ingredients']
		);
	}

	// Steps — repeater: recipe.steps → step (textarea).
	if ( ! empty( $recipe['steps'] ) && is_array( $recipe['steps'] ) ) {
		$position = 1;
		foreach ( $recipe['steps'] as $row ) {
			$schema['recipeInstructions'][] = array(
				'@type'    => 'HowToStep',
				'position' => $position++,
				'text'     => wp_strip_all_tags( $row['step'] ),
			);
		}
	}

	// Recipe category from WordPress categories (optional but useful).
	$categories = get_the_terms( $post_id, 'category' );
	if ( $categories && ! is_wp_error( $categories ) ) {
		$schema['recipeCategory'] = implode( ', ', wp_list_pluck( $categories, 'name' ) );
	}

	// Keywords from post tags.
	$tags = get_the_terms( $post_id, 'post_tag' );
	if ( $tags && ! is_wp_error( $tags ) ) {
		$schema['keywords'] = implode( ', ', wp_list_pluck( $tags, 'name' ) );
	}

	return $schema;
}

/**
 * For recipe posts, tell Yoast to output WebPage instead of Article
 * to avoid duplicate/conflicting schema in Google's eyes.
 *
 * @param string $type The Yoast schema type.
 * @return string Modified schema type.
 */
function aleandbread_yoast_schema_type_for_recipe( $type ) {
	if ( ! is_singular( 'blog' ) ) {
		return $type;
	}

	$fields      = get_field( 'blog_cpt', get_the_ID() );
	$post_format = isset( $fields['blog_post_format'] ) ? $fields['blog_post_format'] : 'article';

	if ( 'recipe' === $post_format ) {
		// Return WebPage so Yoast doesn't output a competing Article schema.
		return 'WebPage';
	}

	return $type;
}
add_filter( 'wpseo_schema_webpage_type', 'aleandbread_yoast_schema_type_for_recipe' );
