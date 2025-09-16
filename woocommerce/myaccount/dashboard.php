<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

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
      <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="flex items-center font-barlow text-[16px] leading-[26px] font-semibold text-[#6C7275]">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M2 14H14M9.18961 3.54114C9.18961 3.54114 9.18961 4.63089 10.2794 5.72064C11.3691 6.81039 12.4589 6.81039 12.4589 6.81039M4.87975 11.992L7.16823 11.6651C7.49833 11.618 7.80424 11.465 8.04003 11.2292L13.5486 5.72064C14.1505 5.11879 14.1505 4.14299 13.5486 3.54114L12.4589 2.45139C11.857 1.84954 10.8812 1.84954 10.2794 2.45139L4.77078 7.95997C4.53499 8.19576 4.38203 8.50167 4.33488 8.83177L4.00795 11.1202C3.9353 11.6288 4.3712 12.0647 4.87975 11.992Z" stroke="#6C7275" stroke-width="1.5" stroke-linecap="round"/>
        </svg><span class="ml-1">Edit</span>
      </a>
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
      <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'shipping', wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="flex items-center font-barlow text-[16px] leading-[26px] font-semibold text-[#6C7275]">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M2 14H14M9.18961 3.54114C9.18961 3.54114 9.18961 4.63089 10.2794 5.72064C11.3691 6.81039 12.4589 6.81039 12.4589 6.81039M4.87975 11.992L7.16823 11.6651C7.49833 11.618 7.80424 11.465 8.04003 11.2292L13.5486 5.72064C14.1505 5.11879 14.1505 4.14299 13.5486 3.54114L12.4589 2.45139C11.857 1.84954 10.8812 1.84954 10.2794 2.45139L4.77078 7.95997C4.53499 8.19576 4.38203 8.50167 4.33488 8.83177L4.00795 11.1202C3.9353 11.6288 4.3712 12.0647 4.87975 11.992Z" stroke="#6C7275" stroke-width="1.5" stroke-linecap="round"/>
        </svg><span class="ml-1">Edit</span>
      </a>

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
      <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'billing', wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="flex items-center font-barlow text-[16px] leading-[26px] font-semibold text-[#6C7275]">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M2 14H14M9.18961 3.54114C9.18961 3.54114 9.18961 4.63089 10.2794 5.72064C11.3691 6.81039 12.4589 6.81039 12.4589 6.81039M4.87975 11.992L7.16823 11.6651C7.49833 11.618 7.80424 11.465 8.04003 11.2292L13.5486 5.72064C14.1505 5.11879 14.1505 4.14299 13.5486 3.54114L12.4589 2.45139C11.857 1.84954 10.8812 1.84954 10.2794 2.45139L4.77078 7.95997C4.53499 8.19576 4.38203 8.50167 4.33488 8.83177L4.00795 11.1202C3.9353 11.6288 4.3712 12.0647 4.87975 11.992Z" stroke="#6C7275" stroke-width="1.5" stroke-linecap="round"/>
        </svg><span class="ml-1">Edit</span>
      </a>
    </div>
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
    <p class="block-text text-dark">Equal to the shipping address</p>
  </div>

</div>
