<?php
/**
 * Template Name: Falk Landing page
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/falk-landing-page/hero' );
            get_template_part( 'template-parts/pages/falk-landing-page/highlights' );
            get_template_part( 'template-parts/pages/falk-landing-page/quality-promise' );			
			get_template_part( 'template-parts/pages/falk-landing-page/falk' );	
			get_template_part( 'template-parts/pages/falk-landing-page/testemonials' );	
			get_template_part( 'template-parts/pages/falk-landing-page/other-products' );	
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
