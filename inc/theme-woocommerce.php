<?php

/**
 * Remove default WooCommerce wrappers and breadcrumb hook.
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10 );
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

//remove default notices from login form
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_customer_login_form', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_lost_password_form', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_reset_password_form', 'wc_print_notices', 10 );





// Add Account Default Content
add_action( 'woocommerce_account_content', 'woocommerce_account_content' );

// Add custom wrappers.
add_action( 'woocommerce_before_main_content', 'aleandbread_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'aleandbread_wrapper_end', 10 );

// Custom wrapper start.
function aleandbread_wrapper_start() {
	echo '<main id="main-content" class="main-content overflow-hidden mt-auto pt-[106px]">';
	echo '<div class="theme-container pb-[55px] md:pb-[92px] xl:pb-[192px] pt-[152px] md:pt-[194px] xl:pt-[170px]">';
}

//Make sure the user is logged in
add_action( 'template_redirect', function() {
    // Only gatekeep My Account pages for logged-out users
    if ( is_account_page() && ! is_user_logged_in() ) {
        // Allow WooCommerce endpoints that must be accessible while logged out
        $allowed_endpoints = array(
            'lost-password',
            'reset-password',
            'register',
        );
        // If we're on any allowed endpoint or on your custom login page, do nothing
        foreach ( $allowed_endpoints as $ep ) {
            if ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( $ep ) ) {
                return;
            }
        }
        // Also allow the standalone login page itself
        if ( is_page( array( 'login', 'signup' ) ) ) {
            return; // allow
        }
        // Otherwise, redirect to your login
        wp_safe_redirect( site_url( '/login/' ) );
        exit;
    }
});

//edit the Account Menu Items
add_filter( 'woocommerce_account_menu_items', function( $items ) {
    unset( $items['downloads'] );
    return $items;
} );



/**
 * Customized WooCommerce breadcrumbs function.
 *
 * @return void
 */
function aleandbread_shop_custom_breadcrumbs() {
		// Breadcrumbs now live here, *inside* the container.
	if ( function_exists( 'woocommerce_breadcrumb' ) ) {
		woocommerce_breadcrumb(
			array(
				'delimiter'   => ' &raquo; ',
				'wrap_before' => '<div class="theme-grid"><div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-4 pb-[30px] md:pb-[56px] xl:pb-[58px] w-full"><nav class="woocommerce-breadcrumb">',
				'wrap_after'  => '</nav></div></div>',
				'before'      => '',
				'after'       => '',
			)
		);
	}
}
add_action( 'aleandbread_shop_breadcrumbs', 'aleandbread_shop_custom_breadcrumbs', 10 );


// Custom wrapper end.
function aleandbread_wrapper_end() {
	echo '</div></main>';
}



/**
 * This function adds a custom loop with chosen categories through ACF.
 */
function aleandbread_shop_categories() {
	// Mostra as categorias desejadas com ACF.
	$shop_cats = get_field( 'shop_page_categories', 'option' );
	if ( $shop_cats ) :
		?>
		<ul class="shop-categories theme-grid">
			<?php
			foreach ( $shop_cats as $shop_cat ) :
				?>
				<li class="card-category col-span-2 md:col-span-3 xl:col-span-4">
					<a href="<?php echo esc_url( get_term_link( $shop_cat ) ); ?>">
						<div class="card-category--content">
							<span class="overlay"></span>
							<p class="block-text"><?php echo esc_html( $shop_cat->description ); ?></p>
							<div class="card-category--title-wrapper flex justify-between items-center w-full">
								<h2 class="card-category--title"><?php echo esc_html( $shop_cat->name ); ?></h2>
								<i class="card-category--arrow"></i>
							</div>
						</div>
					</a>
				</li>
				<?php
			endforeach;
			?>
		</ul>
		<?php
	endif;
}

add_action( 'shop_categories', 'aleandbread_shop_categories', 10 );


// ---------- Email verification settings ----------
const AB_VERIFY_META_KEY      = 'ab_email_verified';
const AB_VERIFY_TOKEN_HASH    = 'ab_email_verify_hash';
const AB_VERIFY_TOKEN_EXPIRES = 'ab_email_verify_expires';
const AB_VERIFY_LAST_SENT     = 'ab_email_verify_last_sent';
const AB_VERIFY_EXPIRY_HOURS  = 48;
const AB_VERIFY_RESEND_COOLDOWN_MIN = 10;

// Do not auto-login new customers
add_filter('woocommerce_registration_auth_new_customer', '__return_false');

// After signup, tell them to check email
add_filter('woocommerce_registration_redirect', function($redirect){
    return home_url('/login/?check-email=1');
});

