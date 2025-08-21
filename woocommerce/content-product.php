<?php
defined( 'ABSPATH' ) || exit;
global $product;

if ( empty( $product ) || ! $product->is_visible() ) return;

$product_link = get_permalink();
$product_title = get_the_title();
$product_price = $product->get_price_html();
?>

<div <?php wc_product_class( 'card-produc', $product ); ?>>
    <a href="<?php echo esc_url( $product_link ); ?>">
        <div class="card-product--image">
            <?php echo get_the_post_thumbnail( $product->get_id(), 'full', ['class' => 'w-full h-full object-cover'] ); ?>
        </div>
        <div class="card-product--content">
            <span class="overlay"></span>
            <p class="card-product--title"><?php echo esc_html( $product_title ); ?></p>
            <p class="card-product--price"><?php echo $product_price; ?></p>
        </div>
    </a>
    <div class="flex pt-7 justify-center items-center">
        <?php woocommerce_template_loop_add_to_cart(); ?>
    </div>
</div>
