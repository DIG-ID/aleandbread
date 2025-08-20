<?php
/**
 * Proceed to checkout button (Ale & Bread)
 */
defined( 'ABSPATH' ) || exit;

echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="checkout-button btn w-full bg-dark text-white font-barlow text-[12px] md:text-[16px] font-semibold leading-[26px] md:leading-[26px] text-center py-[10px] md:py-[10px]">' .
      esc_html__( 'Checkout', 'woocommerce' ) .
     '</a>';