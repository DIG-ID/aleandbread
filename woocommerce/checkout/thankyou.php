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
    echo '<div class="ab-thumb relative w-[80px] h-[96px] overflow-hidden bg-[#F3F4F6] flex items-center justify-center">';
    echo $thumb ?: '<span class="block w-[40px] h-[40px] bg-[#e5e7eb]"></span>';
    echo '<span class="ab-badge absolute -top-2 -right-2">' . esc_html( $qty ) . '</span>';
    echo '</div>';
    $i++;
    if ( $i >= 3 ) break; // show up to 3 like the mock
  }
}
?>

<section class="ab-thankyou theme-grid relative py-10 md:pb-16 md:pt-0">
  <div class="col-span-2 md:col-span-6 xl:col-span-8 col-start-1 md:col-start-1 xl:col-start-3">

    <!-- Title + stepper (step 3 active) -->
    <h1 class="text-center text-dark mb-14"><?php echo esc_html( get_the_title( wc_get_page_id( 'cart' ) ) ); ?></h1>

    <div class="ab-steps max-w-4xl mx-auto mb-20 hidden xl:flex items-center justify-between">
      <div class="step step-active flex items-center gap-3 pb-6 border-b-2 border-[#38CB89] w-full md:w-[30%] mr-[3.333333%]">
        <span class="step-dot-done">✓</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-[#38CB89]"><?php esc_html_e( 'Warenkorb', 'aleandbread' ); ?></span>
      </div>
      <div class="step step-active flex items-center gap-3 pb-6 border-b-2 border-[#38CB89] w-full md:w-[30%] mr-[3.333333%]">
        <span class="step-dot-done">✓</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-[#38CB89]"><?php esc_html_e( 'Bestelldetails', 'aleandbread' ); ?></span>
      </div>
      <div class="step step-active flex items-center gap-3 pb-6 w-full border-b-2 border-dark md:w-[30%] mr-[3.333333%]">
        <span class="step-dot">3</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-dark"><?php esc_html_e( 'Bestellung abgeschlossen', 'aleandbread' ); ?></span>
      </div>
    </div>

    <?php if ( $order && $order->has_status('failed') ) : ?>

      <div class="max-w-3xl mx-auto">
        <div class="ab-card bg-white shadow-[0_1px_2px_rgba(0,0,0,.04),0_12px_40px_rgba(0,0,0,.06)] px-12 py-10 md:px-24 md:py-20 text-center">
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
        <div class="ab-card bg-white shadow-[0_1px_2px_rgba(0,0,0,.04),0_12px_40px_rgba(0,0,0,.06)] px-12 py-10 md:px-24 md:py-20 text-center">
          <div class="ty-msg-wrapper mb-7 flex flex-row items-center justify-center">
          <p class="text-[#6C7275] font-barlow text-[28px] font-medium tracking-[-0.6px] mr-1"><?php esc_html_e('Thank you!','aleandbread'); ?></p>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/imgs/ty.png" alt="Visual" title="Visual" />
          </div>
          <p class="text-[22px] md:text-[40px] leading-tight font-medium text-dark mb-12 max-w-[492px] mx-auto"><?php esc_html_e('Ihre Bestellung ist eingegangen','aleandbread'); ?></p>

          <!-- Thumbnails row -->
          <div class="flex items-center justify-center gap-14 mb-12">
            <?php if ( $order ) { ab_render_order_thumbs( $order ); } ?>
          </div>

          <?php if ( $order ) : ?>
            <?php
              $rows = [
                [
                  'label' => __( 'Order code:', 'woocommerce' ),
                  'value' => '#' . $order->get_order_number(),
                ],
                [
                  'label' => __( 'Date:', 'woocommerce' ),
                  'value' => wc_format_datetime( $order->get_date_created() ),
                ],
                [
                  'label' => __( 'Total:', 'woocommerce' ),
                  'value' => wp_kses_post( $order->get_formatted_order_total() ),
                ],
              ];

              if ( $order->get_payment_method_title() ) {
                $rows[] = [
                  'label' => __( 'Payment method:', 'woocommerce' ),
                  'value' => esc_html( $order->get_payment_method_title() ),
                ];
              }
            ?>

            <dl class="ab-meta mx-auto w-full max-w-xl grid grid-cols-2 gap-x-8 gap-y-3 items-start text-[14px] md:text-base leading-6">
              <?php foreach ( $rows as $r ) : ?>
                <dt class="text-[#6C7275] whitespace-nowrap"><?php echo esc_html( $r['label'] ); ?></dt>
                <dd class="font-semibold text-dark break-words"><?php echo $r['value']; ?></dd>
              <?php endforeach; ?>
            </dl>



            <div class="mt-12">
              <?php if ( is_user_logged_in() ) : ?>
                <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="btn btn-secondary !font-semibold px-6 py-3">
                  <?php esc_html_e('Bestellverlauf','aleandbread'); ?>
                </a>
              <?php else : ?>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn-secondary !font-semibold px-6 py-3">
                  <?php esc_html_e('Weiter einkaufen','aleandbread'); ?>
                </a>
              <?php endif; ?>
              <?php
              //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
              //do_action( 'woocommerce_thankyou', $order->get_id() );
              ?>
            </div>
          <?php else : ?>
            <p class="text-[#6C7275]"><?php esc_html_e('Vielen Dank. Ihre Bestellung ist eingegangen.','aleandbread'); ?></p>
            <?php //do_action( 'woocommerce_thankyou', 0 ); ?>
          <?php endif; ?>

        </div>
      </div>


    <?php endif; ?>

  </div>
</section>

<?php do_action('woocommerce_after_main_content'); ?>
