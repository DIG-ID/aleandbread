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

?>
<div <?php wc_product_class( 'card-product--experiences group', $product ); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="flex flex-col xl:flex-row xl:justify-center xl:items-stretch w-full">
		<figure class="max-w-full xl:max-w-[704px]">
			<?php echo get_the_post_thumbnail( $product->get_id(), 'full' ); ?>
		</figure>
		<div class="bg-dark text-white w-full px-8 pt-7 pb-12 md:px-9 md:py-14 xl:px-24 xl:py-16 flex justify-between items-start gap-6">
			<div class="card-content flex flex-col">
				<h2 class=" mb-2 transition-all duration-500 ease-in-out group-hover:text-accent"><?php the_title( '', '', true ); ?></h2>
				<p class="text-blockTextLight mb-12"><?php the_field( 'capacity' ); ?></p>
				<div class="font-barlow text-[0.9375rem] md:text-[1.5rem] font-normal leading-[1.4063rem] md:leading-[1.75rem] md:tracking-[0.015rem] mb-12">
					<?php the_excerpt(); ?>
				</div>
				<div class="icons flex items-center gap-x-16">
					<div class="duration flex items-center">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
							<path d="M9.5 5.125V9.5L12.125 12.125M1.625 9.5C1.625 10.5342 1.82869 11.5582 2.22445 12.5136C2.6202 13.4691 3.20027 14.3372 3.93153 15.0685C4.6628 15.7997 5.53093 16.3798 6.48637 16.7756C7.44181 17.1713 8.46584 17.375 9.5 17.375C10.5342 17.375 11.5582 17.1713 12.5136 16.7756C13.4691 16.3798 14.3372 15.7997 15.0685 15.0685C15.7997 14.3372 16.3798 13.4691 16.7756 12.5136C17.1713 11.5582 17.375 10.5342 17.375 9.5C17.375 7.41142 16.5453 5.40838 15.0685 3.93153C13.5916 2.45469 11.5886 1.625 9.5 1.625C7.41142 1.625 5.40838 2.45469 3.93153 3.93153C2.45469 5.40838 1.625 7.41142 1.625 9.5Z" stroke="#CC9933" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<p class="text-blockTextLight"><?php the_field( 'duration' ); ?></p>
					</div>
					<div class="location flex items-center">
						<svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
							<path d="M3.40146 3.75953C4.89178 2.29902 6.89826 1.48566 8.98489 1.49619C11.0715 1.50673 13.0697 2.34032 14.5452 3.81581C16.0207 5.2913 16.8543 7.28946 16.8648 9.37609C16.8753 11.4627 16.062 13.4692 14.6015 14.9595L10.4155 19.1455C10.0404 19.5205 9.53179 19.7311 9.00146 19.7311C8.47113 19.7311 7.96252 19.5205 7.58746 19.1455L3.40146 14.9595C1.91635 13.4743 1.08203 11.4599 1.08203 9.35953C1.08203 7.25915 1.91635 5.24479 3.40146 3.75953Z" stroke="#CC9933" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M9 12.3594C10.6569 12.3594 12 11.0162 12 9.35937C12 7.70252 10.6569 6.35938 9 6.35938C7.34315 6.35938 6 7.70252 6 9.35937C6 11.0162 7.34315 12.3594 9 12.3594Z" stroke="#CC9933" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<p class="text-blockTextLight"><?php the_field( 'location' ); ?></p>
					</div>
				</div>
			</div>
			<i class="card-product--experiences__arrow self-center"></i>
		</div>
	</a>
</div>
