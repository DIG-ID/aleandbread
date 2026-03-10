<section id="quality-promise" class="quality-promise bg-white pb-24 md:pb-64">
	<div class="theme-container">
		<div class="theme-grid">
			
			<div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-6 pb-12 md:pb-24">
				<h1 class="text-blockText">
					<?php echo wp_kses_post( get_field( 'quality_promise_title' ) ); ?>
				</h1>
			</div>

			<div class="col-span-2 md:col-span-6 xl:col-start-3 xl:col-span-9 pb-28 md:pb-64">
				<?php if ( have_rows( 'quality_promise_items' ) ) : ?>
					<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-y-12 md:gap-y-16 md:gap-x-12 xl:gap-x-28">
						
						<?php while ( have_rows( 'quality_promise_items' ) ) : the_row(); 
							$icon = get_sub_field( 'icon' );
							$text = get_sub_field( 'text' );
						?>
							<div class="flex items-center gap-6 md:flex-col md:items-center md:text-center">
								
								<?php if ( $icon ) : ?>
									<div class="">
										<?php echo wp_get_attachment_image(
											$icon,
											'full',
											false,
											[
												'class' => 'w-12 h-12 md:w-14 md:h-14 xl:w-16 xl:h-16 object-contain xl:mb-6'
											]
										); ?>
									</div>
								<?php endif; ?>

								<?php if ( $text ) : ?>
									<p class="block-text-bold text-blockText"><?php echo esc_html( $text ); ?></p>
								<?php endif; ?>

							</div>
						<?php endwhile; ?>

					</div>
				<?php endif; ?>
			</div>
			<div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-4 xl:pb-24">
				<h1 class="text-blockText"><?php echo wp_kses_post( get_field( 'quality_promise_title_2' ) ); ?></h1>
            </div>
            <div class="col-span-2 md:col-span-4 xl:col-start-6 xl:col-span-4 pt-7 md:pt-14 xl:pt-0">
				<p class="text-blockText"><?php echo wp_kses_post( get_field( 'quality_promise_description_2' ) ); ?></p>
            </div>

		</div>
	</div>
</section>