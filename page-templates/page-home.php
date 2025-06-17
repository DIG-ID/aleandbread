<?php
/**
 * Template Name: Home Template
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/home/hero' );	
			get_template_part( 'template-parts/pages/home/mission-and-philosophy' );
			get_template_part( 'template-parts/pages/home/distellerie' );
			get_template_part( 'template-parts/pages/home/vineyard' );
			get_template_part( 'template-parts/pages/home/events' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
