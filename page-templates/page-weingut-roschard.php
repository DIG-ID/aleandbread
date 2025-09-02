<?php
/**
 * Template Name: Weingut Röschard
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/weingut-roschard/winery' );
            get_template_part( 'template-parts/modules/our-experiences');
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
