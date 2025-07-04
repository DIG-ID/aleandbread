<?php
/**
 * Setup theme
 */
function aleandbread_theme_setup() {

	register_nav_menus(
		array(
			'main-menu'      => __( 'Main Menu', 'aleandbread' ),
			'footer-menu-ale' => __( 'Footer Menu Ale and Bread', 'aleandbread' ),
			'footer-menu-shop' => __( 'Footer Menu Shop', 'aleandbread' ),
			'footer-menu-experience' => __( 'Footer Menu Experience', 'aleandbread' ),
			'footer-menu-support' => __( 'Footer Menu Support', 'aleandbread' ),
		)
	);

	add_theme_support( 'menus' );

	add_theme_support( 'custom-logo' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	add_theme_support( 'woocommerce' );

	add_theme_support( 'wc-product-gallery-zoom' );

	add_theme_support( 'wc-product-gallery-lightbox' );
	
	add_theme_support( 'wc-product-gallery-slider' );

	//add_image_size( 'zimmer-image', 1400, 770, array( 'center', 'center' ) );

}

add_action( 'after_setup_theme', 'aleandbread_theme_setup' );

/**
 * Register our sidebars and widgetized areas.
 */
function aleandbread_theme_footer_widgets_init() {

	register_sidebar(
		array(
			'name'          => 'Footer',
			'id'            => 'footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		),
	);

	register_sidebar(
		array(
			'name'          => 'Header Language Switcher',
			'id'            => 'header_ls',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

}

add_action( 'widgets_init', 'aleandbread_theme_footer_widgets_init' );

if ( ! function_exists( 'aleandbread_get_font_face_styles' ) ) :
	/**
	 * Get font face styles.
	 * This is used by the theme or editor to inject @import for Google Fonts.
	 */
	function aleandbread_get_font_face_styles() {
		return "
			@import url('https://use.typekit.net/ccj8tei.css');
		";
	}
endif;

if ( ! function_exists( 'aleandbread_preload_webfonts' ) ) :
	/**
	 * Preloads the main web font to improve performance.
	 */
	function aleandbread_preload_webfonts() {
		?>
		<link rel="preconnect" href="use.typekit.net" crossorigin>
		<?php
	}
endif;

add_action( 'wp_head', 'aleandbread_preload_webfonts' );


/**
 * Enqueue styles and scripts
 */
function aleandbread_theme_enqueue_styles() {

	//Get the theme data
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	// Register Theme main style.
	wp_register_style( 'theme-styles', get_template_directory_uri() . '/dist/css/main.css', array(), $theme_version );
	// Add styles inline.
	wp_add_inline_style( 'theme-styles', aleandbread_get_font_face_styles() );
	// Enqueue theme stylesheet.
	wp_enqueue_style( 'theme-styles' );
	//https://use.typekit.net/evg0ous.css first loaded fonts library backup
	//wp_enqueue_style( 'theme-fonts', 'https://use.typekit.net/buy6qwo.css', array(), $theme_version );

	wp_enqueue_script( 'jquery', false, array(), $theme_version, true );
	wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . '/dist/js/main.js', array( 'jquery' ), $theme_version, true );
}

add_action( 'wp_enqueue_scripts', 'aleandbread_theme_enqueue_styles' );

add_filter( 'wpseo_breadcrumb_links', 'fix_yoast_page_parent_breadcrumb' );

function fix_yoast_page_parent_breadcrumb( $links ) {
    global $post;
    if ( is_page() && $post->post_parent ) {
        $parent = get_post( $post->post_parent );
        if ( $parent ) {
            $breadcrumb[] = array(
                'url' => get_permalink( $parent->ID ),
                'text' => $parent->post_title,
            );
            // Remove default page link
            array_splice( $links, -1, 0, $breadcrumb );
        }
    }
    return $links;
}


/**
 * Remove <p> Tag From Contact Form 7.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Lowers the metabox priority to 'core' for Yoast SEO's metabox.
 *
 * @param string $priority The current priority.
 *
 * @return string $priority The potentially altered priority.
 */
function aleandbread_theme_lower_yoast_metabox_priority( $priority ) {
	return 'core';
}

add_filter( 'wpseo_metabox_prio', 'aleandbread_theme_lower_yoast_metabox_priority' );


// Theme custom template tags.
require get_template_directory() . '/inc/theme-template-tags.php';

// The theme admin settings.
require get_template_directory() . '/inc/theme-admin-settings.php';

// The theme custom menu walker settings.
require get_template_directory() . '/inc/theme-custom-menu-walker.php';

// The theme woocommerce integration.
require get_template_directory() . '/inc/theme-woocommerce.php';

function console_log(...$data) {
	$json = json_encode($data);
	add_action('shutdown', function() use ($json) {
		 echo "<script>console.log({$json})</script>";
	});
}