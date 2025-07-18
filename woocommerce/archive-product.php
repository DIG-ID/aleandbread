<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>
<?php if ( is_shop() && !is_product_category() && !is_search() ) : ?>

	<?php get_template_part( 'woocommerce/custom-storefront' ); ?>

<?php else : ?>
	<div class="theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-12">
			<?php do_action( 'woocommerce_archive_description' ); ?>

			<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
			<!-- Sidebar column -->
			<aside class="md:col-span-1">
				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'shop-sidebar' ); ?>
				<?php endif; ?>
			</aside>

			<!-- Product loop -->
			<main class="md:col-span-3">
				<?php if ( woocommerce_product_loop() ) : ?>

				<?php
				do_action( 'woocommerce_before_shop_loop' );
				woocommerce_product_loop_start();

				while ( have_posts() ) {
					the_post();
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
				}

				woocommerce_product_loop_end();
				do_action( 'woocommerce_after_shop_loop' );
				?>

				<?php else : ?>

				<?php do_action( 'woocommerce_no_products_found' ); ?>

				<?php endif; ?>
			</main>
			</div>
		</div>
		</div>

<?php endif; ?>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );


get_footer( 'shop' );
