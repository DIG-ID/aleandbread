<?php do_action( 'aleandbread_shop_breadcrumbs' ); ?>

<section class="shop-intro relative overflow-hidden">
	<div class="theme-grid pb-14 xl:pb-60">
		<div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
			<h1 class="text-dark"><?php echo get_field( 'intro_title', get_option( 'woocommerce_shop_page_id' ) ); ?></h1>
		</div>

		<div class="col-start-1 col-span-2 md:col-span-4 xl:col-start-8 xl:col-span-4 pt-[48px] md:pt-[56px] xl:pt-0">
			<p class="text-dark block-text w-[342px] md:w-[438px] xl:w-full">
			<?php
			echo get_field( 'intro_description', get_option( 'woocommerce_shop_page_id' ) );
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
			//do_action( 'woocommerce_before_shop_loop' );

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
			//do_action( 'woocommerce_after_shop_loop' );
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

<section class="best-sellers theme-grid pt-20 xl:pt-36">
	<div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4 mb-14 md:mb-16 xl:mb-24">
		<h2 class="h1 text-dark uppercase"><?php esc_html_e( 'Bestseller', 'aleandbread' ); ?></h2>
	</div> 
	<div class="col-span-2 md:col-span-6 xl:col-span-12">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			<?php
			$best_sellers = new WP_Query(
				array(
					'post_type'      => 'product',
					'posts_per_page' => 2,
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_tag',
							'field'    => 'slug',
							'terms'    => 'best-seller',
						),
					),
				)
			);
			if ( $best_sellers->have_posts() ) :
			while ( $best_sellers->have_posts() ) : $best_sellers->the_post();
				$permalink = get_permalink();
				$title = get_the_title();
				$slogan = get_field( 'slogan' ); 
				$image = get_the_post_thumbnail(null, 'full');
				?>
				<div class="card-best-sellers">
				<a href="<?php echo esc_url($permalink); ?>">
					<div class="card-best-sellers--image bg-[#C4C4C4]">
					<?php echo get_the_post_thumbnail(null, 'full', ['class' => 'w-full h-full object-cover']); ?>
					</div>
					<div class="card-best-sellers--content">
						<span class="overlay"></span>

						<span class="block-text"><?php the_excerpt(); ?></span>

						<div class="card-best-sellers--footer flex justify-between items-center">
							<div>
							<?php if ( $title ) : ?>
								<h2 class="card-best-sellers--title uppercase"><?php echo esc_html( $title ); ?></h2>
							<?php endif; ?>

							<?php if ( ! empty( $slogan ) ) : ?>
								<h3 class="card-best-sellers--slogan"><?php echo esc_html( $slogan ); ?></h3>
							<?php endif; ?>
							</div>
							<div class="card-best-sellers--arrow"></div>
						</div>
						</div>
				</a>
				</div>

				<?php
			endwhile;
			wp_reset_postdata();
			else :
				echo '<p class="text-gray-600">' . esc_html__( 'No best sellers yet.', 'aleandbread' ) . '</p>';
			endif;
			?>
		</div>
	</div>
</section>

<section class="experiences-overview bg-background">
	<div class="theme-grid">
		<!-- Section Titles -->
		<div class="col-start-1 md:col-start-1 xl:col-start-2 col-span-2 md:col-span-5 xl:col-span-5 xl:mt-56 gap-4 md:pt-[108px] xl:pt-0">
			<h2 class="h1 text-dark"><?php the_field( 'experiences_overview_title', 'options' ); ?></h2>
		</div>

		<div class="col-start-1 md:col-start-1 xl:col-start-8 col-span-2 md:col-span-5 xl:col-span-4 pt-6 md:pt-11 md:pb-[100px] pb-2 xl:pb-[145px] xl:pt-56">
			<p class="block-text text-dark"><?php the_field( 'experiences_overview_subtitle', 'options' ); ?></p>
		</div>


		<?php
		$image    = get_field( 'experiences_overview_image', 'options' );
		$img_url  = wp_get_attachment_image_url( $image, 'full', array( 'class' => 'object-cover md:mx-auto' ) );
		$btn_link = get_field( 'experiences_overview_link', 'options' );
		?>

			<!-- Image + Overlay + Interactive Elements -->
		<div class="col-span-2 md:col-span-6 xl:col-span-12">
			<a href="<?php echo esc_url( $btn_link['url'] ); ?>" class="gin-history-wrapper block">
				<div class="inner-content h-[343px] md:h-[672px] relative" style="background-image:url(<?php echo esc_url( $img_url ); ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
					<span class="cta-overlay">
					</span>
					<div class="gin-history-container p-6 md:p-7 xl:p-16">
						<div class="flex justify-between items-center w-full">
							<div>
								<!-- Description Popup -->
								<div class="gin-popup w-[645px] mb-[5px] md:mb-[55px] translate-y-[100%] opacity-0 pointer-events-none transition-all duration-700 max-w-[300px] md:max-w-[586px] xl:max-w-full">
									<?php the_field( 'experiences_overview_image_description', 'options' ); ?>
								</div>
								<h2 class="gin-title transition-all duration-700 max-w-[215px] md:max-w-[350px] xl:max-w-full">
									<?php the_field( 'experiences_overview_image_title', 'options' ); ?>
								</h2>
							</div>
							<!-- Toggle Button bottom-right -->
							<i class="round-button self-end">
								<svg width="16" height="25" viewBox="0 0 16 25" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.70711 0.292892C8.31658 -0.0976315 7.68342 -0.0976315 7.29289 0.292892L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292892ZM8 25L9 25L9 1L8 1L7 1L7 25L8 25Z" fill="#CC9933"/>
								</svg>
							</i>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>

