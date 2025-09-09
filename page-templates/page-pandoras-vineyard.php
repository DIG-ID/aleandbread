<?php
/**
 * Template Name: Pandoras vineyard
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/pandoras-vineyard/hero' );
			get_template_part( 'template-parts/pages/pandoras-vineyard/highlights' );
			get_template_part( 'template-parts/pages/pandoras-vineyard/craftsmanship' );
			get_template_part( 'template-parts/pages/pandoras-vineyard/wine-with-origin' );			
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
