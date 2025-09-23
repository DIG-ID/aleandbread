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

// Remove default notices.
remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_checkout_before_customer_details', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_customer_login_form', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_lost_password_form', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_reset_password_form', 'wc_print_notices', 10 );

// Add Account Default Content.
if ( false === has_action( 'woocommerce_account_content', 'woocommerce_account_content' ) ) {
	add_action( 'woocommerce_account_content', 'woocommerce_account_content' );
}

// Enqueue once (theme or plugin); or inline this <script> on the checkout page.
add_action( 'wp_footer', function () {
  if ( ! is_checkout() ) return; ?>
  <script>
  jQuery(function($){
    var $target = $('#checkout-notices'); // your desired container
    if (!$target.length) return;

    function moveNotices(){
      var $first = $('.woocommerce .woocommerce-NoticeGroup-checkout, .woocommerce .woocommerce-notices-wrapper').first();
      if ($first.length && !$first.is($target)) {
        // Move all notice content into your container
        $target.empty().append($first.contents());
      }
    }
    // On initial load and whenever Woo fires an error
    moveNotices();
    $(document.body).on('checkout_error', moveNotices);
  });
  </script>
<?php });


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
	<div class="flex w-full justify-between items-end">
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
				'delimiter'   => ' / ',
				'wrap_before' => '<div class="theme-grid"><div class="col-start-1 col-span-2 md:col-span-3 xl:col-start-2 xl:col-span-4 pb-[30px] md:pb-[56px] xl:pb-[58px] w-full"><nav class="woocommerce-breadcrumb">',
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
				<li class="card-category col-span-2 md:col-span-3 xl:col-span-6 mb-5 overflow-hidden" style="background-image:url(<?php echo esc_url( $img_url ); ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
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
				<li class="card-category card-category--experiences col-span-2 md:col-span-3 xl:col-span-4 mb-5 xl:mb-0 overflow-hidden" style="background-image:url(<?php echo esc_url( $img_url ); ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
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
	echo '<span class="product-sku"><span class="label">Art-Nr.:</span> <span class="value">' . esc_html( $sku ) . '</span></span>';
}

/**
 * Refresh the header cart count badge when the cart updates via AJAX
 */
add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
    ob_start();
    $count = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
    ?>
    <span
      id="header-cart-count"
      class="absolute -top-2 -right-2 min-w-[22px] h-[22px] px-1 flex items-center justify-center text-[12px] leading-none font-bold bg-accent text-dark rounded-full <?php echo $count ? '' : 'hidden'; ?>" aria-label="<?php echo esc_attr( $count . ' items in cart' ); ?>"
    >
      <?php echo esc_html( $count ); ?>
    </span>
    <?php
    $fragments['#header-cart-count'] = ob_get_clean();
    return $fragments;
});


/**
 * Simple shipping note after the Add to Cart area.
 */
