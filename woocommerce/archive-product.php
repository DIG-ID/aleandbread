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

if ( is_shop() && ! is_product_category() && ! is_search() ) :
	get_template_part( 'woocommerce/custom-storefront' );
else :
	do_action( 'aleandbread_shop_breadcrumbs' );
	?>
	<section class="shop-intro relative overflow-hidden">
		<div class="theme-grid pb-14 xl:pb-48">
			<div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
				<?php
				$term_id      = get_queried_object_id();
				$custom_field = get_field( 'custom_title', 'product_cat_' . $term_id );
				if ( $custom_field ) :
					echo '<h1 class="page-title text-dark">' . wp_kses_post( $custom_field ) . '</h1>';
				endif;
				?>
			</div>
			<div class="col-start-1 col-span-2 md:col-span-4 xl:col-start-8 xl:col-span-4 pt-[48px] md:pt-[56px] xl:pt-0">
				<p class="text-dark block-text w-[342px] md:w-[438px] xl:w-full"><?php do_action( 'woocommerce_archive_description' ); ?></p>
			</div>
		</div>
	</section>
	<?php
	$is_desc  = false;
	$cat_term = get_queried_object();
	if ( ! empty( $cat_term->parent ) ) :
		$target_top = get_term_by( 'term_id', $cat_term->parent, 'product_cat' );
		if ( ! empty( $target_top ) ) :
			$target_top_name = $target_top->name;
			$target_top_link = get_term_link( (int) $target_top->term_id, 'product_cat' );
			$is_desc         = $target_top ? in_array( $target_top->term_id, get_ancestors( $cat_term->term_id, 'product_cat' ) ) : false;
		endif;
	endif;
	if ( $is_desc ) :
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		?>
		<section class="experiences-cards theme-grid">
			<!-- Product loop -->
			<div class="col-span-2 md:col-span-6 xl:col-span-12">
				<?php
				if ( woocommerce_product_loop() ) :

					woocommerce_product_loop_start();
					if ( wc_get_loop_prop( 'total' ) ) :
						echo '<div class="grid grid-cols-1 gap-y-12 xl:gap-y-24 md:gap-y-16">';
						while ( have_posts() ) :
							the_post();
							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action( 'woocommerce_shop_loop' );
							wc_get_template_part( 'content', 'product-experiences' );
						endwhile;
						echo '</div>';
					endif;
					woocommerce_product_loop_end();

				else :
					do_action( 'woocommerce_no_products_found' );
				endif;
				?>
			</div>
			<div class="col-span-2 md:col-span-6 xl:col-span-12 flex justify-center items-center">
				<a href="<?php echo esc_url( $target_top_link ); ?>" class="btn btn-primary-2">
					<?php printf( esc_html__( 'Alle %s anzeigen', 'aleandbread' ), esc_html( $target_top_name ) ); ?>
				</a>
			</div>
		</section>
		<?php
	else :
		?>
		<section class="theme-grid">
			<div class="col-span-2 md:col-span-6 xl:col-span-12">
				<div class="theme-grid">
					<!-- Sidebar column -->
					<aside class="col-span-2 md:col-span-3 xl:col-span-3">
						<?php
						/**
						 * Hook: woocommerce_sidebar.
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						do_action( 'woocommerce_sidebar' );
						?>
					</aside>

					<!-- Product loop -->
					<div class="col-span-2 md:col-span-3 xl:col-span-9">
						<?php
						if ( woocommerce_product_loop() ) :
							//do_action( 'woocommerce_before_shop_loop' );
							do_action( 'aleandbread_before_shop_loop_action' );
							woocommerce_product_loop_start();
							?>
							<hr class="border-t border-dark mt-7 mb-32" />
							<?php
							if ( wc_get_loop_prop( 'total' ) ) {
								?><div class="grid grid-cols-2 xl:grid-cols-3 gap-6"><?php
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
								?></div><?php
							}

							woocommerce_product_loop_end();
							do_action( 'woocommerce_after_shop_loop' );
						else :
							do_action( 'woocommerce_no_products_found' );
						endif;
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	endif;
endif;



/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
if ( $is_desc ) :
	?>
	<section class="cenas py-44 bg-dark relative overflow-hidden bg-no-repeat bg-center bg-cover" style="background-image: linear-gradient(rgba(12, 12, 12, 0.86), rgba(12, 12, 12, 0.86)), url('<?php echo esc_url( wp_get_attachment_image_url( get_field( 'experiences_banner_image', 'option' ), 'full' ) ); ?>');">
		<div class="theme-container">
			<div class="theme-grid">
				<div class="col-span-2 md:col-span-5 xl:col-span-3 xl:col-start-2 xl:self-center">
					<h2 class="text-neutral-200 text-4xl xl:text-6xl font-bold font-barlowSemiCondensed uppercase xl:leading-[3.625rem] mb-7 xl:mb-0"><?php echo get_field( 'experiences_banner_title', 'option' ); ?></h2>
				</div>
				<div class="col-span-2 md:col-span-4 xl:col-span-3 xl:col-start-6">
					<div class="block-text text-blockTextLight mb-8"><?php echo get_field( 'experiences_banner_p1', 'option' ); ?></div>
				</div>
				<div class="col-span-2 md:col-span-4 xl:col-span-3">
					<div class="block-text text-blockTextLight"><?php echo get_field( 'experiences_banner_p2', 'option' ); ?></div>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
get_footer( 'shop' );
