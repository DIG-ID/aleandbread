<?php
get_header();
do_action( 'before_main_content' );
get_template_part( 'template-parts/pages/page-header' );
?>
<div class="section-news-content pb-28 lg:pb-16">
	<div class="theme-container">
		<div class="theme-grid">
			<?php
			if ( have_posts() ) :
				$i = 0;
				while ( have_posts() ) :
					the_post();
					if ( 0 === $i ) :
						?>
						<div class="card-news col-span-2 lg:col-span-8 bg-white rounded-[20px] overflow-hidden ">
							<?php
							if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'full', array( 'class' => 'w-full object-cover' ) );
							else :
								?>
								<span class="bg-blue-shade-1 w-full h-[275px] lg:h-[345px] flex justify-center items-center font-poppins text-blue-shade-2">no thumbnail</span>
								<?php
							endif;
							?>
							<div class="card-news-content min-h-[200px] px-14 pt-9">
								<a href="<?php the_permalink(); ?>" class="flex items-center gap-x-4 mb-6">
									<h2 class="text-title-h2 text-blue-shade-5"><?php the_title(); ?></h2>
									<svg width="59" height="12" viewBox="0 0 59 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M58.4123 6.53033C58.7052 6.23744 58.7052 5.76256 58.4123 5.46967L53.6393 0.696699C53.3464 0.403806 52.8716 0.403806 52.5787 0.696699C52.2858 0.989592 52.2858 1.46447 52.5787 1.75736L56.8213 6L52.5787 10.2426C52.2858 10.5355 52.2858 11.0104 52.5787 11.3033C52.8716 11.5962 53.3464 11.5962 53.6393 11.3033L58.4123 6.53033ZM0 6.75H57.882V5.25H0V6.75Z" fill="#3E6C8A"/>
									</svg>
								</a>
								<p class="text-body text-blue-shade-5"><?php echo esc_html( get_the_excerpt() ); ?></p>
							</div>
						</div>
						<?php
					else :
						?>
						<div class="card-news col-span-2 lg:col-span-4 bg-white rounded-[20px] overflow-hidden ">
							<?php
							if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'full', array( 'class' => 'w-full object-cover' ) );
							else :
								?>
								<span class="bg-blue-shade-1 w-full h-[275px] lg:h-[345px] flex justify-center items-center font-poppins text-blue-shade-2">no thumbnail</span>
								<?php
							endif;
							?>
							<div class="card-news-content">
								<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
								<p><?php the_excerpt(); ?></p>
							</div>
						</div>
						<?php
					endif;
					$i++;
				endwhile;
			endif;
			?>
		</div>
	</div>
</div>
<?php
do_action( 'after_main_content' );
get_footer();