// Create token + send email (runs AFTER your save hook)
add_action('woocommerce_created_customer', function($customer_id){
    if ( '1' === get_user_meta($customer_id, AB_VERIFY_META_KEY, true) ) return;

    $raw_token = wp_generate_password(32, false);
    $hash      = wp_hash_password($raw_token);
    $expires   = time() + (AB_VERIFY_EXPIRY_HOURS * HOUR_IN_SECONDS);

    update_user_meta($customer_id, AB_VERIFY_TOKEN_HASH, $hash);
    update_user_meta($customer_id, AB_VERIFY_TOKEN_EXPIRES, $expires);
    update_user_meta($customer_id, AB_VERIFY_LAST_SENT, time());
    update_user_meta($customer_id, AB_VERIFY_META_KEY, '0');

    ab_send_verification_email($customer_id, $raw_token);
}, 20); // <= run after your save function

// Block login until verified
add_filter('authenticate', function($user){
    if ( is_wp_error($user) || !($user instanceof WP_User) ) return $user;
    if ( '1' !== get_user_meta($user->ID, AB_VERIFY_META_KEY, true) ) {
        return new WP_Error('ab_email_not_verified', __('Please verify your email to access your account.', 'your-textdomain'));
    }
    return $user;
}, 30);

// Handle verify link
add_action('init', function(){
    if ( ! isset($_GET['ab_verify'], $_GET['uid'], $_GET['token']) ) return;

    $uid   = absint($_GET['uid']);
    $token = sanitize_text_field(wp_unslash($_GET['token']));
    if ( ! $uid || ! $token ) {
        wc_add_notice(__('Invalid verification link.', 'your-textdomain'), 'error');
        wp_safe_redirect( wc_get_page_permalink('myaccount') ); exit;
    }

    $hash    = get_user_meta($uid, AB_VERIFY_TOKEN_HASH, true);
    $expires = (int) get_user_meta($uid, AB_VERIFY_TOKEN_EXPIRES, true);

    if ( empty($hash) || empty($expires) ) {
        wc_add_notice(__('This verification link is invalid or has already been used.', 'your-textdomain'), 'error');
        wp_safe_redirect( wc_get_page_permalink('myaccount') ); exit;
    }
    if ( time() > $expires ) {
        wc_add_notice(__('Your verification link has expired. Please request a new one.', 'your-textdomain'), 'error');
        wp_safe_redirect( wc_get_page_permalink('myaccount') ); exit;
    }
    if ( ! wp_check_password($token, $hash) ) {
        wc_add_notice(__('Invalid verification token.', 'your-textdomain'), 'error');
        wp_safe_redirect( wc_get_page_permalink('myaccount') ); exit;
    }

    update_user_meta($uid, AB_VERIFY_META_KEY, '1');
    delete_user_meta($uid, AB_VERIFY_TOKEN_HASH);
    delete_user_meta($uid, AB_VERIFY_TOKEN_EXPIRES);

    wc_add_notice(__('Your email is verified. You can now log in.', 'your-textdomain'), 'success');
    wp_safe_redirect( wc_get_page_permalink('myaccount') ); // or home_url('/login/')
    exit;
});

// Send the email
function ab_send_verification_email($user_id, $raw_token){
    $user = get_user_by('id', $user_id);
    if ( ! $user ) return;

    $confirm_url = add_query_arg(
        ['ab_verify'=>1, 'uid'=>$user_id, 'token'=>rawurlencode($raw_token)],
        home_url('/') // works across languages; adjust if you prefer language-specific
    );

    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    $subject  = sprintf( __('Confirm your account on %s', 'your-textdomain'), $blogname );

    $first = get_user_meta($user_id, 'first_name', true);
    $hello = $first ? sprintf(__('Hi %s,', 'your-textdomain'), esc_html($first)) : __('Hi there,', 'your-textdomain');

    $message  = '
    <div style="font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:1.5;">
      <p>'.$hello.'</p>
      <p>'.esc_html__('Please confirm your email address to activate your account.', 'your-textdomain').'</p>
      <p><a href="'.esc_url($confirm_url).'" style="display:inline-block;padding:10px 16px;text-decoration:none;border-radius:6px;background:#CC332E;color:#fff;">'.
        esc_html__('Confirm my account', 'your-textdomain').'</a></p>
      <p>'.esc_html__('If the button doesn’t work, copy and paste this link:', 'your-textdomain').'<br>
        <span style="word-break:break-all;">'.esc_url($confirm_url).'</span></p>
      <p>'.sprintf(esc_html__('This link expires in %d hours.', 'your-textdomain'), AB_VERIFY_EXPIRY_HOURS).'</p>
    </div>';

    $mailer  = WC()->mailer();
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    $mailer->send($user->user_email, $subject, $mailer->wrap_message($subject, $message), $headers);
}

