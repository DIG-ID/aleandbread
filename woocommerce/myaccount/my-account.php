<?php
defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div class="theme-container py-16">
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    
    <!-- Sidebar -->
    <aside class="lg:col-span-1">
      <?php wc_get_template( 'myaccount/navigation.php' ); ?>
    </aside>

    <!-- Main content -->
    <section class="lg:col-span-3">
      <div class="mb-10">
        <h1 class="text-3xl font-extrabold mb-4">MY ACCOUNT</h1>
      </div>
      <?php
      $current_endpoint = WC()->query->get_current_endpoint();
      if ( $current_endpoint ) {
          do_action( 'woocommerce_account_' . $current_endpoint . '_endpoint' );
      } else {
          wc_get_template( 'myaccount/dashboard.php' );
      }
      ?>
    </section>
    
  </div>
</div>


<?php do_action( 'woocommerce_after_main_content' ); ?>
<?php get_footer( 'shop' ); ?>