function aleandbread_shipping_note() {
	global $product;
	// Only show if product is not virtual and not downloadable.
	console_log( $product );
	if ( $product && ! $product->is_virtual() && ! $product->is_downloadable() && ! $product->is_type( 'wgm_gift_card' ) ) {
		?>
		<div class="flex flex-col gap-y-2 my-8">
			<div class="flex items-center gap-x-2">
				<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.5 5.125V9.5L12.125 12.125M1.625 9.5C1.625 10.5342 1.82869 11.5582 2.22445 12.5136C2.6202 13.4691 3.20027 14.3372 3.93153 15.0685C4.6628 15.7997 5.53093 16.3798 6.48637 16.7756C7.44181 17.1713 8.46584 17.375 9.5 17.375C10.5342 17.375 11.5582 17.1713 12.5136 16.7756C13.4691 16.3798 14.3372 15.7997 15.0685 15.0685C15.7997 14.3372 16.3798 13.4691 16.7756 12.5136C17.1713 11.5582 17.375 10.5342 17.375 9.5C17.375 7.41142 16.5453 5.40838 15.0685 3.93153C13.5916 2.45469 11.5886 1.625 9.5 1.625C7.41142 1.625 5.40838 2.45469 3.93153 3.93153C2.45469 5.40838 1.625 7.41142 1.625 9.5Z" stroke="#6C7275" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<p class="ship-note block-text text-[#6C7275] !text-base"><?php esc_html_e( 'Bestellungen werden innerhalb von 5 bis 10 Werktagen versendet.', 'aleandbread' ); ?></p>
			</div>
			<div class="flex items-center gap-x-2">
				<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.5 13V8M9.5 5V4.5M1.625 8.875C1.625 9.90916 1.82869 10.9332 2.22445 11.8886C2.6202 12.8441 3.20027 13.7122 3.93153 14.4435C4.6628 15.1747 5.53093 15.7548 6.48637 16.1506C7.44181 16.5463 8.46584 16.75 9.5 16.75C10.5342 16.75 11.5582 16.5463 12.5136 16.1506C13.4691 15.7548 14.3372 15.1747 15.0685 14.4435C15.7997 13.7122 16.3798 12.8441 16.7756 11.8886C17.1713 10.9332 17.375 9.90916 17.375 8.875C17.375 6.78642 16.5453 4.78338 15.0685 3.30653C13.5916 1.82969 11.5886 1 9.5 1C7.41142 1 5.40838 1.82969 3.93153 3.30653C2.45469 4.78338 1.625 6.78642 1.625 8.875Z" stroke="#6C7275" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<p class="taxes-note block-text text-[#6C7275] !text-base"><?php esc_html_e( 'inkl. MwSt. Versand wird beim Checkout berechnet', 'aleandbread' ); ?></p>
			</div>
		</div>
		<?php
	}
}

/**
 * Simple shipping note after the Add to Cart area.
 */
