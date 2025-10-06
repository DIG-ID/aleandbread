<section id="shopping-policy" class="shopping-policy bg-background pb-[136px] md:pb-[200px] xl:pb-[119px] pt-36 md:pt-44 xl:pt-52">
	<div class="theme-container">
		<div class="theme-grid">
			
			<!-- Breadcrumbs -->
			<div class="text-accent col-start-1 col-span-2 md:col-span-6 xl:col-start-2">
				<?php do_action('breadcrumbs'); ?>
			</div>

			<!-- Title -->
			<h1 class="text-dark col-start-1 col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-4">
				<?php echo get_field('shipping_policy_title'); ?>
			</h1>

			<!-- Content Blocks -->
			<div class="theme-grid col-start-1 col-span-2 md:col-span-6 xl:col-start-1 xl:col-span-12 pt-[55px] md:pt-[75px] xl:pt-[135px] gap-y-12">

				<!-- Block 1 -->
				<div class="col-span-2 md:col-span-6 xl:col-start-1 xl:col-span-4">
					<div class="flex items-center gap-2 mb-4">
						<img class="inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
						<p class="block-text !font-medium uppercase text-accent">
							<?php echo get_field('shipping_policy_local_1'); ?>
						</p>
					</div>
					<p class="text-dark block-text !text-xl max-w-[350px] md:max-w-[492px]">
						<?php echo get_field('shipping_policy_local_1_description'); ?>
					</p>
				</div>

				<!-- Block 2 -->
				<?php
				$block2 = get_field( 'shipping_policy_local_2' );
				if ( $block2 ) :
					?>
					<div class="col-span-2 md:col-span-6 xl:col-start-5 xl:col-span-4">
						<div class="flex items-center gap-2 mb-4">
							<img class="inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
							<p class="block-text !font-medium uppercase text-accent">
								<?php echo get_field('shipping_policy_local_2'); ?>
							</p>
						</div>
						<p class="text-dark block-text !text-xl max-w-[350px] md:max-w-[492px]">
							<?php echo get_field('shipping_policy_local_2_description'); ?>
						</p>
					</div>
					<?php
				endif;
				?>

				<!-- Block 3 -->
				<?php
				$block3 = get_field( 'shipping_policy_local_3' );
				if ( $block3 ) :
					?>
					<div class="col-span-2 md:col-span-6 xl:col-start-9 xl:col-span-4">
						<div class="flex items-center gap-2 mb-4">
							<img class="inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
							<p class="block-text !font-medium uppercase text-accent">
								<?php echo get_field('shipping_policy_local_3'); ?>
							</p>
						</div>
						<p class="text-dark block-text !text-xl max-w-[350px] md:max-w-[492px]">
							<?php echo get_field('shipping_policy_local_3_description'); ?>
						</p>
					</div>
					<?php
				endif;
				?>

			</div>
		</div>
	</div>
</section>