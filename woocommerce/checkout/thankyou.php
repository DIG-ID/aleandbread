<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_main_content');

// Keep the $order WooCommerce passes in, or fetch it from the URL if needed.
if ( empty( $order ) || ! is_a( $order, 'WC_Order' ) ) {
    $received_id = absint( get_query_var( 'order-received' ) );
    if ( $received_id ) {
        $order = wc_get_order( $received_id );
    }
}


// Helper: small function to render item thumbnails with qty badges.
function ab_render_order_thumbs( $order ) {
  if ( ! $order ) return;
  $i = 0;
  foreach ( $order->get_items() as $item_id => $item ) {
    $product = $item->get_product();
    if ( ! $product ) continue;
    $thumb = $product->get_image( 'woocommerce_thumbnail', [ 'class' => 'w-full h-full object-cover' ] );
    $qty   = $item->get_quantity();
    echo '<div class="ab-thumb relative w-[72px] h-[96px] rounded-[6px] overflow-hidden bg-[#F3F4F6] flex items-center justify-center">';
    echo $thumb ?: '<span class="block w-[40px] h-[40px] bg-[#e5e7eb]"></span>';
    echo '<span class="ab-badge absolute -top-2 -right-2">' . esc_html( $qty ) . '</span>';
    echo '</div>';
    $i++;
    if ( $i >= 3 ) break; // show up to 3 like the mock
  }
}
?>

<section class="ab-thankyou theme-grid relative py-10 md:py-16">
  <div class="col-span-2 md:col-span-6 xl:col-span-8 col-start-1 md:col-start-1 xl:col-start-3">

    <!-- Title + stepper (step 3 active) -->
    <h1 class="text-center text-dark mb-14"><?php echo esc_html( get_the_title( wc_get_page_id( 'cart' ) ) ); ?></h1>

    <div class="ab-steps max-w-4xl mx-auto mb-16 hidden xl:flex items-center justify-between">
      <div class="step flex items-center gap-3 w-full mr-[3.333333%]">
        <span class="step-dot-done">✓</span>
        <span class="font-barlow text-[16px] leading-[26px] font-semibold text-[#38CB89]"><?php esc_html_e('Warenkorb','aleandbread'); ?></span>
      </div>
      <div class="step flex items-center gap-3 w-full mr-[3.333333%]">
        <span class="step-dot-done">✓</span>
        <span class="font-barlow text-[16px] leading-[26px] font-semibold text-[#38CB89]"><?php esc_html_e('Bestelldetails','aleandbread'); ?></span>
      </div>
      <div class="step step-active flex items-center gap-3 w-full">
        <span class="step-dot">3</span>
        <span class="font-barlow text-[16px] leading-[26px] font-semibold text-dark"><?php esc_html_e('Bestellung abgeschlossen','aleandbread'); ?></span>
      </div>
    </div>

    <?php if ( $order && $order->has_status('failed') ) : ?>

      <div class="max-w-3xl mx-auto">
        <div class="ab-card bg-white rounded-[12px] shadow-[0_1px_2px_rgba(0,0,0,.04),0_12px_40px_rgba(0,0,0,.06)] px-12 py-10 md:px-24 md:py-20 text-center">
          <h2 class="text-[22px] font-semibold mb-2"><?php esc_html_e( 'Payment failed', 'woocommerce' ); ?></h2>
          <p class="text-[#6C7275] mb-6"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></p>
          <div class="flex items-center justify-center gap-3">
            <a class="button" href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"><?php esc_html_e( 'Try again', 'woocommerce' ); ?></a>
            <?php if ( is_user_logged_in() ) : ?>
              <a class="button" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>

    <?php else : ?>

      <!-- Centered success card -->
      <div class="max-w-3xl mx-auto">
        <div class="ab-card bg-white rounded-[12px] shadow-[0_1px_2px_rgba(0,0,0,.04),0_12px_40px_rgba(0,0,0,.06)] px-12 py-10 md:px-24 md:py-20 text-center">

          <p class="text-[#6C7275] font-barlow text-[28px] font-medium tracking-[-0.6px] mb-2"><?php esc_html_e('Thank you! 🎉','aleandbread'); ?></p>
          <p class="text-[22px] md:text-[40px] leading-tight font-medium text-dark mb-6 max-w-[492px] mx-auto"><?php esc_html_e('Ihre Bestellung ist eingegangen','aleandbread'); ?></p>

          <!-- Thumbnails row -->
          <div class="flex items-center justify-center gap-6 mb-8">
            <?php if ( $order ) { ab_render_order_thumbs( $order ); } ?>
          </div>

          <?php if ( $order ) : ?>
            <div class="ab-meta grid gap-2 justify-center text-left max-w-sm mx-auto mb-6 text-[14px]">
              <div class="flex justify-between gap-6">
                <span class="text-[#6C7275] text-base"><?php esc_html_e('Order code:','woocommerce'); ?></span>
                <span class="font-semibold text-base text-dark">#<?php echo esc_html( $order->get_order_number() ); ?></span>
              </div>
              <div class="flex justify-between gap-6">
                <span class="text-[#6C7275] text-base"><?php esc_html_e('Date:','woocommerce'); ?></span>
                <span class="font-semibold text-base text-dark"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></span>
              </div>
              <div class="flex justify-between gap-6">
                <span class="text-[#6C7275] text-base"><?php esc_html_e('Total:','woocommerce'); ?></span>
                <span class="font-semibold text-base text-dark"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
              </div>
              <?php if ( $order->get_payment_method_title() ) : ?>
                <div class="flex justify-between gap-6">
                  <span class="text-[#6C7275] text-base"><?php esc_html_e('Payment method:','woocommerce'); ?></span>
                  <span class="font-semibold text-base text-dark"><?php echo esc_html( $order->get_payment_method_title() ); ?></span>
                </div>
              <?php endif; ?>
            </div>

            <div class="mt-6">
              <?php if ( is_user_logged_in() ) : ?>
                <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="button rounded-full px-6 py-3">
                  <?php esc_html_e('Purchase history','woocommerce'); ?>
                </a>
              <?php else : ?>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="button rounded-full px-6 py-3">
                  <?php esc_html_e('Continue shopping','woocommerce'); ?>
                </a>
              <?php endif; ?>
              <?php
              //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
              //do_action( 'woocommerce_thankyou', $order->get_id() );
              ?>
            </div>
          <?php else : ?>
            <p class="text-[#6C7275]"><?php esc_html_e('Thank you. Your order has been received.','woocommerce'); ?></p>
            <?php //do_action( 'woocommerce_thankyou', 0 ); ?>
          <?php endif; ?>

        </div>
      </div>


    <?php endif; ?>

  </div>
</section>

<?php do_action('woocommerce_after_main_content'); ?>