function aleandbread_product_experiences_cf() {
	$location = get_field( 'location' );
	$duration = get_field( 'duration' );
	$capacity = get_field( 'capacity' );
	if ( $location && $duration && $capacity ) :
		?>
		<div class="icons flex items-center gap-x-4 mb-9">
			<div class="capcity">
				<p class="text-blockText"><?php the_field( 'capacity' ); ?></p>
			</div>
			<div class="duration flex items-center">
				<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
					<path d="M9.5 5.125V9.5L12.125 12.125M1.625 9.5C1.625 10.5342 1.82869 11.5582 2.22445 12.5136C2.6202 13.4691 3.20027 14.3372 3.93153 15.0685C4.6628 15.7997 5.53093 16.3798 6.48637 16.7756C7.44181 17.1713 8.46584 17.375 9.5 17.375C10.5342 17.375 11.5582 17.1713 12.5136 16.7756C13.4691 16.3798 14.3372 15.7997 15.0685 15.0685C15.7997 14.3372 16.3798 13.4691 16.7756 12.5136C17.1713 11.5582 17.375 10.5342 17.375 9.5C17.375 7.41142 16.5453 5.40838 15.0685 3.93153C13.5916 2.45469 11.5886 1.625 9.5 1.625C7.41142 1.625 5.40838 2.45469 3.93153 3.93153C2.45469 5.40838 1.625 7.41142 1.625 9.5Z" stroke="#CC9933" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<p class="text-blockText"><?php the_field( 'duration' ); ?></p>
			</div>
			<div class="location flex items-center">
				<svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
					<path d="M3.40146 3.75953C4.89178 2.29902 6.89826 1.48566 8.98489 1.49619C11.0715 1.50673 13.0697 2.34032 14.5452 3.81581C16.0207 5.2913 16.8543 7.28946 16.8648 9.37609C16.8753 11.4627 16.062 13.4692 14.6015 14.9595L10.4155 19.1455C10.0404 19.5205 9.53179 19.7311 9.00146 19.7311C8.47113 19.7311 7.96252 19.5205 7.58746 19.1455L3.40146 14.9595C1.91635 13.4743 1.08203 11.4599 1.08203 9.35953C1.08203 7.25915 1.91635 5.24479 3.40146 3.75953Z" stroke="#CC9933" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9 12.3594C10.6569 12.3594 12 11.0162 12 9.35937C12 7.70252 10.6569 6.35938 9 6.35938C7.34315 6.35938 6 7.70252 6 9.35937C6 11.0162 7.34315 12.3594 9 12.3594Z" stroke="#CC9933" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<p class="text-blockText"><?php the_field( 'location' ); ?></p>
			</div>

		</div>
		<?php
	else :
		return;
	endif;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

add_action( 'woocommerce_single_product_summary', 'aleandbread_product_sku_under_title', 12 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
add_action( 'woocommerce_single_product_summary', 'aleandbread_product_experiences_cf', 13 );
// Keep the add to cart at 30 (default includes quantity input for simple products).
add_action( 'woocommerce_single_product_summary', 'aleandbread_shipping_note', 35 );


/**
 * Show "Von {min}" ONLY when variations have different prices.
 */
function aleandbread_lid_from_price_only( $price_html, $product ) {
	if ( ! $product || ! $product->is_type( 'variable' ) ) {
		return $price_html;
	}

	// Respeita a definição de exibir preços com/sem IVA (para "loja").
	$min = (float) $product->get_variation_price( 'min', true );
	$max = (float) $product->get_variation_price( 'max', true );

	// Se o preço mínimo e máximo forem iguais, mantém o HTML original.
	$dec = wc_get_price_decimals();
	if ( wc_format_decimal( $min, $dec ) === wc_format_decimal( $max, $dec ) ) {
		return $price_html;
	}

	// Caso contrário, mostra "Von {min}".
	return sprintf(
		'<span class="from-label">%s</span> %s',
		esc_html__( 'Von', 'aleandbread' ),
		wc_price( $min ) // formata com moeda/decimais da loja
	);
}
add_filter( 'woocommerce_variable_price_html', 'aleandbread_lid_from_price_only', 10, 2 );
add_filter( 'woocommerce_variable_sale_price_html', 'aleandbread_lid_from_price_only', 10, 2 );


// Conditionally hide "Product Series Menu" widget on parent product category pages without children in the menu.
add_filter('widget_display_callback', function ($instance, $widget) {
  if ($widget->id_base !== 'nav_menu' || ! is_product_category()) return $instance;

  $term = get_queried_object();
  if ( ! $term || is_wp_error($term) ) return $instance;

   $TARGET_MENU_NAMES = ['Product Series Menu', 'Produkt-Serie'];

  $menu_id = isset($instance['nav_menu']) ? (int) $instance['nav_menu'] : 0;
  if ( ! $menu_id ) return $instance;

  $menu_obj = wp_get_nav_menu_object($menu_id);
  if ( ! $menu_obj || ! in_array($menu_obj->name, $TARGET_MENU_NAMES, true) ) {
    return $instance;
  }

  if ($term->parent) return false;

  $items = wp_get_nav_menu_items($menu_id, ['update_post_term_cache' => false]);
  if ( ! $items ) return false;

  $parent_id = (int) $term->term_id;
  foreach ($items as $item) {
    if ($item->object === 'product_cat') {
      $cat = get_term($item->object_id, 'product_cat');
      if ($cat && ! is_wp_error($cat) && (int) $cat->parent === $parent_id) {
        return $instance; // keep widget
      }
    }
  }
  return false;
}, 10, 2);


// Disable zoom, lightbox and slider on products in the "Erlebnisse" category tree.
add_filter( 'woocommerce_single_product_zoom_enabled', 'ab_disable_zoom_for_erlebnisse', 10, 1 );

function ab_disable_zoom_for_erlebnisse( $enabled ) {
	// Only on single product pages
	if ( ! is_product() ) {
		return $enabled;
	}

	global $product;
	if ( ! $product instanceof WC_Product ) {
		return $enabled;
	}

	// 1) Get the top category by slug
	$top = get_term_by( 'slug', 'erlebnisse', 'product_cat' );
	if ( ! $top || is_wp_error( $top ) ) {
		return $enabled;
	}

	// 2) Collect all descendant term IDs (plus the top itself), once per request
	static $erlebnisse_tree_ids = null;
	if ( $erlebnisse_tree_ids === null ) {
		$children = get_terms( [
			'taxonomy'   => 'product_cat',
			'child_of'   => $top->term_id,
			'fields'     => 'ids',
			'hide_empty' => false,
		] );
		$erlebnisse_tree_ids = array_unique( array_merge( [ $top->term_id ], (array) $children ) );
	}

	// 3) If product has any of those terms, disable zoom/lightbox/slider
	if ( has_term( $erlebnisse_tree_ids, 'product_cat', $product->get_id() ) ) {
		return false;
	}

	return $enabled;
}


// Add parent category slug as body class on single product pages.
add_filter( 'body_class', function( array $classes ) {
	// Só em páginas de produto
	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return $classes;
	}

	$terms = get_the_terms( get_the_ID(), 'product_cat' );
	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return $classes;
	}

	foreach ( $terms as $t ) {
		$ancestors = get_ancestors( $t->term_id, 'product_cat' );
		if ( ! empty( $ancestors ) ) {
			$top_id = end( $ancestors ); // último = topo da árvore
			$top    = get_term( (int) $top_id, 'product_cat' );
			if ( $top && ! is_wp_error( $top ) ) {
				$classes[] = 'parent_cat-' . sanitize_html_class( $top->slug );
			}
		}
	}

	return array_values( array_unique( $classes ) );
}, 10 );



