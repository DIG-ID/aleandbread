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
<section class="shop-intro relative overflow-hidden">
	<div class="theme-grid pb-14 xl:pb-60">
		<div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
			<h1 class="text-dark"><?php echo get_field('intro_title', get_option('woocommerce_shop_page_id')); ?></h1>
		</div> 

		<div class="col-start-1 col-span-2 md:col-span-4 xl:col-start-8 xl:col-span-4 pt-[48px] md:pt-[56px] xl:pt-0">
			<p class="text-dark block-text w-[342px] md:w-[438px] xl:w-full">
			<?php 
			echo get_field('intro_description', get_option('woocommerce_shop_page_id')); 
			?>
			</p> 
		</div> 
	</div>
	<div class="theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-12">
		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>
		<?php
		/**
		 * Hook: woocommerce_shop_loop_header.
		 *
		 * @since 8.6.0
		 *
		 * @hooked woocommerce_product_taxonomy_archive_header - 10
		 */
		do_action( 'woocommerce_shop_loop_header' );

		if ( woocommerce_product_loop() ) {

			/**
			 * Hook: aleandbread_shop_categories.
			 * 
			 * @hooked aleandbread_shop_categories - 10
			 */
				do_action( 'shop_categories' );

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
		?>
		</div>
	</div>
</section>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );


get_footer( 'shop' );
