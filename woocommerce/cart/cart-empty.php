<?php
/**
 * Cart empty — Ale & Bread layout
 */
defined('ABSPATH') || exit;

do_action('woocommerce_before_main_content');
?>

<section class="ab-cart-empty relative py-10 md:py-16 bg-background">
  <div class="theme-container">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-6 xl:col-span-8 col-start-1 md:col-start-1 xl:col-start-3">

        <h1 class="text-center text-dark mb-6">
          <?php echo esc_html( get_the_title( wc_get_page_id( 'cart' ) ) ); ?>
        </h1>

        <div class="max-w-3xl mx-auto">
          <div class="ab-card bg-white rounded-[12px] shadow-[0_1px_2px_rgba(0,0,0,.04),0_12px_40px_rgba(0,0,0,.06)] p-8 text-center">
            <?php
              do_action( 'woocommerce_cart_is_empty' );

              if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
                <p class="text-[#6C7275] mb-6">
                  <?php esc_html_e( 'Your cart is currently empty.', 'woocommerce' ); ?>
                </p>
                <a class="button rounded-full px-6 py-3" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
                  <?php esc_html_e( 'Return to shop', 'woocommerce' ); ?>
                </a>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php do_action('woocommerce_after_main_content'); ?>
