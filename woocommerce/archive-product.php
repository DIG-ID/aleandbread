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

			/*woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();*/

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					/*do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();*/

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
<section class="best-sellers theme-grid pt-20">
	<div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4 mb-14 md:mb-16 xl:mb-24">
		<h1 class="text-dark uppercase"><?php esc_html_e( 'Best Sellers','aleandbread' ); ?></h1>
	</div> 
	<div class="col-span-2 md:col-span-6 xl:col-span-12">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			<?php
			$best_sellers = new WP_Query([
			'post_type' => 'product',
			'posts_per_page' => 2,
			'tax_query' => [
				[
				'taxonomy' => 'product_tag',
				'field'    => 'slug',
				'terms'    => 'best-seller',
				],
			],
			]);

			if ( $best_sellers->have_posts() ) :
			while ( $best_sellers->have_posts() ) : $best_sellers->the_post();
				$permalink = get_permalink();
				$title = get_the_title();
				$image = get_the_post_thumbnail(null, 'full');
				?>
				<div class="card-best-sellers">
				<a href="<?php echo esc_url($permalink); ?>">
					<div class="card-best-sellers--image">
					<?php echo get_the_post_thumbnail(null, 'full', ['class' => 'w-full h-full object-cover']); ?>
					</div>
					<div class="card-best-sellers--content">
						<span class="overlay"></span>
						<span class="block-text"><?php the_excerpt(); ?></span>
						<div class="card-best-sellers--footer flex justify-between items-center">
							<h2 class="card-best-sellers--title"><?php echo esc_html($title); ?></h2>
							<div class="card-best-sellers--arrow"></div>
						</div>
					</div>
				</a>
				</div>

				<?php
			endwhile;
			wp_reset_postdata();
			else :
			echo '<p class="text-gray-600">No best sellers yet.</p>';
			endif;
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
