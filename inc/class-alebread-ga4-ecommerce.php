<?php
/**
 * Plugin Name: Ale & Bread - GA4 Ecommerce via GTM
 * Description: Pushes GA4 ecommerce events (view_item, add_to_cart, begin_checkout, purchase) to the dataLayer for WooCommerce. GA4 is configured in GTM.
 * Author: Ale & Bread
 * Version: 1.0.0
 *
 * @package aleandbread
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bootstrap only after plugins are loaded and only if WooCommerce is active.
 */
add_action(
	'plugins_loaded',
	function () {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return; // Do nothing if WooCommerce is not active.
		}

		AleBread_GA4_Ecommerce::init();
	}
);

/**
 * GA4 Ecommerce tracking class for WooCommerce.
 *
 * Handles server-side event tracking for GA4 ecommerce events
 * (view_item, add_to_cart, begin_checkout, purchase) via GTM dataLayer.
 */
class AleBread_GA4_Ecommerce {

	const SESSION_KEY_ADD_TO_CART = 'ab_ga4_last_add_to_cart';

	/**
	 * Entry point.
	 */
	public static function init() {

		// Product detail page: view_item.
		add_action( 'wp_footer', array( __CLASS__, 'output_view_item' ), 20 );

		// Checkout page (excluding thank-you): begin_checkout.
		add_action( 'wp_footer', array( __CLASS__, 'output_begin_checkout' ), 20 );

		// Thank-you page: purchase.
		add_action( 'woocommerce_thankyou', array( __CLASS__, 'output_purchase' ), 20, 1 );

		// Capture add_to_cart server-side and output JS on next page load.
		add_action( 'woocommerce_add_to_cart', array( __CLASS__, 'capture_add_to_cart' ), 10, 6 );
		add_action( 'wp_footer', array( __CLASS__, 'output_add_to_cart' ), 20 );
	}

	/**
	 * Consent gate.
	 *
	 * IMPORTANT:
	 * - Replace this logic with your CMP / consent integration.
	 * - Alternatively, hook into the filter:
	 *     apply_filters( 'ab_ga4_user_has_consented', true );
	 */
	protected static function user_has_consented() {
			$consent = true;

			// Example: integrate with a CMP cookie or option here.
			// $consent = isset( $_COOKIE['my_cmp_analytics'] ) && $_COOKIE['my_cmp_analytics'] === '1'; ??

			/**
			 * Allow external code to override the consent decision.
			 * Usage:
			 *   add_filter( 'ab_ga4_user_has_consented', function( $default ) {
			 *       // Custom logic...
			 *       return $default;
			 *   });
			 */
			return apply_filters( 'ab_ga4_user_has_consented', $consent );
	}

