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
    return new WP_Error('ab_email_not_verified', __('Bitte verifizieren Sie Ihre E-Mail, um auf Ihr Konto zuzugreifen.', 'aleandbread'));
  }
  return $user;
}, 30);


// Handle verify link
add_action('init', function(){
	if ( ! isset($_GET['ab_verify'], $_GET['uid'], $_GET['token']) ) return;

	$uid   = absint($_GET['uid']);
	$token = sanitize_text_field(wp_unslash($_GET['token']));
	if ( ! $uid || ! $token ) {
		wc_add_notice(__('Ungültiger Bestätigungslink.', 'aleandbread'), 'error');
		wp_safe_redirect( wc_get_page_permalink('myaccount') ); exit;
	}

	$hash    = get_user_meta($uid, AB_VERIFY_TOKEN_HASH, true);
	$expires = (int) get_user_meta($uid, AB_VERIFY_TOKEN_EXPIRES, true);

	if ( empty($hash) || empty($expires) ) {
		wc_add_notice(__('Dieser Bestätigungslink ist ungültig oder wurde bereits verwendet.', 'aleandbread'), 'error');
		wp_safe_redirect( wc_get_page_permalink('myaccount') ); exit;
	}
	if ( time() > $expires ) {
		wc_add_notice(__('Ihr Bestätigungslink ist abgelaufen. Bitte fordern Sie einen neuen an.', 'aleandbread'), 'error');
		wp_safe_redirect( wc_get_page_permalink('myaccount') ); exit;
	}
	if ( ! wp_check_password($token, $hash) ) {
		wc_add_notice(__('Ungültiges Bestätigungstoken.', 'aleandbread'), 'error');
		wp_safe_redirect( wc_get_page_permalink('myaccount') ); exit;
	}

	update_user_meta($uid, AB_VERIFY_META_KEY, '1');
	delete_user_meta($uid, AB_VERIFY_TOKEN_HASH);
	delete_user_meta($uid, AB_VERIFY_TOKEN_EXPIRES);

	wc_add_notice(__('Ihre E-Mail wurde verifiziert. Sie können sich jetzt anmelden.', 'aleandbread'), 'success');
	wp_safe_redirect( wc_get_page_permalink('myaccount') ); // or home_url('/login/')
	exit;
});

// Send the email
function ab_send_verification_email( $user_id, $raw_token ) {
    $user = get_user_by( 'id', $user_id );
    if ( ! $user ) return;

    // Build confirm URL
    $confirm_url = add_query_arg(
        array(
            'ab_verify' => 1,
            'uid'       => $user_id,
            'token'     => rawurlencode( $raw_token ),
        ),
        home_url( '/' )
    );

    $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

    // Subject = what appears in the mailbox list
    $subject = sprintf(
        /* translators: %s: site name */
        __( 'Bestätigen Sie Ihr Konto auf %s', 'aleandbread' ),
        $blogname
    );

    // Heading = large H1 inside the Woo email template
    $heading = __( 'E-Mail-Adresse bestätigen', 'aleandbread' );

    $first = get_user_meta( $user_id, 'first_name', true );
    $hello = $first
        ? sprintf( __( 'Hi %s,', 'aleandbread' ), esc_html( $first ) )
        : __( 'Guten Tag,', 'aleandbread' );

    // Body (will be wrapped by Woo header/footer + styles)
    $message = '
    <div style="font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:1.5;">
        <p>' . esc_html( $hello ) . '</p>
        <p>' . esc_html__( 'Bitte bestätige deine E-Mail-Adresse, um dein Konto zu aktivieren.', 'aleandbread' ) . '</p>
        <p><a href="' . esc_url( $confirm_url ) . '" style="display:inline-block;padding-top:10px; padding-bottom:10px; padding-left:16px; padding-right:16px; text-decoration:none;border-radius:6px;background:#c7a04a;color:#0D0D0D;margim-bottom:24px;">' .
            esc_html__( 'Mein Konto bestätigen', 'aleandbread' ) . '</a></p>
        <p>' . esc_html__( 'Falls die Schaltfläche nicht funktioniert, kopiere bitte diesen Link und füge ihn in deinen Browser ein:', 'aleandbread' ) . '<br>
            <span style="word-break:break-all;">' . esc_url( $confirm_url ) . '</span></p>
        <p>' . sprintf(
            /* translators: %d: hours */
            esc_html__( 'Dieser Link läuft in %d Stunden ab.', 'aleandbread' ),
            (int) AB_VERIFY_EXPIRY_HOURS
        ) . '</p>
    </div>';

    $mailer  = WC()->mailer();
    $headers = array( 'Content-Type: text/html; charset=UTF-8' );

    // Wrap with Woo header/footer (uses your overridden emails/email-header.php with ACF PNG logo)
    $wrapped = $mailer->wrap_message( $heading, $message );

    // Send
    $mailer->send( $user->user_email, $subject, $wrapped, $headers );
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
		return '<div class="woocommerce-message">'.esc_html__('Falls ein Konto für diese E-Mail existiert, haben wir Ihnen einen neuen Bestätigungslink geschickt.', 'aleandbread').'</div>';
	}

	ob_start(); ?>
	<form method="post" class="woocommerce-form" style="margin-top:1rem;">
		<p><?php esc_html_e('Sie haben die E-Mail nicht erhalten? Geben Sie Ihre Adresse ein und wir senden den Bestätigungslink erneut.', 'aleandbread'); ?></p>
		<p><input type="email" name="ab_resend_email" required placeholder="<?php esc_attr_e('E-Mail-Adresse', 'aleandbread'); ?>"></p>
		<?php wp_nonce_field('ab_resend', 'ab_resend_nonce'); ?>
		<p><button type="submit" class="button"><?php esc_html_e('Bestätigungs-E-Mail erneut senden', 'aleandbread'); ?></button></p>
	</form>
	<?php return ob_get_clean();
});

// Optional: Gate My Account for unverified users
add_action('template_redirect', function(){
	if ( is_user_logged_in() && function_exists('is_account_page') && is_account_page() ) {
		$uid = get_current_user_id();
		if ( '1' !== get_user_meta($uid, AB_VERIFY_META_KEY, true) ) {
			wc_add_notice(__('Bitte verifizieren Sie Ihre E-Mail, um auf Ihr Konto zuzugreifen.', 'aleandbread'), 'error');
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
		$actions['ab_verify_user'] = '<a href="'.$url.'">'.esc_html__('E-Mail verifizieren','aleandbread').'</a>';
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
		$validation_errors->add('first_name_error', __('Der Vorname ist erforderlich.', 'aleandbread'));
	}
	if (isset($_POST['last_name']) && empty($_POST['last_name'])) {
		$validation_errors->add('last_name_error', __('Der Nachname ist erforderlich.', 'aleandbread'));
	}
	if (isset($_POST['password']) && isset($_POST['password2']) && $_POST['password'] !== $_POST['password2']) {
		$validation_errors->add('password_mismatch', __('Die Passwörter stimmen nicht überein.', 'aleandbread'));
	}
	if (!isset($_POST['terms'])) {
		$validation_errors->add('terms_error', __('Sie müssen die Geschäftsbedingungen und die Datenschutzrichtlinie akzeptieren.', 'aleandbread'));
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