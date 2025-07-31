<?php
defined( 'ABSPATH' ) || exit;
$current_user = wp_get_current_user();
?>

<div class="mb-10">
  <h2 class="text-2xl font-bold">Welcome, <?php echo esc_html( $current_user->display_name ); ?></h2>
  <p class="text-sm text-gray-500">This is your account dashboard where you can check your recent account activity.</p>
</div>


<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
  
  <!-- Account Details -->
  <div class="bg-white border border-gray-200 p-6 rounded-md shadow text-sm space-y-1">
    <div class="flex justify-between items-center mb-3">
      <h3 class="font-semibold text-sm">Account Details</h3>
      <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="text-xs text-gray-500">✎ Edit</a>
    </div>
    <p><?php echo esc_html( $current_user->display_name ); ?></p>
    <p><?php echo esc_html( get_user_meta( $current_user->ID, 'billing_phone', true ) ); ?></p>
    <p><?php echo esc_html( get_user_meta( $current_user->ID, 'billing_address_1', true ) ); ?>, <?php echo esc_html( get_user_meta( $current_user->ID, 'billing_city', true ) ); ?>, <?php echo esc_html( get_user_meta( $current_user->ID, 'billing_country', true ) ); ?></p>
  </div>

  <!-- Shipping Address -->
 <div class="bg-white border border-gray-200 p-6 rounded-md shadow text-sm space-y-1">
    <div class="flex justify-between items-center mb-3">
      <h3 class="font-semibold text-sm">Shipping Address</h3>
      <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>" class="text-xs text-gray-500">✎ Edit</a>
    </div>
    <?php
    $shipping = array(
      'first_name' => get_user_meta( $current_user->ID, 'shipping_first_name', true ),
      'last_name'  => get_user_meta( $current_user->ID, 'shipping_last_name', true ),
      'company'    => get_user_meta( $current_user->ID, 'shipping_company', true ),
      'address_1'  => get_user_meta( $current_user->ID, 'shipping_address_1', true ),
      'address_2'  => get_user_meta( $current_user->ID, 'shipping_address_2', true ),
      'city'       => get_user_meta( $current_user->ID, 'shipping_city', true ),
      'state'      => get_user_meta( $current_user->ID, 'shipping_state', true ),
      'postcode'   => get_user_meta( $current_user->ID, 'shipping_postcode', true ),
      'country'    => get_user_meta( $current_user->ID, 'shipping_country', true ),
    );
    echo wp_kses_post( WC()->countries->get_formatted_address( $shipping ) );
    ?>
  </div>

  <!-- Billing Address -->
  <div class="bg-white border border-gray-200 p-6 rounded-md shadow text-sm space-y-1">
    <div class="flex justify-between items-center mb-3">
      <h3 class="font-semibold text-sm">Billing Address</h3>
      <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address/billing' ) ); ?>" class="text-xs text-gray-500">✎ Edit</a>
    </div>
    <p>Equal to the shipping address</p>
  </div>

</div>
