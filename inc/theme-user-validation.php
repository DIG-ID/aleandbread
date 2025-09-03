<?php

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

add_filter('woocommerce_process_login_errors', function($errors){
	if ( is_wp_error($errors) && in_array('ab_email_not_verified', $errors->get_error_codes(), true) ) {
		if ( function_exists('WC') && WC()->session ) {
			WC()->session->set('ab_show_resend', '1');
			}
		}
	return $errors;
}, 10, 3);



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
  if ( user_can($user, 'manage_options') || user_can($user, 'manage_woocommerce') ) return $user;
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

// Admin row action + handler to mark users verified
add_filter('user_row_actions', function($actions, $user){
	if ( current_user_can('manage_options') && '1' !== get_user_meta($user->ID, 'ab_email_verified', true) ) {
		$url = wp_nonce_url(
			add_query_arg(['action'=>'ab_verify_user','user_id'=>$user->ID], admin_url('users.php')),
			'ab_verify_user_'.$user->ID
		);
		$actions['ab_verify_user'] = '<a href="'.$url.'">'.esc_html__('Verify email','your-textdomain').'</a>';
	}
	return $actions;
}, 10, 2);

add_action('admin_init', function(){
	if ( ! isset($_GET['action'], $_GET['user_id']) || 'ab_verify_user' !== $_GET['action'] ) return;
	if ( ! current_user_can('manage_options') ) wp_die('Insufficient permissions.');
	$user_id = absint($_GET['user_id']);
	check_admin_referer('ab_verify_user_'.$user_id);

	update_user_meta($user_id, 'ab_email_verified', '1');
	delete_user_meta($user_id, 'ab_email_verify_hash');
	delete_user_meta($user_id, 'ab_email_verify_expires');

	wp_safe_redirect( add_query_arg('ab_verified', 1, admin_url('users.php')) );
	exit;
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