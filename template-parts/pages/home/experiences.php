<section id="experiences-overview" class="experiences-overview bg-dark pb-0 md:pb-36 xl:pb-28 pt-0 md:pt-0 xl:pt-10 -mt-1">
	<div class="theme-container">
		<div class="theme-grid">
			<div class="col-span-2 md:col-span-6 xl:col-start-4 xl:col-span-6 flex flex-col items-center gap-y-7 md:gap-y-12 mb-16">
				<p class="over-title text-accent"><?php echo esc_html( get_field( 'experiences_over_title' ) ); ?></p>
				<h2 class="text-blockTextLight"><?php echo wp_kses_post( get_field( 'experiences_title' ) ); ?></h2>
				<div class="text-blockTextLight text-center"><?php echo wp_kses_post( get_field( 'experiences_description' ) ); ?></div>
			</div>
		</div>

		<?php
		// Mostra as categorias desejadas com ACF.
		$shop_exp_cats = get_field( 'experiences_categories' );
		if ( $shop_exp_cats ) :
			?>
			<ul class="shop-categories theme-grid mb-14 xl:mb-16">
				<?php
				foreach ( $shop_exp_cats as $exp_cat ) :
					$thumb_id = get_term_meta( $exp_cat->term_id, 'thumbnail_id', true );
					$img = $thumb_id ? wp_get_attachment_image( $thumb_id, 'medium', false, array( 'class' => 'w-full h-auto' ) ) : '';
					$img_url = wp_get_attachment_image_url( $thumb_id, 'full' );
					?>
					<li class="card-category card-category--experiences col-span-2 md:col-span-3 xl:col-span-4 overflow-hidden mb-6 xl:mb-0" style="background-image:url(<?php echo esc_url( $img_url ); ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
						<a href="<?php echo esc_url( get_term_link( $exp_cat ) ); ?>">
							<div class="card-category--content">
								<span class="overlay"></span>
								<p class="block-text"><?php echo esc_html( $exp_cat->description ); ?></p>
								<div class="card-category--title-wrapper flex justify-between items-center w-full">
									<h2 class="card-category--title"><?php echo esc_html( $exp_cat->name ); ?></h2>
									<i class="card-category--arrow"></i>
								</div>
							</div>
						</a>
					</li>
					<?php
				endforeach;
				?>
			</ul>
			<?php
		endif;
		?>

		<div class="theme-grid">
			<div class="col-span-2 md:col-span-6 xl:col-span-12 hidden md:flex justify-center items-center">
				<?php
				$btn      = get_term_link( 'erlebnisse', 'product_cat' );
				$btn_text = get_field( 'experiences_button_text' );
				if ( $btn ) :
					?>
					<a class="btn btn-primary" href="<?php echo esc_url( $btn ); ?>" target="_self"><?php echo esc_html( ! empty( trim( (string) $btn_text ) ) ? $btn_text : __( 'Jetzt buchen', 'aleandbread' ) ); ?></a>
					<?php
				endif;
				?>
			</div>
		</div>
	</div>
</section>