<?php
/**
 * Pay for order — Ale & Bread layout
 */
defined('ABSPATH') || exit;

do_action('woocommerce_before_main_content');

/** @var WC_Order $order */
$order_id = isset($order_id) ? $order_id : 0;
$order    = $order_id ? wc_get_order($order_id) : false;

// (Optional) Reuse your helper for thumbs from thankyou.php if you like
// function ab_render_order_thumbs( $order ) { ... }

?>
<section class="ab-order-pay relative py-10 md:py-16 bg-background">
  <div class="theme-container">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-6 xl:col-span-8 col-start-1 md:col-start-1 xl:col-start-3">

        <!-- Title + stepper (step 2 active) -->
        <h1 class="text-center text-dark mb-6">
          <?php echo esc_html( get_the_title( wc_get_page_id( 'cart' ) ) ); ?>
        </h1>


        <div class="max-w-3xl mx-auto">
          <div class="ab-card bg-white rounded-[12px] shadow-[0_1px_2px_rgba(0,0,0,.04),0_12px_40px_rgba(0,0,0,.06)] p-8">
            <?php
              // Keep WooCommerce’s native "pay for order" form & hooks intact:
              wc_print_notices();

              do_action( 'woocommerce_before_pay_form', $order );

              if ( $order ) : ?>
                <form id="order_review" method="post">

                  <?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

                  <?php
                    // Renders order lines + totals (via review-order.php) and payment methods (payment.php)
                    wc_get_template( 'checkout/review-order.php', [ 'checkout' => WC()->checkout() ] );
                    wc_get_template( 'checkout/payment.php' ); 
                  ?>

                  <div class="mt-6 text-center">
                    <?php
                      echo apply_filters(
                        'woocommerce_pay_order_button_html',
                        '<button type="submit" class="button rounded-full px-6 py-3" id="place_order" value="' . esc_attr__( 'Pay now', 'woocommerce' ) . '">' . esc_html__( 'Pay now', 'woocommerce' ) . '</button>'
                      );
                    ?>
                    <input type="hidden" name="woocommerce_pay" value="1" />
                  </div>

                  <?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

                </form>
              <?php else : ?>
                <p class="text-center text-[#6C7275]"><?php esc_html_e( 'Invalid order.', 'woocommerce' ); ?></p>
              <?php endif;

              do_action( 'woocommerce_after_pay_form', $order );
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php do_action('woocommerce_after_main_content'); ?>
