<section id="blog" class="blog bg-dark text-align-none xl:pt-36">
	<div class="theme-container">
	<div class="theme-grid">
		<div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-6 xl:col-span-12 ">
			<h2 class="text-accent over-title capitalize pb-5 md:pb-10 xl:pb-[32px]">
				<?php echo get_field('blog_breadcrumbs'); ?>
			</h2>
		</div>
		<div class="col-span-2 md:col-span-6 xl:col-span-12"></div>
			<div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-5 xl:col-span-5">
				<h3 class="h1 text-blockTextLight pb-6 md:pb-20 xl:pb-0 xl:max-w-[724px]">
					<?php echo get_field('blog_title'); ?>
				</h3>
			</div>
			<div class="col-start-1 col-span-2 md:col-start-1 md:col-span-5 xl:col-span-4 xl:col-start-9 flex items-center">
				<p class="block-text text-blockTextLight xl:max-w-[561px]">
					<?php echo get_field('blog_description'); ?>
				</p>
			</div>
		</div>
		<div class="col-span-2 md:col-span-6 xl:col-span-4 pt-[35.5px] md:pt-[58px] xl:pt-[94px] pb-[25px] md:pb-[45px] xl:pb-[70px] ">
			<div class="theme-grid gap-6">
			<?php
			$args = array(
			'post_type'      => 'blog',
			'posts_per_page' => 3,
			'orderby'        => 'date',
			'order'          => 'DESC'
			);
			$latest_posts = new WP_Query($args);

			if ($latest_posts->have_posts()) :
			while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
				
				<article class="col-span-2 md:col-span-3 xl:col-span-4 bg-white shadow rounded pb-[30px] group hover:bg-accent transition-all duration-500 ease-in-out flex flex-col">
					<!-- Featured Image -->
					<?php if (has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>" class="block mb-4">
							<?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']); ?>
						</a>
					<?php endif; ?>

					<!-- Card content wrapper -->
					<div class="flex flex-col flex-grow px-[40px]">
						<!-- Title -->
						<h4 class="text-blockText text-xl font-semibold mb-5 pr-[30px]">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h4>

						<!-- Date -->
						<div class="block-text-bold text-accent mb-6 group-hover:text-blockTextLight">
							<?php echo get_the_date('d M Y'); ?> 
						</div>

						<!-- Description -->
						<p class="text-blockText block-text pr-[30px] mb-6">
							<?php if (get_field('blog_cpt_description')) : ?>
								<?php echo esc_html(get_field('blog_cpt_description')); ?>
							<?php endif; ?>
						</p>

						<!-- Read More bottom -->
						<div class="mt-auto">
							<a href="<?php the_permalink(); ?>" class="group text-[#0D0D0D] font-barlow text-[16px] not-italic font-semibold leading-[13px] uppercase flex items-center gap-3">
							<span class="uppercase group-hover:underline">
								<?php esc_html_e('Weiterlesen', 'aleandbread'); ?>
							</span>
							<span class="inline-block mt-1 w-8 h-4">
								<svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="w-full h-full">
								<path d="M31.7061 8.3741C32.0966 7.98357 32.0966 7.35041 31.7061 6.95989L25.3421 0.595924C24.9516 0.2054 24.3184 0.2054 23.9279 0.595924C23.5374 0.986449 23.5374 1.61961 23.9279 2.01014L29.5848 7.66699L23.9279 13.3238C23.5374 13.7144 23.5374 14.3475 23.9279 14.7381C24.3184 15.1286 24.9516 15.1286 25.3421 14.7381L31.7061 8.3741ZM0.203125 7.66699V8.66699H30.999V7.66699V6.66699H0.203125V7.66699Z" fill="#0D0D0D"/>
								</svg>
							</span>
							</a>
						</div>
					</div>
				</article>

			<?php endwhile;
			wp_reset_postdata();
			else : ?>
			<p>No posts found.</p>
			<?php endif; ?>
			</div>
		</div>
		<div class="theme-grid">
			<div class="col-span-2 md:col-span-6 xl:col-span-2 xl:col-start-6 flex justify-center">
			<?php 
			$link = get_field('blog_button');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
			?>
			<a class="btn btn-primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
				<?php echo esc_html($link_title); ?>
			</a>
			<?php endif; ?>
			</div>
		</div>
	</div>
  </div>
</section>