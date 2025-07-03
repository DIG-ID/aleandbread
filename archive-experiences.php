<?php
get_header();
    do_action( 'before_main_content' );
        get_template_part( 'template-parts/archives/experiences/hero' );
        get_template_part( 'template-parts/archives/experiences/events' );
    do_action( 'after_main_content' );
get_footer();