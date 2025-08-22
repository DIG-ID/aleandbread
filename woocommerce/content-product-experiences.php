<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;
global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

$product_link = get_permalink();
$product_title = get_the_title();
$product_price = $product->get_price_html();
?>
<div <?php wc_product_class( 'card-product--experiences', $product ); ?>>
	<a href="<?php echo esc_url( $product_link ); ?>" class="flex justify-center items-stretch w-full">
		<div class="max-w-[704px]">
			<?php echo get_the_post_thumbnail( $product->get_id(), 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
		</div>
		<div class="bg-dark w-full px-24 py-16 flex flex-col">
			<p class="text-white"><?php echo esc_html( $product_title ); ?></p>
		</div>
	</a>
</div>
