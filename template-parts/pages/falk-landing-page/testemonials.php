<section id="testemonials" class="testemonials bg-white pb-24 md:pb-64">
	<div class="theme-container">
		<div class="theme-grid">
			
			<div class="col-span-2 md:col-span-4 xl:col-start-2 xl:col-span-5 pb-1 md:pb-10 xl:pb-12">
				<h2 class="h1 text-blockText md:max-w-[430px] xl:max-w-none"><?php echo wp_kses_post( get_field( 'testemonials_title' ) ); ?></h2>
			</div>

			<div class="col-span-2 md:col-span-6 xl:col-start-4 xl:col-span-6 pt-5">

				<?php if ( have_rows( 'testemonials_card' ) ) : ?>
					<div class="flex flex-col gap-[40px]">

						<?php while ( have_rows( 'testemonials_card' ) ) : the_row(); 
							$image = get_sub_field( 'image' );
							$text  = get_sub_field( 'text' );
							$name  = get_sub_field( 'name' );
						?>

						<div class="bg-formFields relative px-7 md:px-0 pt-10 pb-6 md:pt-10 md:pb-6 xl:pl-12 xl:pt-[74px] xl:pb-14">
							<div class="grid grid-cols-2 md:grid-cols-6 gap-x-5">
								<div class="col-span-2 md:col-start-2 md:col-span-4 xl:col-span-4">
									<?php if ( $text ) : ?>
										<p class="text-blockText xl:max-w-[450px]"><?php echo wp_kses_post( $text ); ?></p>
									<?php endif; ?>
								</div>

								<div class="col-span-2 md:col-start-2 md:col-span-4 pl-8 md:pl-0 mt-8 md:mt-8 xl:mt-0 xl:col-start-5 xl:col-span-2 xl:flex xl:flex-col xl:justify-end">
									<div class="flex items-center justify-between xl:flex-col xl:items-start xl:justify-end xl:h-full">
										<?php if ( $image ) : ?>
											<div class="xl:mb-7 xl:pl-16">
												<?php echo wp_get_attachment_image($image,'full',false,['class' => 'w-[60px] h-[60px] md:w-[72px] md:h-[72px] xl:w-[94px] xl:h-[94px] object-cover rounded-full']); ?>
											</div>
										<?php endif; ?>
										<?php if ( $name ) : ?>
											<p class="text-blockText card-name"><?php echo esc_html( $name ); ?></p>
										<?php endif; ?>
									</div>
								</div>

							</div>
						</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>