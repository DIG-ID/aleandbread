<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div class="theme-container">
  <div class="theme-grid">
    <div class="col-span-2 md:col-span-4 xl:col-span-9 col-start-1 md:col-start-2 xl:col-start-2">
      <h1 class="text-dark mb-16"><?php esc_html_e('Mein Konto','aleandbread') ?></h1>
    </div>
    <!-- Sidebar -->
    <aside class="col-span-2 md:col-span-4 xl:col-span-2 col-start-1 md:col-start-2 xl:col-start-2 hidden xl:block">
      <div class="bg-[#F6F6F6]">
        <?php wc_get_template( 'myaccount/navigation.php' ); ?>
      </div>
    </aside>

    <!-- Main content -->
    <section class="account-content col-span-2 md:col-span-4 xl:col-span-6 col-start-1 md:col-start-2 xl:col-start-5">
      
      <?php
      // Let WooCommerce handle endpoints (orders, downloads, edit-address, etc.)
      // This correctly handles nested endpoints like edit-address/billing.
      do_action( 'woocommerce_account_content' );
      ?>

    </section>
    
  </div>
</div>


<?php do_action( 'woocommerce_after_main_content' ); ?>
<?php get_footer( 'shop' ); ?>