	/**
	 * View_item – fires on single product pages.
	 */
	public static function output_view_item() {
		if ( ! is_product() ) {
			return;
		}

		if ( ! self::user_has_consented() ) {
			return;
		}

		global $product;

		if ( ! $product instanceof WC_Product ) {
			return;
		}

		$item = array(
			'item_id'   => (string) ( $product->get_sku() ? $product->get_sku() : $product->get_id() ),
			'item_name' => (string) $product->get_name(),
			'price'     => (float) wc_get_price_to_display( $product ),
		);

		$currency = get_woocommerce_currency();
		?>
		<script>
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			event: "view_item",
			ecommerce: {
				currency: <?php echo wp_json_encode( $currency ); ?>,
				items: [<?php echo wp_json_encode( $item ); ?>]
			}
		});
		</script>
		<?php
	}

	/**
	 * Capture add_to_cart on the server side.
	 * This runs whenever WooCommerce adds an item to the cart.
	 *
	 * @param string $cart_item_key   Cart item key.
	 * @param int    $product_id      Product ID.
	 * @param int    $quantity        Quantity added to cart.
	 * @param int    $variation_id    Variation ID (if any).
	 * @param array  $variation       Variation attributes.
	 * @param array  $cart_item_data  Additional cart item data.
	 */
	public static function capture_add_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
		if ( ! self::user_has_consented() ) {
			return;
		}

		$product = wc_get_product( $variation_id ? $variation_id : $product_id );
		if ( ! $product ) {
			return;
		}

		$item = array(
			'item_id'   => (string) ( $product->get_sku() ?: $product->get_id() ),
			'item_name' => (string) $product->get_name(),
			'quantity'  => (float) $quantity,
			'price'     => (float) wc_get_price_to_display( $product ),
		);

		if ( function_exists( 'WC' ) && WC()->session ) {
			WC()->session->set( self::SESSION_KEY_ADD_TO_CART, $item );
		}
	}

	/**
	 * Add_to_cart – prints the dataLayer push on the next full page load.
	 * This is more robust than scraping DOM or relying on theme-specific JS.
	 */
	public static function output_add_to_cart() {
		if ( ! function_exists( 'WC' ) || ! WC()->session ) {
			return;
		}

		if ( ! self::user_has_consented() ) {
			return;
		}

		$item = WC()->session->get( self::SESSION_KEY_ADD_TO_CART );

		if ( empty( $item ) || ! is_array( $item ) ) {
			return;
		}

		$currency = get_woocommerce_currency();

		// Clear the session flag so the event is not duplicated.
		WC()->session->__unset( self::SESSION_KEY_ADD_TO_CART );
		?>
		<script>
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			event: "add_to_cart",
			ecommerce: {
				currency: <?php echo wp_json_encode( $currency ); ?>,
				items: [<?php echo wp_json_encode( $item ); ?>]
			}
		});
		</script>
		<?php
	}

	/**
	 * Begin_checkout – fires on the checkout page (excluding thank-you page).
	 */
	public static function output_begin_checkout() {
		// is_checkout() includes the thank-you page; we explicitly exclude order-received.
		if ( ! is_checkout() || is_order_received_page() ) {
			return;
		}

		if ( ! self::user_has_consented() ) {
			return;
		}

		if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
			return;
		}

		$cart = WC()->cart;

		if ( $cart->is_empty() ) {
			return;
		}

		$items = array();

		foreach ( $cart->get_cart() as $cart_item ) {
			$product = $cart_item['data'];

			if ( ! $product instanceof WC_Product ) {
				continue;
			}

			$qty = $cart_item['quantity'];

			$items[] = array(
				'item_id'   => (string) ( $product->get_sku() ?: $product->get_id() ),
				'item_name' => (string) $product->get_name(),
				'quantity'  => (float) $qty,
				'price'     => (float) wc_get_price_to_display( $product ),
			);
		}

		if ( empty( $items ) ) {
			return;
		}

		$currency = get_woocommerce_currency();

		// Approximate value as cart subtotal + shipping + fees - discounts.
		$value = (float) $cart->get_cart_contents_total()
				+ (float) $cart->get_shipping_total()
				+ (float) $cart->get_fee_total()
				- (float) $cart->get_discount_total();
		?>
		<script>
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			event: "begin_checkout",
			ecommerce: {
				currency: <?php echo wp_json_encode( $currency ); ?>,
				value: <?php echo esc_js( $value ); ?>,
				items: <?php echo wp_json_encode( $items ); ?>
			}
		});
		</script>
		<?php
	}

	/**
	 * Purchase – fires on the thank-you page via woocommerce_thankyou.
	 *
	 * @param int $order_id The order ID.
	 */
	public static function output_purchase( $order_id ) {
		if ( ! $order_id ) {
			return;
		}

		if ( ! self::user_has_consented() ) {
			return;
		}

		$order = wc_get_order( $order_id );
		if ( ! $order ) {
			return;
		}

		$items = array();

		foreach ( $order->get_items() as $item_id => $item ) {
			$product = $item->get_product();
			if ( ! $product ) {
				continue;
			}

			$qty   = $item->get_quantity();
			$price = $order->get_item_total( $item, false ); // unit price, excl. tax by default.

			$items[] = array(
				'item_id'   => (string) ( $product->get_sku() ?: $product->get_id() ),
				'item_name' => (string) $product->get_name(),
				'quantity'  => (float) $qty,
				'price'     => (float) $price,
			);
		}

		if ( empty( $items ) ) {
			return;
		}

		$data = array(
			'transaction_id' => (string) $order->get_order_number(),
			'currency'       => (string) $order->get_currency(), // per-order, supports multi-currency setups.
			'value'          => (float) $order->get_total(),
			'shipping'       => (float) $order->get_shipping_total(),
			'items'          => $items,
		);
		?>
		<script>
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			event: "purchase",
			ecommerce: <?php echo wp_json_encode( $data ); ?>
		});
		</script>
		<?php
	}

}
