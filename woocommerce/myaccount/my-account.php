<?php
defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div class="theme-container">
  <div class="theme-grid">
    <div class="col-span-2 md:col-span-4 xl:col-span-9 col-start-1 md:col-start-2 xl:col-start-2">
      <h1 class="text-dark mb-16"><?php esc_html_e('MY ACCOUNT','aleandbread') ?></h1>
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
