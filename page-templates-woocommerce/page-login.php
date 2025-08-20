<?php
/**
 * Template Name: Login Template
 */

get_header( 'shop' );
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
            get_template_part( 'woocommerce/page-template-parts/login' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer( 'shop' );
