<?php
defined( 'ABSPATH' ) || exit;
$current_user = wp_get_current_user();
?>

<div class="mb-6">
  <p class="text-dark faq-question">Welcome, <?php echo esc_html( $current_user->display_name ); ?></p>
  <p class="font-barlow text-blockText text-[18px] leading-[28px] font-normal">This is your account dashboard where you can check your recent account activity.</p>
</div>


<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-6 gap-x-5">
  
  <!-- Account Details -->
  <div class="col-span-2 md:col-span-4 xl:col-span-3 border border-blockTextLight p-5 rounded-sm shadow min-h-40 mb-8 bg-[#F6F6F6]">
    <div class="flex justify-between items-center mb-3">
      <p class="block-text !font-semibold text-dark">Account Details</p>
      <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="font-barlow text-[16px] leading-[26px] font-semibold text-[#6C7275]">✎ Edit</a>
    </div>
    <p class="block-text text-dark"><?php echo esc_html( $current_user->display_name ); ?></p>
    <p class="block-text text-dark"><?php echo esc_html( get_user_meta( $current_user->ID, 'billing_phone', true ) ); ?></p>
    <p class="block-text text-dark"><?php echo esc_html( get_user_meta( $current_user->ID, 'billing_address_1', true ) ); ?>, <?php echo esc_html( get_user_meta( $current_user->ID, 'billing_city', true ) ); ?>, <?php echo esc_html( get_user_meta( $current_user->ID, 'billing_country', true ) ); ?></p>
  </div>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-6 gap-x-5">
  <!-- Shipping Address -->
 <div class="col-span-2 md:col-span-4 xl:col-span-3 border border-blockTextLight p-5 rounded-sm shadow min-h-40 mb-8 bg-[#F6F6F6]">
    <div class="flex justify-between items-center mb-3">
      <h3 class="block-text !font-semibold text-dark">Shipping Address</h3>
      <a
        href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'shipping', wc_get_page_permalink( 'myaccount' ) ) ); ?>"
        class="font-barlow text-[16px] leading-[26px] font-semibold text-[#6C7275]"
      >✎ Edit</a>

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
  <div class="col-span-2 md:col-span-4 xl:col-span-3 border border-blockTextLight p-5 rounded-sm shadow min-h-40 mb-8 bg-[#F6F6F6]">
    <div class="flex justify-between items-center mb-3">
      <h3 class="block-text !font-semibold text-dark">Billing Address</h3>
      <a
      href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'billing', wc_get_page_permalink( 'myaccount' ) ) ); ?>"
      class="font-barlow text-[16px] leading-[26px] font-semibold text-[#6C7275]"
    >✎ Edit</a>
      <?php
      $billing = array(
        'first_name' => get_user_meta( $current_user->ID, 'billing_first_name', true ),
        'last_name'  => get_user_meta( $current_user->ID, 'billing_last_name', true ),
        'company'    => get_user_meta( $current_user->ID, 'billing_company', true ),
        'address_1'  => get_user_meta( $current_user->ID, 'billing_address_1', true ),
        'address_2'  => get_user_meta( $current_user->ID, 'billing_address_2', true ),
        'city'       => get_user_meta( $current_user->ID, 'billing_city', true ),
        'state'      => get_user_meta( $current_user->ID, 'billing_state', true ),
        'postcode'   => get_user_meta( $current_user->ID, 'billing_postcode', true ),
        'country'    => get_user_meta( $current_user->ID, 'billing_country', true ),
      );
      echo wp_kses_post( WC()->countries->get_formatted_address( $billing ) );
      ?>

    </div>
    <p class="block-text text-dark">Equal to the shipping address</p>
  </div>

</div>
