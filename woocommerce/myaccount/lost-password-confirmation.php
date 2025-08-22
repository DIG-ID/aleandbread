<?php
/**
 * Template override: Lost password confirmation (reset-link-sent=true)
 * Path: your-theme/woocommerce/myaccount/lost-password-confirmation.php
 * WC >= 9
 */
defined('ABSPATH') || exit;

// (Optional) if you kept global notices enabled elsewhere, you can unhook them in functions.php.
// Here we just render the confirmation inside our layout.
?>

<section id="forgot-password" class="section-forgot relative overflow-hidden pt-[82px] md:pt-[106px]">
  <div class="theme-container pt-[100px] pb-[240px] md:pt-[100px] md:pb-[60px] xl:pt-[170px] xl:pb-[114px]">
    <div class="theme-grid">

      <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-2">
        <div>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="inline-flex items-center gap-2 mb-4 text-sm hover:underline">
            ← Back to login
          </a>

          <h2 class="text-3xl font-bold mb-4"><?php esc_html_e( 'Check your email', 'woocommerce' ); ?></h2>
          <p class="text-sm text-gray-500 mb-6">
            <?php echo esc_html__( "If that email address is registered, we’ve sent you a link to reset your password. It can take a few minutes to arrive.", 'woocommerce' ); ?>
          </p>

          <?php
          /**
           * These actions surround the confirmation message in the core template.
           * Keep them for compatibility with plugins.
           */
          do_action( 'woocommerce_before_lost_password_confirmation_message' );

          // Print the standard WooCommerce confirmation notice INSIDE our layout.
          wc_print_notice(
            apply_filters(
              'woocommerce_lost_password_confirmation_message',
              __( 'An email has been sent to your address with a link to reset your password.', 'woocommerce' )
            ),
            'success'
          );

          do_action( 'woocommerce_after_lost_password_confirmation_message' );
          ?>

          <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="btn btn-secondary mt-6 inline-flex">
            <?php esc_html_e( 'Back to Login', 'woocommerce' ); ?>
          </a>
        </div>
      </div>

      <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-8 hidden xl:block">
        <div class="flex justify-center items-center">
          <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'full' ) ); ?>" alt="Visual">
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>
