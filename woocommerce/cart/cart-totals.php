<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;
if ( ! WC()->cart || WC()->cart->is_empty() ) { return; }
?>
<div class="ab-summary bg-[#F6F6F6] rounded-md border-[#CBCBCB] shadow-sm p-5">
  <p class="font-barlow text-[16px] leading-[26px] font-semibold text-dark mb-4"><?php esc_html_e( 'Cart summary', 'woocommerce' ); ?></p>

  <div class="space-y-3 font-barlow text-[16px] leading-[26px] font-semibold text-dark">
    <div class="flex justify-between">
      <span><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
      <span><?php wc_cart_totals_subtotal_html(); ?></span>
    </div>

    <?php if ( wc_shipping_enabled() && WC()->cart->needs_shipping() ) : ?>
      <div class="shipping overflow-hidden">
        <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
        <?php wc_cart_totals_shipping_html(); ?>
        <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
      </div>
    <?php endif; ?>

    <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
      <div class="flex justify-between">
        <span><?php echo esc_html( $fee->name ); ?></span>
        <span><?php wc_cart_totals_fee_html( $fee ); ?></span>
      </div>
    <?php endforeach; ?>

    <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
      <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
          <div class="flex justify-between">
            <span><?php echo esc_html( $tax->label ); ?></span>
            <span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="flex justify-between">
          <span><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
          <span><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></span>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <div class="flex justify-between font-semibold text-base pt-2 border-t">
      <span><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
      <span><?php wc_cart_totals_order_total_html(); ?></span>
    </div>
  </div>

  <div class="mt-5">
    <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
  </div>
</div>
<?php do_action( 'woocommerce_after_cart_totals' ); ?>