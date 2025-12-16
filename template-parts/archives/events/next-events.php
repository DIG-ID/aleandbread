<?php
/**
 * The events archive page content with loops.
 *
 * @package aleandbread
 */

?>
<section id="next-events" class="section-next-events relative overflow-hidden bg-background mt-[55px] md:mt-[92px] xl:mt-[195px]">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-12 xl:col-start-2">
			<h2 class="h2 mb-20"><?php esc_html_e( 'Kommende Events', 'aleandbread' ); ?></h2>
		</div>
	</div>

	<div class="theme-container relative z-10">

		<?php
		// Find current date time.
		$date_now = current_time( 'mysql' );

		$args = array(
			'post_type'      => 'event',
			'posts_per_page' => -1,
			'orderby'        => 'meta_value',
			'order'          => 'ASC',
			'meta_key'       => 'events_cpt_event_date_start',
			'meta_query'     => array(
				array(
					'key'     => 'events_cpt_event_date_start',
					'compare' => '>=',
					'value'   => $date_now,
					'type'    => 'DATETIME',
				),
			),
		);

		$the_query = new WP_Query( $args );
		?>
		<?php if ( $the_query->have_posts() ) : ?>

			<div class="events-swiper-scope" data-events-swiper="future">
				<div class="swiper events-unified-swiper" >
					<ul class="swiper-wrapper" >
						<?php
						$the_query = new WP_Query( $args );
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							?>
							<li class="swiper-slide w-full md:w-full xl:w-[33.33%] flex-shrink-0 md:pr-4">
								<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-item pb-7 md:pb-0' ); ?>>
									<!-- Thumbnail -->
									<?php
									if ( get_the_post_thumbnail() ) :
										the_post_thumbnail( 'event-thumb', array( 'class' => 'rounded-xl w-full h-auto object-cover' ) );
									endif;
									?>

									<!-- Title -->
									<h4 class="pt-4"><?php the_title(); ?></h4>

									<!-- Date -->
									<?php aab_event_meta( get_the_ID() ); ?>

									<!-- Short description -->
									<p class="text-dark block-text pt-4"><?php the_field( 'events_cpt_small_description' ); ?></p>

									<!-- Link -->
									<a href="<?php the_permalink(); ?>" class="group flex items-center gap-3 pt-6 md:pt-12">
										<span class="text-dark font-barlow text-[16px] not-italic font-semibold leading-[13px] uppercase flex items-center group-hover:underline"><?php esc_html_e( 'Mehr Erfahren', 'aleandbread' ); ?></span>
										<div class="ml-1 mt-[2px] md:mt-1 w-3 md:w-6">
											<span class="inline-block mt-1 w-8 h-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="w-full h-full">
													<path d="M31.7061 8.3741C32.0966 7.98357 32.0966 7.35041 31.7061 6.95989L25.3421 0.595924C24.9516 0.2054 24.3184 0.2054 23.9279 0.595924C23.5374 0.986449 23.5374 1.61961 23.9279 2.01014L29.5848 7.66699L23.9279 13.3238C23.5374 13.7144 23.5374 14.3475 23.9279 14.7381C24.3184 15.1286 24.9516 15.1286 25.3421 14.7381L31.7061 8.3741ZM0.203125 7.66699V8.66699H30.999V7.66699V6.66699H0.203125V7.66699Z" fill="#0D0D0D"/>
												</svg>
											</span>
										</div>
									</a>

								</article>
								<?php the_content(); ?>
							</li>
							<?php
						endwhile;
						?>
					</ul>
					<div class="cmd:col-span-6 xl:col-span-12 flex items-center justify-center">
						<div class="events-controls gap-4 mt-[50px] md:mt-[75px] xl:mt-[90px]">
							<span class="swiper-button-prev-2" aria-label="Previous"></span>
							<div class="events-pagination"></div>
							<span class="swiper-button-next-2" aria-label="Next"></span>
						</div>
					</div>
				</div>
			</div>

			<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<div class="bg-gray-300 rounded p-6 mb-16 md:mb-16 xl:mb-32">
				<p class="text-dark block-text font-semibold"><?php esc_html_e( 'Derzeit sind keine Veranstaltungen geplant. Besuchen Sie uns bald wieder für weitere Neuigkeiten.', 'aleandbread' ); ?></p>
			</div>
			
		<?php endif; ?>

	</div>

</section>
