<section id="hero" class="hero relative overflow-hidden pt-28 md:pt-[360px] xl:pt-52">

	<?php
	$desktop_bg    = get_field( 'hero_background' );
	$tablet_bg_id  = get_field( 'hero_background_tablet' );
	$tablet_bg     = wp_get_attachment_image_url( $tablet_bg_id, 'full' );
	?>

	<!-- Desktop background -->
	<?php if ( $desktop_bg ) : ?>
		<figure class="img-overlay img-overlay--vertical-3 absolute inset-0 w-full h-full z-0 pointer-events-none hidden xl:block">
			<?php echo wp_get_attachment_image( $desktop_bg, 'full', false, array( 'class' => 'absolute inset-0 w-full h-full object-cover', 'alt' => '' ) ); ?>
		</figure>
	<?php endif; ?>

	<!-- Tablet/Mobile background -->
	<?php if ( $tablet_bg ) : ?>
		<figure class="img-overlay img-overlay--vertical absolute inset-0 w-full h-full z-0 pointer-events-none block xl:hidden">
			<?php echo wp_get_attachment_image( $tablet_bg_id, 'full', false, array( 'class' => 'absolute inset-0 w-full h-full object-cover', 'alt' => '' ) ); ?>
		</figure>
	<?php endif; ?>

	<!-- Content Container -->
	<div class="theme-container relative z-10 h-full md:h-auto">
		<div class="theme-grid h-full md:h-auto items-end pb-12 md:pb-20 xl:pb-40">
			<div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-9 xl:col-span-4">
				<h1 class="text-blockTextLight">
					<?php echo get_field( 'hero_title' ); ?>
				</h1>

				<p class="block-text text-blockTextLight pt-8 xl:pt-16 max-w-[343px] md:max-w-[445px] xl:max-w-none">
					<?php echo get_field( 'hero_description' ); ?>
				</p>

				<div class="flex flex-col items-start justify-start xl:flex-row xl:items-center gap-8 md:gap-8 xl:gap-6">
					<?php
					$button = get_field( 'hero_button' );
					if ( $button ) :
						$link_url    = $button['url'];
						$link_title  = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
					?>
						<a class="btn btn-primary w-[250px]" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
							<?php echo esc_html( $link_title ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<a class="btn btn-scroll !hidden xl:block absolute bottom-16 left-8"></a>
		</div>
	</div>

</section>