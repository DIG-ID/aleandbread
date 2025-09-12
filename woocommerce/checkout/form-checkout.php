<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */
defined( 'ABSPATH' ) || exit;

$checkout = WC()->checkout(); // ensure $checkout is set

do_action( 'woocommerce_before_main_content' );
?>

<section class="ab-checkout relative theme-grid py-10 md:pb-16 md:pt-0 bg-background">
  <div class="col-span-2 md:col-span-6 xl:col-span-8 col-start-1 md:col-start-1 xl:col-start-3">

    <!-- Title -->
    <h1 class="text-center text-dark mb-14">
      <?php echo esc_html( get_the_title( wc_get_page_id( 'checkout' ) ) ); ?>
    </h1>

    <!-- Stepper -->
    <div class="ab-steps max-w-4xl mx-auto mb-20 hidden xl:flex items-center">
      <div class="step step-active flex items-center gap-3 pb-6 border-b-2 border-[#38CB89] w-full md:w-[30%] mr-[3.333333%]">
        <span class="step-dot-done">1</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-[#38CB89]"><?php esc_html_e( 'Warenkorb', 'aleandbread' ); ?></span>
      </div>
      <div class="step step-active flex items-center gap-3 pb-6 border-b-2 border-dark w-full md:w-[30%] mr-[3.333333%]">
        <span class="step-dot">2</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-dark"><?php esc_html_e( 'Bestelldetails', 'aleandbread' ); ?></span>
      </div>
      <div class="step flex items-center gap-3 pb-6 w-full md:w-[30%] mr-[3.333333%]">
        <span class="step-dot-faded">3</span><span class="font-barlow text-[16px] leading-[26px] font-semibold text-[#B1B5C3]"><?php esc_html_e( 'Bestellung abgeschlossen', 'aleandbread' ); ?></span>
      </div>
    </div>

    <?php
    // Standard Woo pre-checkout hook and auth checks
    do_action( 'woocommerce_before_checkout_form', $checkout );

    if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
      echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
      do_action( 'woocommerce_after_main_content' );
      return;
    }
    ?>

    <!-- OPEN FORM: wraps BOTH columns -->
    <form name="checkout"
          method="post"
          class="checkout woocommerce-checkout"
          action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
          enctype="multipart/form-data">

      <!-- Two-column layout -->
      <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-8 gap-6 items-start">

        <!-- LEFT: customer details -->
        <div class="col-span-2 md:col-span-6 xl:col-span-5">
          <div class="woocommerce-checkout-fields">
            <?php if ( $checkout->get_checkout_fields() ) : ?>
              <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

              <div id="customer_details">
                <div class="billing-fields">
                  <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>
                <div class="shipping-fields">
                  <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                </div>
              </div>

              <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- RIGHT: order summary + payment (includes Place Order button & nonce) -->
        <aside class="col-span-2 md:col-span-6 xl:col-span-3">
          <div class="woocommerce-checkout-review-order bg-white py-4 px-6">
            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
            <h3 id="order_review_heading" class="mb-4 font-semibold"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
            <div id="order_review" class="woocommerce-checkout-review-order">
              <?php
              // Renders review-order.php + payment.php (with the Place Order button and nonce)
              do_action( 'woocommerce_checkout_order_review' );
              ?>
            </div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
          </div>
        </aside>

      </div><!-- /grid -->
    </form><!-- /form -->

    <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

  </div>
</section>

<?php do_action( 'woocommerce_after_main_content' ); ?>
