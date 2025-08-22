<?php
/**
 * Template override: Reset password form (after email link)
 * Path: your-theme/woocommerce/myaccount/form-reset-password.php
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_reset_password_form');
?>

<section id="reset-password" class="section-reset relative overflow-hidden pt-[82px] md:pt-[106px]">
  <div class="theme-container pt-[100px] pb-[240px] md:pt-[100px] md:pb-[60px] xl:pt-[170px] xl:pb-[114px]">
    <div class="theme-grid">

      <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-2">
        <div>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="inline-flex items-center gap-2 mb-4 text-sm hover:underline">
            ← Back to login
          </a>

          <h2 class="text-3xl font-bold mb-4"><?php esc_html_e( 'Set a new password', 'woocommerce' ); ?></h2>
          <p class="text-sm text-gray-500 mb-6">
            <?php echo esc_html__( 'Enter a new password below.', 'woocommerce' ); ?>
          </p>

          <?php wc_print_notices(); ?>

          <form method="post" class="space-y-4 woocommerce-ResetPassword lost_reset_password">
            <div class="flex flex-col">
              <label for="password_1" class="mb-3">
                <?php esc_html_e( 'New password', 'woocommerce' ); ?>
              </label>
              <input
                type="password"
                class="w-full border p-2 rounded"
                name="password_1"
                id="password_1"
                autocomplete="new-password"
                required
              />
            </div>

            <div class="flex flex-col">
              <label for="password_2" class="mb-3">
                <?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>
              </label>
              <input
                type="password"
                class="w-full border p-2 rounded"
                name="password_2"
                id="password_2"
                autocomplete="new-password"
                required
              />
            </div>

            <input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
            <input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

            <?php do_action('woocommerce_resetpassword_form'); ?>

            <input type="hidden" name="wc_reset_password" value="true" />
            <?php wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'); ?>

            <button type="submit" class="btn btn-secondary mb-6 w-full">
              <?php esc_html_e( 'Save', 'woocommerce' ); ?>
            </button>
          </form>
		  <?php wc_print_notices(); ?>
        </div>
      </div>

      <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-8 hidden xl:block">
        <div class="flex justify-center items-center">
          <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php echo esc_url( get_the_post_thumbnail_url(null, 'full') ); ?>" alt="Visual">
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<?php
do_action('woocommerce_after_reset_password_form');
