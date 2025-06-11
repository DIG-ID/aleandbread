<?php
/**
 * Customize WordPress Admin look and feel.
 */


// Disable default dashboard widgets.
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );
}
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets', 999 );


/************* CUSTOM LOGIN PAGE *****************/


// Updated to proper 'enqueue' method.
// http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function theme_login_css() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'admin-login-css', get_theme_file_uri( '/dist/css/admin-login.css' ), array(), $theme_version );
}
add_action( 'login_enqueue_scripts', 'theme_login_css', 10 );

// Changing the logo link from wordpress.org to your site.
function theme_login_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'theme_login_url' );

// Changing the alt text on the logo to show your site name.
function theme_login_title() {
	return get_option( 'blogname' );
}
add_filter( 'login_headertext', 'theme_login_title' );


/************* CUSTOMIZE ADMIN *******************/

// Custom Backend Footer.
function theme_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="https://dig.id" target="_blank">dig.id</a></span>.', 'hotelrochat' );
}

add_filter( 'admin_footer_text', 'theme_custom_admin_footer' );


// Change login page logo.
function theme_login_logo() {
	echo '<style type="text/css">
	h1 a {
		background-image: url(' . get_template_directory_uri() . '/assets/svg/mega-menu__logo.svg) !important;
	}
	</style>';
}

add_action( 'login_head', 'theme_login_logo' );


// Temove WordPress logo from admin bar.
add_action( 'admin_bar_menu', 'remove_wp_links', 999 );
function remove_wp_links( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}


// Custom WordPress Admin Color Scheme
/*function custom_admin_css() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'admin-css', get_theme_file_uri( '/build/admin-login.css' ), array(), $theme_version );
}
add_action( 'admin_print_styles', 'custom_admin_css' );*/

/**
 * Allow SVG uploads for administrator users.
 *
 * @param array $upload_mimes Allowed mime types.
 *
 * @return mixed
 */
add_filter(
	'upload_mimes',
	function ( $upload_mimes ) {
		// By default, only administrator users are allowed to add SVGs.
		// To enable more user types edit or comment the lines below but beware of
		// the security risks if you allow any user to upload SVG files.
		if ( ! current_user_can( 'administrator' ) || ! current_user_can( 'editor' ) ) {
			return $upload_mimes;
		}

		$upload_mimes['svg']  = 'image/svg+xml';
		$upload_mimes['svgz'] = 'image/svg+xml';

		return $upload_mimes;
	}
);

/**
 * Add SVG files mime check.
 *
 * @param array        $wp_check_filetype_and_ext Values for the extension, mime type, and corrected filename.
 * @param string       $file Full path to the file.
 * @param string       $filename The name of the file (may differ from $file due to $file being in a tmp directory).
 * @param string[]     $mimes Array of mime types keyed by their file extension regex.
 * @param string|false $real_mime The actual mime type or false if the type cannot be determined.
 */
add_filter(
	'wp_check_filetype_and_ext',
	function ( $wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime ) {

		if ( ! $wp_check_filetype_and_ext['type'] ) {

			$check_filetype  = wp_check_filetype( $filename, $mimes );
			$ext             = $check_filetype['ext'];
			$type            = $check_filetype['type'];
			$proper_filename = $filename;

			if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
				$ext  = false;
				$type = false;
			}

			$wp_check_filetype_and_ext = compact( 'ext', 'type', 'proper_filename' );
		}

		return $wp_check_filetype_and_ext;

	},
	10,
	5
);

// Completely Disable Comments.
add_action(
	'admin_init',
	function () {
		// Redirect any user trying to access comments page.
		global $pagenow;

		if ( 'edit-comments.php' === $pagenow ) {
			wp_safe_redirect( admin_url() );
			exit;
		}

		// Remove comments metabox from dashboard.
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

		// Disable support for comments and trackbacks in post types.
		foreach ( get_post_types() as $post_type ) {
			if ( post_type_supports( $post_type, 'comments') ) {
				remove_post_type_support( $post_type, 'comments' );
				remove_post_type_support( $post_type, 'trackbacks' );
			}
		}
	}
);

// Close comments on the front-end.
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// Hide existing comments.
add_filter( 'comments_array', '__return_empty_array', 10, 2 );

// Remove comments page in menu.
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
	}
);

// Remove comments links from admin bar.
add_action(
	'init',
	function () {
		if ( is_admin_bar_showing() ) {
			remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
	}
);


// Disable Attachment Pages.
add_action(
	'template_redirect',
	function () {
		global $post;
		if ( ! is_attachment() || ! isset( $post->post_parent ) || ! is_numeric( $post->post_parent ) ) {
			return;
		}

		// Does the attachment have a parent post?
		// If the post is trashed, fallback to redirect to homepage.
		if ( 0 !== $post->post_parent && 'trash' !== get_post_status( $post->post_parent ) ) {
			// Redirect to the attachment parent.
			wp_safe_redirect( get_permalink( $post->post_parent ), 301 );
		} else {
			// For attachment without a parent redirect to homepage.
			wp_safe_redirect( get_bloginfo( 'wpurl' ), 302 );
		}
		exit;
	},
	1
);
