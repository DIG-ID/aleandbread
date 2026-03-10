<section id="other-products" class="other-products bg-white pb-24 md:pb-64">
	<div class="theme-container woocommerce">
		<div class="theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-4">
				<h1 class="text-blockText"><?php echo wp_kses_post( get_field( 'other_products_title' ) ); ?></h1>
            </div>

            <div class="col-span-2 md:col-span-6 xl:col-start-8 xl:col-span-4 pt-7 md:pt-14 xl:pt-0">
				<p class="text-blockText xl:max-w-[500px]"><?php echo wp_kses_post( get_field( 'other_products_description' ) ); ?></p>
            </div>

            <div class="col-span-2 md:col-span-6 xl:col-start-1 xl:col-span-12 pt-7 md:pt-12 ">
				<?php
				$experience_cards = get_field( 'other_products_card' );
				if ( $experience_cards ) :
				?>

				<!-- Tablet / Mobile Swiper -->
                <div class="xl:hidden -mr-4 md:mr-0">
                    <div class="swiper otherProductsSwiper opacity-0">
                        <div class="swiper-wrapper">
                            <?php foreach ( $experience_cards as $card ) :

                                $title       = $card['title'] ?? '';
                                $description = $card['description'] ?? '';
                                $image       = $card['image'] ?? '';
                                $button      = $card['button'] ?? '';

                                $link_url    = $button['url'] ?? '';
                                $link_title  = $button['title'] ?? '';
                                $link_target = $button['target'] ?? '_self';

                                $img_url = '';

                                if ( $image ) {
                                    if ( is_array( $image ) ) {
                                        $img_url = $image['url'];
                                    } else {
                                        $img_url = wp_get_attachment_image_url( $image, 'full' );
                                    }
                                }
                            ?>
                                <div class="swiper-slide">
                                    <div class="card-category card-category--experiences overflow-hidden min-h-[340px] md:min-h-[540px] flex flex-col"
                                        style="background-image:url(<?php echo esc_url( $img_url ); ?>); background-size:cover; background-position:center;">

                                        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"
                                            class="flex flex-col flex-1 justify-end">
                                            <div class="card-category--content">
                                                <span class="overlay"></span>

                                                <?php if ( $description ) : ?>
                                                    <p class="block-text">
                                                        <?php echo esc_html( $description ); ?>
                                                    </p>
                                                <?php endif; ?>

                                                <div class="card-category--title-wrapper flex justify-between items-center w-full">
                                                    <?php if ( $title ) : ?>
                                                        <h2 class="card-category--title">
                                                            <?php echo esc_html( $title ); ?>
                                                        </h2>
                                                    <?php endif; ?>
                                                    <i class="card-category--arrow"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

				<!-- Desktop Grid — wrapped in hidden/xl:block to avoid theme-grid overriding Tailwind's hidden -->
				<div class="hidden xl:block">
					<ul class="shop-categories theme-grid mb-14 xl:mb-16">
						<?php foreach ( $experience_cards as $card ) :

							$title       = $card['title'] ?? '';
							$description = $card['description'] ?? '';
							$image       = $card['image'] ?? '';
							$button      = $card['button'] ?? '';

							$link_url    = $button['url'] ?? '';
							$link_title  = $button['title'] ?? '';
							$link_target = $button['target'] ?? '_self';

							$img_url = '';

							if ( $image ) {
								if ( is_array( $image ) ) {
									$img_url = $image['url'];
								} else {
									$img_url = wp_get_attachment_image_url( $image, 'full' );
								}
							}
						?>

						<li class="card-category card-category--experiences col-span-2 md:col-span-3 xl:col-span-4 overflow-hidden mb-6 xl:mb-0"
							style="background-image:url(<?php echo esc_url($img_url); ?>); background-size:cover; background-position:center;">

							<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"
								class="flex flex-col justify-end h-full">

								<div class="card-category--content">
									<span class="overlay"></span>

									<?php if ($description) : ?>
										<p class="block-text">
											<?php echo esc_html($description); ?>
										</p>
									<?php endif; ?>

									<div class="card-category--title-wrapper flex justify-between items-center w-full">
										<?php if ($title) : ?>
											<h2 class="card-category--title">
												<?php echo esc_html($title); ?>
											</h2>
										<?php endif; ?>
										<i class="card-category--arrow"></i>
									</div>
								</div>

							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<?php endif; ?>
            </div>
		</div>
	</div>
</section>