<?php
/**
 * Template Name: Distellerie
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/distellerie/hero' );
			get_template_part( 'template-parts/pages/distellerie/highlights' );
			get_template_part( 'template-parts/pages/distellerie/craftsmanship' );
			get_template_part( 'template-parts/pages/distellerie/gin-makes-history' );			
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
