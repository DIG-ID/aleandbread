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
    if ( is_account_page() && ! is_user_logged_in() && ! is_page( 'login' ) ) {
        wp_redirect( site_url( '/login/' ) );
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
				'wrap_before' => '<div class="theme-grid"><div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-2 pb-[30px] md:pb-[56px] xl:pb-[58px] w-full"><nav class="woocommerce-breadcrumb">',
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