// Optional: Resend verification shortcode
add_shortcode('ab_resend_verification', function(){
    if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['ab_resend_nonce']) && wp_verify_nonce($_POST['ab_resend_nonce'], 'ab_resend') ) {
        $email = isset($_POST['ab_resend_email']) ? sanitize_email(wp_unslash($_POST['ab_resend_email'])) : '';
        if ( $email && ($user = get_user_by('email', $email)) ) {
            $uid = $user->ID;
            if ( '1' !== get_user_meta($uid, AB_VERIFY_META_KEY, true) ) {
                $last = (int) get_user_meta($uid, AB_VERIFY_LAST_SENT, true);
                if ( time() - $last >= AB_VERIFY_RESEND_COOLDOWN_MIN * MINUTE_IN_SECONDS ) {
                    $raw_token = wp_generate_password(32, false);
                    $hash      = wp_hash_password($raw_token);
                    $expires   = time() + (AB_VERIFY_EXPIRY_HOURS * HOUR_IN_SECONDS);

                    update_user_meta($uid, AB_VERIFY_TOKEN_HASH, $hash);
                    update_user_meta($uid, AB_VERIFY_TOKEN_EXPIRES, $expires);
                    update_user_meta($uid, AB_VERIFY_LAST_SENT, time());
                    ab_send_verification_email($uid, $raw_token);
                }
            }
        }
        return '<div class="woocommerce-message">'.esc_html__('If an account exists for that email, we’ve sent a new confirmation link.', 'your-textdomain').'</div>';
    }

    ob_start(); ?>
    <form method="post" class="woocommerce-form" style="margin-top:1rem;">
        <p><?php esc_html_e('Didn’t get the email? Enter your address and we’ll resend the confirmation link.', 'your-textdomain'); ?></p>
        <p><input type="email" name="ab_resend_email" required placeholder="<?php esc_attr_e('Email address', 'your-textdomain'); ?>"></p>
        <?php wp_nonce_field('ab_resend', 'ab_resend_nonce'); ?>
        <p><button type="submit" class="button"><?php esc_html_e('Resend verification email', 'your-textdomain'); ?></button></p>
    </form>
    <?php return ob_get_clean();
});

// Optional: Gate My Account for unverified users
add_action('template_redirect', function(){
    if ( is_user_logged_in() && function_exists('is_account_page') && is_account_page() ) {
        $uid = get_current_user_id();
        if ( '1' !== get_user_meta($uid, AB_VERIFY_META_KEY, true) ) {
            wc_add_notice(__('Please verify your email to access your account.', 'your-textdomain'), 'error');
            wp_safe_redirect( home_url('/login/') ); exit;
        }
    }
});


// Validate custom fields during registration.
add_action('woocommerce_register_post', 'aleandbread_validate_extra_register_fields', 10, 3);
function aleandbread_validate_extra_register_fields($username, $email, $validation_errors) {
	if (isset($_POST['first_name']) && empty($_POST['first_name'])) {
		$validation_errors->add('first_name_error', __('First name is required.', 'woocommerce'));
	}
	if (isset($_POST['last_name']) && empty($_POST['last_name'])) {
		$validation_errors->add('last_name_error', __('Last name is required.', 'woocommerce'));
	}
	if (isset($_POST['password']) && isset($_POST['password2']) && $_POST['password'] !== $_POST['password2']) {
		$validation_errors->add('password_mismatch', __('Passwords do not match.', 'woocommerce'));
	}
	if (!isset($_POST['terms'])) {
		$validation_errors->add('terms_error', __('You must accept the terms and privacy policy.', 'woocommerce'));
	}

	return $validation_errors;
}


/**
 * Save extra fields to user meta
 *
 * @param [type] $customer_id
 * @return void
 */
function aleandbread_save_extra_register_fields( $customer_id ) {
	if ( isset( $_POST['first_name'] ) ) :
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) );
	endif;
	if ( isset( $_POST['last_name'] ) ) :
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) );
	endif;
	if ( isset( $_POST['phone'] ) ) :
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( wp_unslash( $_POST['phone'] ) ) );
	endif;
}

add_action( 'woocommerce_created_customer', 'aleandbread_save_extra_register_fields' );




/**
 * Function for `woocommerce_before_shop_loop` action-hook.
 * 
 * @return void
 */
function aleandbread_woocommerce_before_shop_loop_action(){
	woocommerce_output_all_notices();
	?>
	<div class="flex w-full justify-between items-center">
		<?php
		woocommerce_result_count();
		woocommerce_catalog_ordering();
		?>
	</div>
	<?php
}

add_action( 'aleandbread_before_shop_loop_action', 'aleandbread_woocommerce_before_shop_loop_action' );



