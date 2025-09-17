<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<?php do_action( 'aleandbread_shop_breadcrumbs' ); ?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'theme-grid', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary col-span-2 md:col-span-6 xl:col-start-6 xl:col-span-5">
		<div class="flex items-center gap-3 mb-2">
			<?php
			global $product;
			if ( ! $product ) {
				$product = wc_get_product( get_the_ID() );
			}

			$target_url = '';
			$label      = '';

			if ( $product instanceof WC_Product ) {
				$cat_ids = $product->get_category_ids();

				if ( ! empty( $cat_ids ) ) {
				$term = get_term( (int) $cat_ids[0], 'product_cat' );
				if ( $term && ! is_wp_error( $term ) ) {
					$target_url = get_term_link( $term, 'product_cat' );
					$label = sprintf(
					esc_html__( 'Zur Kategorie %s', 'aleandbread' ),
					$term->name
					);
				}
				}
			}

			if ( empty( $target_url ) ) {
				// Fallback to Shop page.
				$target_url = wc_get_page_permalink( 'shop' );
				$label      = esc_html__( 'Zum Shop', 'aleandbread' );
			}
			?>
			<a href="<?php echo esc_url( $target_url ); ?>" class="flex items-center gap-2 text-[#0D0D0D] font-barlow text-[16px] not-italic font-semibold leading-[13px] uppercase">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="inline-block">
				<path d="M0.497044 6.96965C0.10652 7.36017 0.10652 7.99334 0.497044 8.38386L6.86101 14.7478C7.25153 15.1383 7.88469 15.1383 8.27522 14.7478C8.66574 14.3573 8.66574 13.7241 8.27522 13.3336L2.61836 7.67676L8.27522 2.0199C8.66574 1.62938 8.66574 0.996212 8.27522 0.605688C7.8847 0.215164 7.25153 0.215163 6.86101 0.605688L0.497044 6.96965ZM32 7.67676L32 6.67676L1.20415 6.67676L1.20415 7.67676L1.20415 8.67676L32 8.67676L32 7.67676Z" fill="#0D0D0D"/>
				</svg>
				<span class="mb-1"><?php echo esc_html( $label ); ?></span>
			</a>
			</div>

		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
