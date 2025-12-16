<?php
get_header();
	do_action( 'before_main_content' );
		get_template_part( 'template-parts/archives/events/hero' );
		get_template_part( 'template-parts/archives/events/next-events' );
		get_template_part( 'template-parts/archives/events/past-events' );
		get_template_part( 'template-parts/archives/events/our-experiences' );
	do_action( 'after_main_content' );
get_footer();