<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="checkout-button btn w-full bg-dark text-white font-barlow text-[12px] md:text-[16px] font-semibold leading-[26px] md:leading-[26px] text-center py-[10px] md:py-[10px]">' .
      esc_html__( 'Checkout', 'woocommerce' ) .
     '</a>';