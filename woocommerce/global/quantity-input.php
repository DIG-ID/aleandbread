<?php
defined('ABSPATH') || exit;

// Keep WooCommerce variables intact
$input_id    = $args['input_id'];
$input_name  = $args['input_name'];
$input_value = $args['input_value'];
$min_value   = $args['min_value'];
$max_value   = $args['max_value'];
$step        = $args['step'];
$pattern     = $args['pattern'];
$inputmode   = $args['inputmode'];
?>
<div class="ab-qty" data-step="<?php echo esc_attr($step ?: 1); ?>">
  <button type="button"
          class="ab-qty__btn ab-qty__btn--minus"
          aria-label="<?php esc_attr_e('Decrease quantity','woocommerce'); ?>">−</button>

  <input
    type="number"
    id="<?php echo esc_attr( $input_id ); ?>"
    class="ab-qty__input qty"
    step="<?php echo esc_attr( $step ); ?>"
    min="<?php echo esc_attr( $min_value ); ?>"
    max="<?php echo esc_attr( $max_value ); ?>"
    name="<?php echo esc_attr( $input_name ); ?>"
    value="<?php echo esc_attr( $input_value ); ?>"
    inputmode="<?php echo esc_attr( $inputmode ); ?>"
    pattern="<?php echo esc_attr( $pattern ); ?>"
    aria-label="<?php esc_attr_e('Quantity','woocommerce'); ?>"
  />

  <button type="button"
          class="ab-qty__btn ab-qty__btn--plus"
          aria-label="<?php esc_attr_e('Increase quantity','woocommerce'); ?>">+</button>
</div>