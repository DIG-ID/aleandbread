<?php
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'ale_wc_menu_is_active' ) ) {
  /**
   * Returns true if the given My Account menu endpoint should be marked active.
   */
  function ale_wc_menu_is_active( $menu_endpoint ) {
    if ( ! function_exists( 'is_wc_endpoint_url' ) ) {
      return false;
    }

    // Dashboard has NO endpoint; it's the account root.
    if ( 'dashboard' === $menu_endpoint ) {
      return empty( WC()->query->get_current_endpoint() );
    }

    // Map common child endpoints to their parent menu items.
    $map = array(
      'orders'          => array( 'orders', 'view-order' ),
      'edit-address'    => array( 'edit-address', 'billing', 'shipping' ),
      'payment-methods' => array( 'payment-methods', 'add-payment-method', 'delete-payment-method', 'set-default-payment-method' ),
      // Extensions (add if you use them):
      'subscriptions'   => array( 'subscriptions', 'view-subscription' ),
    );

    $checks = isset( $map[ $menu_endpoint ] ) ? $map[ $menu_endpoint ] : array( $menu_endpoint );

    foreach ( $checks as $ep ) {
      if ( is_wc_endpoint_url( $ep ) ) {
        return true;
      }
    }
    return false;
  }
}

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
      <?php foreach ( $endpoints as $endpoint => $label ) :
        $is_active = ale_wc_menu_is_active( $endpoint );
      ?>
        <a
          href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
          class="block block-text rounded-sm <?php echo $is_active ? 'active !font-semibold underline' : 'hover:font-semibold hover:underline'; ?>"
          <?php echo $is_active ? 'aria-current="page"' : ''; ?>
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
