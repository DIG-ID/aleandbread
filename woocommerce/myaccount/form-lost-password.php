<?php
/**
 * Template override: Lost password form
 * Path: your-theme/woocommerce/myaccount/form-lost-password.php
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');
?>

<section id="forgot-password" class="section-forgot relative overflow-hidden pt-[82px] md:pt-[106px]">
  <div class="theme-container pt-[100px] pb-[240px] md:pt-[100px] md:pb-[60px] xl:pt-[170px] xl:pb-[114px]">
    <div class="theme-grid">

      <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-2">
        <div>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="inline-flex items-center gap-2 mb-4 text-sm hover:underline">
            ← Back to login
          </a>

          <h1 class="text-dark mb-4">Forgot your password?</h1>
          <p class="block-text text-[#313131] mb-6">
            Don’t worry, it happens! Enter your email below to reset your password.
          </p>


          <form method="post" class="space-y-4 woocommerce-ResetPassword lost_reset_password">
            <?php do_action('woocommerce_lostpassword_form_start'); ?>

            <div class="flex flex-col">
              <label for="user_login" class="mb-3">
                <?php esc_html_e( 'Email', 'woocommerce' ); ?>
              </label>
              <input
                class="w-full border p-2 rounded"
                type="text"
                name="user_login"
                id="user_login"
                placeholder="john.doe@gmail.com"
                autocomplete="username"
                required
                value="<?php echo ! empty($_POST['user_login']) ? esc_attr($_POST['user_login']) : ''; ?>"
              />
            </div>

            <?php do_action('woocommerce_lostpassword_form'); ?>

            <input type="hidden" name="wc_reset_password" value="true" />
            <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

            <button type="submit" class="btn btn-secondary mb-6 w-full">
              <?php esc_html_e( 'Submit', 'woocommerce' ); ?>
            </button>

            <?php do_action('woocommerce_lostpassword_form_end'); ?>
          </form>

		  <?php wc_print_notices(); ?>

          <?php if ( function_exists( 'nextend_social_login_buttons' ) ) : ?>
            <div class="my-6">
              <div class="relative flex items-center justify-center my-6">
                <span class="px-3 text-sm text-gray-500">Or login with</span>
              </div>
              <div class="flex items-center justify-center gap-4">
                <?php echo do_shortcode('[nextend_social_login provider="facebook"]'); ?>
                <?php echo do_shortcode('[nextend_social_login provider="google"]'); ?>
                <?php echo do_shortcode('[nextend_social_login provider="apple"]'); // if enabled ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-span-2 md:col-span-4 xl:col-span-4 md:col-start-2 xl:col-start-8 hidden xl:block">
        <div class="flex justify-center items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/imgs/forgot-pw.jpg" alt="Visual" title="Visual" />
        </div>
      </div>

    </div>
  </div>
</section>

<?php
do_action('woocommerce_after_lost_password_form');
