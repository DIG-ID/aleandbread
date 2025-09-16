<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_main_content' );
?>

<section class="ab-cart relative theme-grid py-10 md:pb-16 md:pt-0 bg-background">
		<div class="col-span-2 md:col-span-6 xl:col-span-8 col-start-1 md:col-start-1 xl:col-start-3">
			<!-- Title (use page title; style in CSS to uppercase like the mock) -->
			<h1 class="text-center text-dark mb-14">
			<?php echo esc_html( get_the_title( wc_get_page_id( 'cart' ) ) ); ?>
			</h1>

			<!-- Stepper -->
			<div class="ab-steps max-w-4xl mx-auto mb-20 hidden xl:flex items-center">
				<div class="step step-active flex items-center gap-3 pb-6 border-b-2 border-dark w-full md:w-[30%] mr-[3.333333%]">
					<span class="step-dot">1</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-dark"><?php esc_html_e( 'Warenkorb', 'aleandbread' ); ?></span>
				</div>
				<div class="step flex items-center gap-3 pb-6 w-full md:w-[30%] mr-[3.333333%]">
					<span class="step-dot-faded">2</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-[#B1B5C3]"><?php esc_html_e( 'Bestelldetails', 'aleandbread' ); ?></span>
				</div>
				<div class="step flex items-center gap-3 pb-6 w-full md:w-[30%] mr-[3.333333%]">
					<span class="step-dot-faded">3</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-[#B1B5C3]"><?php esc_html_e( 'Bestellung abgeschlossen', 'aleandbread' ); ?></span>
				</div>
			</div>
			<div class="grid xl:flex grid-cols-2 md:grid-cols-6 xl:grid-cols-8">
				<div class="col-span-2 md:col-span-6 xl:col-span-8 w-full">
					<?php woocommerce_output_all_notices(); ?>
					<!-- Alternatively: wc_print_notices(); -->
				</div>
			</div>
			<!-- 2‑column layout -->
			<div class="grid xl:flex grid-cols-2 md:grid-cols-6 gap-6 items-start">
			<!-- LEFT: table -->
			<div class="col-span-2 md:col-span-6 xl:col-span-5 xl:w-4/6">
				<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<table class="shop_table shop_table_responsive cart w-full rounded-2xl shadow-sm overflow-hidden">
					<thead class="text-left">
					<tr>
						<th scope="col" class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
						<th scope="col" class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
						<th scope="col" class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
						<th scope="col" class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
					</tr>
					</thead>

					<tbody>
					<?php
					do_action( 'woocommerce_before_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
						$product_permalink = apply_filters(
							'woocommerce_cart_item_permalink',
							$_product->is_visible() ? $_product->get_permalink( $cart_item ) : '',
							$cart_item,
							$cart_item_key
						);
						?>
						<tr class="<?php echo esc_attr( apply_filters(
								'woocommerce_cart_item_class',
								'woocommerce-cart-form__cart-item align-middle',
								$cart_item,
								$cart_item_key
							) ); ?>">

							<!-- PRODUCT -->
							<td class="product-name p-4">
							<div class="flex items-center gap-4">
								<a class="block w-20 h-24 overflow-hidden bg-formFields p-1 min-w-20" href="<?php echo esc_url( $product_permalink ?: '#' ); ?>">
								<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail', ['class' => 'w-full h-full object-cover'] ), $cart_item, $cart_item_key ); ?>
								</a>
								<div class="leading-tight">
								<?php
									$name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
									echo $product_permalink
									? sprintf( '<a href="%s" class="font-barlow text-[16px] leading-[26px] font-semibold text-dark">%s</a>', esc_url( $product_permalink ), esc_html( wp_strip_all_tags( $name ) ) )
									: '<span class="font-medium">' . esc_html( wp_strip_all_tags( $name ) ) . '</span>';

									echo wc_get_formatted_cart_item_data( $cart_item ); // item meta.

									if ( $_product->is_sold_individually() ) {
									echo '<span class="text-xs text-gray-500 ml-1">(' . esc_html__( 'Sold individually', 'woocommerce' ) . ')</span>';
									}
								?>
								<div class="text-xs mt-1">
									<?php
									echo apply_filters(
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="text-gray-500 hover:text-black inline-flex items-center gap-1" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">× %s</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_attr__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() ),
										esc_html__( 'Remove', 'woocommerce' )
									),
									$cart_item_key
									);
									?>
								</div>
								</div>
							</div>
							</td>

							<!-- QUANTITY -->
							<td class="product-quantity p-4">
							<?php
							if ( $_product->is_sold_individually() ) {
								$min_quantity = 1;
								$max_quantity = 1;
							} else {
								$min_quantity = 0;
								$max_quantity = $_product->get_max_purchase_quantity();
							}

							echo apply_filters(
								'woocommerce_cart_item_quantity',
								woocommerce_quantity_input(
								array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'min_value'   => $min_quantity,
									'max_value'   => $max_quantity,
								),
								$_product,
								false // false means "return the markup", true would echo it
								),
								$cart_item_key,
								$cart_item
							);
							?>
							</td>


							<!-- PRICE -->
							<td class="product-price p-4">
							<?php
								echo apply_filters(
								'woocommerce_cart_item_price',
								WC()->cart->get_product_price( $_product ),
								$cart_item,
								$cart_item_key
								);
							?>
							</td>

							<!-- SUBTOTAL -->
							<td class="product-subtotal p-4">
							<?php
								echo apply_filters(
								'woocommerce_cart_item_subtotal',
								WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ),
								$cart_item,
								$cart_item_key
								);
							?>
							</td>
						</tr>
						<?php
						endif;
					}

					do_action( 'woocommerce_cart_contents' );
					?>
					</tbody>
				</table>

				<?php do_action( 'woocommerce_after_cart_table' ); ?>

				<!-- Coupon / Update row (below table like the mock) -->
				<div class="mt-6 flex flex-col sm:flex-row items-start sm:items-center gap-4">
					<div class="flex items-center gap-2">
						<button type="submit" class="btn btn-secondary !px-[8.5px] md:!px-[20px]" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
						<?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
						</button>
					</div>
					
					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</div>
				<div class="woocommerce-form-coupon form-row !mt-6 xl:!mt-20">
					<?php if ( wc_coupons_enabled() ) : ?>
					<p class="font-barlow text-[16px] leading-[26px] font-semibold text-dark mb-2"><?php esc_html_e( 'Haben Sie einen Gutschein?', 'aleandbread' ); ?></p>
					<p class="font-barlow text-[16px] leading-[26px] font-semibold text-[#6C7275] mb-4"><?php esc_html_e( 'Geben Sie Ihren Code ein, um sofort einen Rabatt auf den Warenkorb zu erhalten.', 'aleandbread' ); ?></p>
					<div class="coupon-wrapper flex flex-row items-center gap-5">
						<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
						<input type="text" name="coupon_code" class="input-text px-4 py-[0.85rem] mb-4 sm:mb-0 !w-auto" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon Code', 'woocommerce' ); ?>" />
						<button type="submit" class="button rounded-none px-5" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
						<?php esc_html_e( 'Apply', 'woocommerce' ); ?>
						</button>
					</div>
					<?php do_action( 'woocommerce_cart_coupon' ); ?>
					
					<?php endif; ?>
				</div>
				</form>
			</div>

			<!-- RIGHT: summary -->
			<aside class="col-span-2 md:col-span-6 xl:col-span-3 xl:w-2/6">
				<div class="cart-collaterals">
				<?php
				/**
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
				?>
				</div>
			</aside>
			</div>
		</div>
</section>

<?php do_action( 'woocommerce_after_main_content' ); ?>
