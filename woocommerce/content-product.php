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

<div <?php wc_product_class( 'card-product', $product ); ?>>
	<a class="card-product--content-wrapper" href="<?php echo esc_url( $product_link ); ?>">
		<div class="card-product--image">
			<?php echo get_the_post_thumbnail( $product->get_id(), 'full', array( 'class' => 'w-full h-full object-cover min-h-[500px] max-h-[500px]' ) ); ?>
		</div>
		<div class="card-product--content">
			<span class="overlay">
				<span class="icon-circle">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
				</span>
			</span>
			<h3 class="card-product--title"><?php echo esc_html( $product_title ); ?></h3>
			<p class="card-product--price"><?php echo $product_price; ?></p>
		</div>
	</a>
	<div class="add-to-cart-wrapper">
		<?php woocommerce_template_loop_add_to_cart(); ?>
	</div>
</div>
