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

if ( is_shop() && ! is_product_category() && ! is_search() ) :
	get_template_part( 'woocommerce/custom-storefront' );
else :

	?>
	<section id="hero" class="section-hero pb-0 relative overflow-hidden bg-no-repeat bg-center bg-cover mb-14 md:mb-16 xl:mb-32 pt-pt-combo-sm md:pt-pt-combo-md xl:pt-pt-combo-xl" style="background-image: url('<?php echo esc_url( wp_get_attachment_image_url( get_field( 'experiences_hero_background', 'option' ), 'full' ) ); ?>');">
		<!-- Content stays normally positioned with higher z-index -->
		<div class="theme-container relative z-10">
			<div class="theme-grid">
				<div class="col-start-1 col-span-1 md:col-start-1 md:col-span-3 xl:col-start-2 xl:col-span-2">
						<?php do_action ( 'breadcrumbs' ); ?>
				</div>
				<div class="col-start-1 col-span-2 md:col-start-1 md:col-span-5 xl:col-start-2 xl:col-span-4">
						<h1 class="text-dark pt-[30px] md:pt-[56px] xl:pt-[66px] w-[300px] md:w-full"><?php echo get_field('experiences_hero_title', 'option'); ?></h1>
				</div>
				<div class=" col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-2 xl:col-span-4">
						<p class="block-text text-dark pt-[30px] md:pt-[56px] xl:pt-[66px] md:w-[444px] xl:w-[555px]"><?php echo get_field('experiences_hero_description', 'option'); ?></p>
				</div>
				<div class="flex flex-col items-start justify-start col-start-1 xl:col-start-2 pt-[30px] md:pt-[56px] xl:pt-[66px] pb-[270px] md:pb-[432px] xl:pb-[300px] hidden invisible">
					<?php
					$button = get_field( 'experiences_hero_button', 'option' );
					if ( $button ) :
						$link_url = $button['url'];
						$link_title = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
						?>
						<a class="btn btn-tertiary w-[160px] md:w-[270px] xl:w-[270px] !border-accent" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
						<?php echo esc_html( $link_title ); ?>
						</a>
						<?php
					endif;
					?>
				</div>
			</div>
		</div>
	</section>

	<section id="shop-experiences-categories" class="shop-experiences-categories mb-14 md:mb-32 xl:mb-56">
		<div class="theme-container">
			<?php
			/**
			 * Hook: aleandbread_shop_categories.
			 * 
			 * @hooked aleandbread_shop_categories - 10
			 */
			do_action( 'shop_experiences_categories' );
			?>
		</div>
	</section>

	<section id="events" class="events relative overflow-hidden bg-dark xl:bg-transparent">
		<?php
			$image_id = get_field('experiences_events_background_image', 'option');
			$image_url = wp_get_attachment_image_url($image_id, 'full');
		?>
		
		<?php if ($image_url): ?>
			<figure class="xl:absolute inset-0 xl:w-full xl:h-full xl:z-0 relative w-auto h-auto z-auto pointer-events-none img-overlay img-overlay--horizontal-right-2">
				<img 
					src="<?php echo esc_url($image_url); ?>" 
					alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
					class="w-full h-full xl:object-cover object-contain"
					loading="lazy"
				/>
			</figure>
		<?php endif; ?>

		<div class="theme-container !max-w-full relative z-10">
			<div class="theme-grid">
				<div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-8 xl:pt-[130px]">
					<p class="over-title text-accent">
						<?php echo get_field('experiences_events_over_title', 'option'); ?>
					</p>
					<h1 class="text-blockTextLight pt-7 md:pt-14 w-[283px] md:w-[561px] xl:w-full">
						<?php echo get_field('experiences_events_title', 'option'); ?>
					</h1>
					<p class="block-text text-blockTextLight pt-10 md:pt-14 w-[276px] md:w-[547px] xl:w-full pb-[27px] md:pb-[53px]">
						<?php echo get_field('experiences_events_description', 'option'); ?>
					</p>
					<?php
					$button = get_field('experiences_events_button', 'option');
					if ( $button ) :
						$link_url = $button['url'];
						$link_title = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
						?>
						<a class="btn btn-tertiary !border-accent mb-[108px] md:mb-[165px] xl:mb-[223px]" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
						<?php echo esc_html($link_title); ?>
						</a>
						<?php
					endif;
					?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;




get_footer( 'shop' );
