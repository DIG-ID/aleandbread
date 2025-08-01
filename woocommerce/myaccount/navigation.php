<?php
defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
if ( ! is_user_logged_in() ) {
    return;
}

// Safely attempt to get account menu items
$endpoints = function_exists( 'wc_get_account_menu_items' ) ? wc_get_account_menu_items() : [];

?>

<?php if ( ! empty( $endpoints ) ) : ?>
  <div class="border border-blockTextLight px-5 py-3 rounded-t-sm shadow-sm w-full">
    <p class="block-text-bold">Hi, <?php echo esc_html( $current_user->first_name ); ?></p>
  </div>
  <div class="border border-blockTextLight px-5 py-3 rounded-b-sm shadow-sm w-full">
    
    <nav class="flex flex-col gap-3">
      <?php foreach ( $endpoints as $endpoint => $label ) : ?>
        <a
          href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
          class="block block-text rounded-sm <?php echo WC()->query->get_current_endpoint() === $endpoint ? '' : 'hover:font-semibold hover:underline'; ?>"
        >
          <?php echo esc_html( $label ); ?>
        </a>
      <?php endforeach; ?>
    </nav>
  </div>

<?php else : ?>
  <div class="p-4 border">
    <p class="text-red-500">Account navigation is unavailable. WooCommerce may not be fully initialized.</p>
  </div>
<?php endif; ?>

