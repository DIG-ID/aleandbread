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
			get_template_part( 'template-parts/pages/home/best-sellers' );
			get_template_part( 'template-parts/pages/home/experiences' );
			get_template_part( 'template-parts/modules/events' );
			get_template_part( 'template-parts/pages/home/blog' );
			get_template_part( 'template-parts/pages/home/awards' );
			get_template_part( 'template-parts/pages/home/newsletter' );
			get_template_part( 'template-parts/pages/home/outro' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
