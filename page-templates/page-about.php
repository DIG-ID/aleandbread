<?php
/**
 * Template Name: About
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/about/our-mission' );
            get_template_part( 'template-parts/pages/about/our-values' );
            get_template_part( 'template-parts/pages/about/our-brands' );			
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
