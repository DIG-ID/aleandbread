<section id="outro" class="outro bg-dark xl:bg-transparent relative overflow-hidden">
	<?php
		$image_desktop_id = get_field('outro_background');
		$image_desktop_url = wp_get_attachment_image_url($image_desktop_id, 'full');

		$image_mobile_tablet_id = get_field('outro_background_tablet');
		$image_mobile_tablet_url = wp_get_attachment_image_url($image_mobile_tablet_id, 'full');
	?>

	<!-- Mobile & Tablet Background Image (outside container for full width) -->
	<?php if ($image_mobile_tablet_url): ?>
		<div class="block xl:hidden absolute inset-0 w-full h-full z-0 pointer-events-none">
			<figure class="img-overlay img-overlay--vertical w-full h-full">
				<img 
					src="<?php echo esc_url($image_mobile_tablet_url); ?>" 
					alt="<?php echo esc_attr(get_post_meta($image_mobile_tablet_id, '_wp_attachment_image_alt', true)); ?>" 
					class="w-full h-full object-cover"
					loading="lazy"
				/>
			</figure>
		</div>
	<?php endif; ?>

	<div class="theme-container xl:px-0 !max-w-full relative z-10">
		<div class="theme-grid relative">

			<!-- Desktop Image -->
			<?php if ($image_desktop_url): ?>
				<figure class="img-overlay img-overlay--vertical xl:absolute xl:left-0 xl:top-0 inset-0 w-full h-full xl:object-cover xl:z-[-1] pointer-events-none hidden xl:block">
					<img 
						src="<?php echo esc_url($image_desktop_url); ?>" 
						alt="<?php echo esc_attr(get_post_meta($image_desktop_id, '_wp_attachment_image_alt', true)); ?>" 
						class="w-full h-full object-cover"
						loading="lazy"
					/>
				</figure>
			<?php endif; ?>

			<!-- Logo -->
			<div class="col-span-full flex justify-center">
				<?php 
					$image = get_field('theme_logo', 'option');
					$size = 'full';
					$classes = 'w-[184px] md:w-[270px] pt-[36px] md:pt-[90px]';
					if( $image ) {
							echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
					}
				?>
			</div>

			<!-- Text -->
			<div class="col-span-2 md:col-span-6 xl:col-span-12 col-start-1 pt-[26px] md:pt-[72px] flex flex-col items-center text-center">
				<h2 class="h1 text-accent w-[375px] md:w-[681px] xl:w-[1137px]"><?php echo get_field('outro_title'); ?></h2>
				<h3 class="text-blockTextLight pt-[26px] md:pt-[72px] pb-[57px] md:pb-[114px] xl:pb-[126px] w-[345px] md:w-[501px] xl:w-[700px]">
					<?php echo get_field('outro_description'); ?>
				</h3>
			</div>

		</div>
	</div>
</section>