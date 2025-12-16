<section id="newsletter" class="newsletter bg-dark pb-20 md:pb-48 xl:pb-36 -mt-1">
	<div class="theme-container">
		<div class="theme-grid">
			<div class="col-span-2 md:col-span-6 xl:col-span-12">
				<h2 class="over-title text-accent"><?php echo get_field('newsletter_overtitle'); ?></h2>
			</div>
			<div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-5 xl:col-span-4">
				<h3 class="h1 text-blockTextLight pt-8 pb-8 col-span-2">
					<?php echo get_field('newsletter_title'); ?>
				</h3>
				<p class="text-blockTextLight block-text text-base md:text-lg leading-normal">
					<?php echo get_field('newsletter_description'); ?>
				</p>
			</div>

			<div class="col-start-1 md:col-start-1 xl:col-start-7 col-span-2 md:col-span-6 xl:col-span-6">
				<?php 
				$form_shortcode = get_field('newsletter_newsletter_shortcode', 'option');
				echo do_shortcode($form_shortcode);
				?>
			</div>
		</div>
	</div>
</section>