</section>

<section class="section-testimonials py-12 md:py-16 xl:py-52">
		<div class="flex justify-between items-center mb-14 md:mb-16 xl:mb-20">
			<h2 class="h1 text-dark uppercase lg:ml-36"><?php the_field( 'testimonials_title', 'options' ); ?></h2>
			<div class="swiper-navigation-wrapper relative flex gap-x-4 lg:gap-x-6">
				<div class="swiper-button-prev testimonials-swiper-button-prev">
					<svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.292893 7.29289C-0.0976314 7.68342 -0.0976315 8.31658 0.292892 8.7071L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34314C8.46159 1.95262 8.46159 1.31946 8.07107 0.928931C7.68054 0.538406 7.04738 0.538406 6.65686 0.928931L0.292893 7.29289ZM25 8L25 7L1 7L1 8L1 9L25 9L25 8Z" fill="#CC9933"/>
					</svg>
				</div>
				<div class="swiper-button-next testimonials-swiper-button-next">
					<svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M24.7071 8.70711C25.0976 8.31658 25.0976 7.68342 24.7071 7.29289L18.3431 0.928932C17.9526 0.538408 17.3195 0.538408 16.9289 0.928932C16.5384 1.31946 16.5384 1.95262 16.9289 2.34315L22.5858 8L16.9289 13.6569C16.5384 14.0474 16.5384 14.6805 16.9289 15.0711C17.3195 15.4616 17.9526 15.4616 18.3431 15.0711L24.7071 8.70711ZM0 8L0 9L24 9V8V7L0 7L0 8Z" fill="#CC9933"/>
					</svg>
				</div>
			</div>
		</div>
	<!-- Swiper -->
	<div class="swiper testimonialsSwiper">
		<?php
		$testimonials_posts = get_field( 'testimonials_cards', 'options' );
		if ( $testimonials_posts ) :
			?>
			<div class="swiper-wrapper">
				<?php
				foreach ( $testimonials_posts as $post ) :
					setup_postdata( $post );
					// $rating: inteiro 1..5 vindo do ACF
					$rating = (int) ( get_field( 'rating' ) ?: 0 );
					$rating = max( 0, min( 5, $rating ) );
					?>
					<div class="swiper-slide testimonial-card bg-white py-10 pl-12 pr-16">
						<div class="flex items-center gap-1 mb-5" aria-label="<?php echo esc_attr( $rating ); ?> de 5 estrelas">
							<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
								<svg
									class="h-5 w-5 <?php echo $i <= $rating ? 'fill-[#C93]' : 'fill-gray-300'; ?>"
									viewBox="0 0 24 24" role="img" aria-hidden="true"
								>
									<path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
								</svg>
							<?php endfor; ?>
							<span class="sr-only"><?php echo esc_html( $rating ); ?>/5</span>
						</div>
						<p class="block-text text-blockText mb-8"><?php the_field( 'description' ); ?></p>
						<p class="h4"><?php the_field( 'name' ); ?></p>
						<p class="block-text text-blockText"><?php the_field( 'location' ); ?></p>
					</div>
					<?php
				endforeach;
				?>
			</div>
			<?php
			wp_reset_postdata();
		endif;
		?>
	</div>
</section>