add_action( 'woocommerce_single_product_summary', 'aleandbread_product_back_button', 4 );

function aleandbread_product_back_button() {
	global $product;
	if ( ! $product ) {
		$product = wc_get_product( get_the_ID() );
	}

	$target_url = '';
	$label      = '';

	if ( $product instanceof WC_Product ) {
		$cat_ids = $product->get_category_ids();

		if ( ! empty( $cat_ids ) ) {
			$term = get_term( (int) $cat_ids[0], 'product_cat' );
			if ( $term && ! is_wp_error( $term ) ) {
				$target_url = get_term_link( $term, 'product_cat' );
				$label      = sprintf( __( 'Zur Kategorie %s', 'aleandbread' ), $term->name );
			}
		}
	}

	if ( empty( $target_url ) ) {
		// Fallback to Shop page.
		$target_url = wc_get_page_permalink( 'shop' );
		$label      = __( 'Zum Shop', 'aleandbread' );
	}
	?>
	<div class="flex items-center gap-3 mb-2">
		<a href="<?php echo esc_url( $target_url ); ?>" class="flex items-center gap-2 text-[#0D0D0D] font-barlow text-sm md:text-[16px] not-italic font-semibold md:leading-[13px] uppercase mb-4">
			<svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="inline-block max-w-4 md:max-w-8">
				<path d="M0.497044 6.96965C0.10652 7.36017 0.10652 7.99334 0.497044 8.38386L6.86101 14.7478C7.25153 15.1383 7.88469 15.1383 8.27522 14.7478C8.66574 14.3573 8.66574 13.7241 8.27522 13.3336L2.61836 7.67676L8.27522 2.0199C8.66574 1.62938 8.66574 0.996212 8.27522 0.605688C7.8847 0.215164 7.25153 0.215163 6.86101 0.605688L0.497044 6.96965ZM32 7.67676L32 6.67676L1.20415 6.67676L1.20415 7.67676L1.20415 8.67676L32 8.67676L32 7.67676Z" fill="#0D0D0D"/>
			</svg>
			<span class="md:mb-1"><?php echo esc_html( $label ); ?></span>
		</a>
	</div>
	<?php
}


// Abrir o wrapper antes do input de quantidade
add_action( 'woocommerce_before_add_to_cart_quantity', function () {
	echo '<div class="ab-addtocart-wrapper">'; // Tailwind opcional
}, 0 );

// Fechar o wrapper depois do botão
add_action( 'woocommerce_after_add_to_cart_button', function () {
	echo '</div>';
}, 5 );