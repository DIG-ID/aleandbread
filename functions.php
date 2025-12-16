<?php
/**
 * Setup theme
 */
function aleandbread_theme_setup() {
	register_nav_menus(
		array(
			'main-menu'              => __( 'Main Menu', 'aleandbread' ),
			'mega-left'              => __( 'Mega Menu Left', 'aleandbread' ),
			'mega-middle'            => __( 'Mega Menu Middle', 'aleandbread' ),
			'mega-right'             => __( 'Mega Menu Right', 'aleandbread' ),
			'footer-menu-ale'        => __( 'Footer Menu Ale and Bread', 'aleandbread' ),
			'footer-menu-shop'       => __( 'Footer Menu Shop', 'aleandbread' ),
			'footer-menu-experience' => __( 'Footer Menu Experience', 'aleandbread' ),
			'footer-menu-support'    => __( 'Footer Menu Support', 'aleandbread' ),
		)
	);
	add_theme_support( 'widgets' );
	add_theme_support( 'menus' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 415,
			'single_image_width'    => 680,
			'product_grid'          => array(
				'default_rows'    => 2,
				'min_rows'        => 1,
				'max_rows'        => 3,
				'default_columns' => 3,
				'min_columns'     => 2,
				'max_columns'     => 3,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_image_size( 'event-thumb', 560, 295, array( 'center', 'center' ) );

	add_image_size( 'highlights-size', 1600, 1040, array( 'center', 'center' ) );

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
	register_sidebar(
		array(
			'name'          => __( 'Shop Sidebar', 'aleandbread' ),
			'id'            => 'shop-sidebar',
			'description'   => __( 'Widgets shown on WooCommerce product listings (category, search, etc.)', 'aleandbread' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-14">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="text-lg font-bold mb-2">',
			'after_title'   => '</h3>',
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

	// Get the theme data.
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

/**
 * Fixes Yoast breadcrumb for pages with a parent.
 * It adds the parent page to the breadcrumb trail.
 *
 * @param array $links The breadcrumb links.
 * @return array The modified breadcrumb links.
 */
function fix_yoast_page_parent_breadcrumb( $links ) {
	global $post;
	if ( is_page() && $post->post_parent ) {
		$parent = get_post( $post->post_parent );
		if ( $parent ) {
			$breadcrumb[] = array(
				'url' => get_permalink( $parent->ID ),
				'text' => $parent->post_title,
			);
			// Remove default page link.
			array_splice( $links, -1, 0, $breadcrumb );
		}
	}
	return $links;
}
add_filter( 'wpseo_breadcrumb_links', 'fix_yoast_page_parent_breadcrumb' );

/**
 * This function adds a custom loop with chosen categories through ACF.
 *
 * @param string $items The HTML list items for the menu.
 * @param object $args  An object containing wp_nav_menu() arguments.
 * @return string Modified menu items.
 */
function aleandbread_custom_menu( $items, $args ) {
	if ( empty( $args->theme_location ) || 'mega-right' !== $args->theme_location ) {
		return $items;
	}
	// Build items fresh (ignore any manually added ones to avoid duplicates).
	$items = '';
	if ( is_user_logged_in() ) {
		$account_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		$logout_url  = wp_logout_url( home_url( '/' ) );
		$items      .= '<li class="menu-item"><a href="' . esc_url( $account_url ) . '">My Account</a></li>';
		$items      .= '<li class="menu-item"><a href="' . esc_url( $logout_url ) . '">Logout</a></li>';
	} else {
		$login_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		$items    .= '<li class="menu-item"><a href="' . esc_url( $login_url ) . '">Login</a></li>';
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'aleandbread_custom_menu', 10, 2 );

/**
 * Adds custom classes to menu link attributes for the 'mega-right' menu location.
 *
 * @param array  $atts The HTML attributes applied to the menu item's <a> element.
 * @param object $item The current menu item.
 * @param object $args An object of wp_nav_menu() arguments.
 * @return array Modified attributes.
 */
function aleandbread_add_menu_link_attributes( $atts, $item, $args ) {
	if ( ! empty( $args->theme_location ) && 'mega-right' === $args->theme_location ) {
		// Tailwind-y classes.
		$atts['class'] = trim( ( $atts['class'] ?? '' ) . ' block font-barlow font-semibold uppercase text-[28px] md:text-[34px] leading-none' );
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'aleandbread_add_menu_link_attributes', 10, 3 );

/**
 * Remove <p> Tag From Contact Form 7.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Prevent popups showing when loading a page
 */
add_action( 'wp_head', function () {
	echo '<style>[x-cloak]{display:none !important;}</style>';
}, 0 );

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

/**
 * Modify the archive title.
 *
 * @param string $title The original title.
 * @return string The modified title.
 */
function aleandbread_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}
	return $title;
}

add_filter( 'get_the_archive_title', 'aleandbread_archive_title' );


// Theme custom template tags.
require get_template_directory() . '/inc/theme-template-tags.php';

// The theme admin settings.
require get_template_directory() . '/inc/theme-admin-settings.php';

// The theme custom menu walker settings.
require get_template_directory() . '/inc/theme-custom-menu-walker.php';

// The theme woocommerce integration.
require get_template_directory() . '/inc/theme-woocommerce.php';

// The user validation settings.
require get_template_directory() . '/inc/theme-user-validation.php';

// The theme custom functions.
require get_template_directory() . '/inc/template-functions.php';


/**
 * Console log function for debugging.
 * Outputs data to the browser console.
 *
 * @param mixed ...$data Data to log to the console.
 */
function console_log( ...$data ) {
	$json = wp_json_encode( $data );
	add_action(
		'shutdown',
		function () use ( $json ) {
			echo "<script>console.log( {$json} )</script>";
		}
	);
}






/**
 * Keep/rename/order product tabs:
 * 1) Beschreibung (Description)
 * 2) Additional information
 * 3) Reviews
 */
add_filter('woocommerce_product_tabs', function ($tabs) {
		global $product;

		// --- Description tab ---
		$tabs['description'] = [
			'title'    => __('Beschreibung', 'aleandbread'), // label
			'priority' => 10,
			'callback' => 'woocommerce_product_description_tab', // default renderer
		];

		// --- Additional information tab (only if product has attributes) ---
		if ($product instanceof WC_Product && $product->has_attributes()) {
				$tabs['additional_information'] = [
					'title'    => __('Additional information', 'aleandbread'),
					'priority' => 20,
					'callback' => 'woocommerce_product_additional_information_tab',
				];
		} else {
				unset($tabs['additional_information']);
		}

		// --- Reviews tab (only if reviews are enabled) ---
		if ('yes' === get_option('woocommerce_enable_reviews')) {
			$count = $product ? (int) $product->get_review_count() : 0;
			$tabs['reviews'] = [
				'title'    => sprintf(__('Reviews (%d)', 'aleandbread'), $count),
				'priority' => 30,
				'callback' => 'comments_template', // default renderer.
			];
		} else {
			unset($tabs['reviews']);
		}

		return $tabs;
}, 99);

// Always enable reviews for products
add_filter( 'woocommerce_product_tabs', function( $tabs ) {
	global $product;
	if ( ! empty( $tabs['reviews'] ) ) {
		$tabs['reviews']['title'] = __( 'Reviews', 'woocommerce' );
	} else {
		$tabs['reviews'] = array(
			'title'    => __( 'Reviews', 'woocommerce' ),
			'priority' => 50,
			'callback' => 'comments_template',
		);
	}
	return $tabs;
}, 98 );

// Ensure products accept comments (reviews use comments system)
add_action( 'init', function() {
	add_post_type_support( 'product', 'comments' );
});

add_action( 'init', function () {
	register_taxonomy_for_object_type( 'category', 'blog' );
	register_taxonomy_for_object_type( 'post_tag', 'blog' );
});


/*TO REMOVE TO REMOVE TO REMOVE - Test the thank you page after a purchase*/
/*add_action('admin_notices', function(){
    if (! current_user_can('manage_woocommerce')) return;

    $order_id = 1238; // change this to your test order ID
    $order    = wc_get_order($order_id);

    if ($order) {
        $url = wc_get_endpoint_url(
            'order-received',
            $order->get_id(),
            wc_get_page_permalink('checkout')
        ) . '?key=' . $order->get_order_key();

        echo '<div class="notice notice-info"><p>Thank You URL: <a href="'.esc_url($url).'" target="_blank">'.$url.'</a></p></div>';
    }
});*/