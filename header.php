<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class( 'relative' ); ?>>
		<?php do_action( 'wp_body_open' ); ?>
		<?php get_template_part( 'template-parts/header', 'main' ); ?>