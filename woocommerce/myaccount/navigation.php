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
  <div class="bg-white border border-gray-200 p-6 rounded-md shadow-sm text-sm w-full">
    <p class="font-semibold mb-4">Hi, <?php echo esc_html( $current_user->first_name ); ?></p>
    <nav class="flex flex-col gap-3">
      <?php foreach ( $endpoints as $endpoint => $label ) : ?>
        <a
          href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
          class="block px-3 py-2 rounded-md <?php echo WC()->query->get_current_endpoint() === $endpoint ? 'bg-gray-200 font-semibold' : 'hover:bg-gray-100'; ?>"
        >
          <?php echo esc_html( $label ); ?>
        </a>
      <?php endforeach; ?>
    </nav>
  </div>

<?php else : ?>
  <div class="bg-white p-4 border">
    <p class="text-red-500">Account navigation is unavailable. WooCommerce may not be fully initialized.</p>
  </div>
<?php endif; ?>

