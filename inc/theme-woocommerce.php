<?php

/**
 * Remove default WooCommerce wrappers and breadcrumb hook.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10 );
// The following lines are commented out to keep the default WooCommerce result count and catalog ordering visible on the shop loop.
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove default notices from login form.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_customer_login_form', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_lost_password_form', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_reset_password_form', 'wc_print_notices', 10 );

// Add Account Default Content.
if ( false === has_action( 'woocommerce_account_content', 'woocommerce_account_content' ) ) {
	add_action( 'woocommerce_account_content', 'woocommerce_account_content' );
}


/**
 * Custom wrapper start.
 *
 * @return void
 */
function aleandbread_wrapper_start() {
	echo '<main id="main-content" class="main-content overflow-hidden mt-auto pt-[106px]">';
	echo '<div class="theme-container pb-16 md:pb-16 xl:pb-32 pt-12 md:pt-16 xl:pt-24">';
}
add_action( 'woocommerce_before_main_content', 'aleandbread_wrapper_start', 10 );

/**
 * Custom wrapper end.
 *
 * @return void
 */
function aleandbread_wrapper_end() {
	echo '</div></main>';
}
add_action( 'woocommerce_after_main_content', 'aleandbread_wrapper_end', 10 );

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

// Edit the Account Menu Items.
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
				$thumb_id = get_term_meta( $shop_cat->term_id, 'thumbnail_id', true );
				$img = $thumb_id ? wp_get_attachment_image( $thumb_id, 'medium', false, array( 'class' => 'w-full h-auto' ) ) : '';
				$img_url = wp_get_attachment_image_url( $thumb_id, 'full' );
				?>
				<li class="card-category col-span-2 md:col-span-3 xl:col-span-4 overflow-hidden" style="background-image:url(<?php echo esc_url( $img_url ); ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
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

/**
 * This function adds a custom loop with chosen categories through ACF.
 */
function aleandbread_shop_experiences_categories() {
	$parent_cat_id = get_queried_object_id();
	if ( $parent_cat_id ) :
		$children_cat = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'parent'     => $parent_cat_id,
				'hide_empty' => false,
			)
		);
		?>
		<ul class="shop-categories shop-categories--experiences theme-grid">
			<?php
			foreach ( $children_cat as $cc ) :
				$thumb_id = get_term_meta( $cc->term_id, 'thumbnail_id', true );
				$img = $thumb_id ? wp_get_attachment_image( $thumb_id, 'medium', false, array( 'class' => 'w-full h-auto' ) ) : '';
				$img_url = wp_get_attachment_image_url( $thumb_id, 'full' );
				?>
				<li class="card-category card-category--experiences col-span-2 md:col-span-3 xl:col-span-4 mb-5 xl:mb-0" style="background-image:url(<?php echo esc_url( $img_url ); ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
					<a href="<?php echo esc_url( get_term_link( $cc ) ); ?>">
						<div class="card-category--content">
							<span class="overlay"></span>
							<p class="block-text"><?php echo wp_kses_post( $cc->description ); ?></p>
							<div class="card-category--title-wrapper flex justify-between items-center w-full">
								<h2 class="card-category--title"><?php echo esc_html( $cc->name ); ?></h2>
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
add_action( 'shop_experiences_categories', 'aleandbread_shop_experiences_categories', 10 );

/**
 * Customize the product image gallery.
 *
 * @param array $opts The default options.
 * @return array The modified options.
 */
function aleandbread_woo_product_gallery_options( $opts ) {
	// Hide thumbnail strip.
	$opts['controlNav'] = false;
	// Show direction arrows.
	$opts['directionNav'] = true;
	// Smooth slide.
	$opts['animation'] = 'slide';
	// Optional: remove default arrow text; you’ll style with CSS.
	$opts['prevText'] = '';
	$opts['nextText'] = '';

	return $opts;
}
add_filter( 'woocommerce_single_product_carousel_options', 'aleandbread_woo_product_gallery_options' );

/**
 * Output SKU below the title only (without categories/tags).
 */
function aleandbread_product_sku_under_title() {
	global $product;
	if ( ! $product ) {
		return;
	}
	$sku = $product->get_sku();
	if ( ! $sku ) {
		return;
	}
	echo '<p class="product-sku"><span class="label">Art-Nr.:</span> <span class="value">' . esc_html( $sku ) . '</span></p>';
}

/**
 * Simple shipping note after the Add to Cart area.
 */
function aleandbread_shipping_note() {
	global $product;
	// Only show if product is not virtual and not downloadable.
	if ( $product && ! $product->is_virtual() && ! $product->is_downloadable() ) {
		echo '<p class="ship-note">' . esc_html__( 'Bestellungen werden innerhalb von 5 bis 10 Werktagen versendet.', 'aleandbread' ) . '</p>';
	}
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

add_action( 'woocommerce_single_product_summary', 'aleandbread_product_sku_under_title', 12 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
// Keep the add to cart at 30 (default includes quantity input for simple products).
add_action( 'woocommerce_single_product_summary', 'aleandbread_shipping_note', 35 );
