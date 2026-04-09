<section id="overview-section" class="overview-section bg-white pb-24 md:pb-64">
	<div class="theme-container">
		<div class="theme-grid">
			
			<div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-8 pb-12 md:pb-24">
				<h2 class="h1 text-blockText">
					<?php echo wp_kses_post( get_field( 'overview_title' ) ); ?>
				</h2>
			</div>
            <div class="col-span-2 md:col-start-1 md:col-span-3 xl:col-start-2 xl:col-span-3 max-w-[379px]">
                <h3 class="h2 text-blockText"><?php echo get_field( 'overview_flandria_title' ); ?></h3>
                <h4 class="h3 text-blockText pt-4"><?php echo get_field( 'overview_flandria_subtitle' ); ?></h4>
                <p class="text-blockText pb-14 pt-4"><?php echo get_field( 'overview_flandria_description' ); ?></p>
                <?php
						$button = get_field('overview_flandria_button');
						if( $button ):
						$link_url = $button['url'];
						$link_title = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
						?>
						<a class="btn btn-primary-2 mb-14 xl:mb-0" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
						<?php echo esc_html($link_title); ?>
						</a>
					<?php endif; ?>
            </div>
            <div class="col-span-2 md:col-start-4 md:col-span-3 xl:col-start-5 xl:col-span-3 xl:pl-16">
                <h3 class="h2 text-blockText"><?php echo get_field( 'overview_classic_title' ); ?></h3>
                <h4 class="h3 text-blockText pt-4"><?php echo get_field( 'overview_classic_subtitle' ); ?></h4>
                <p class="text-blockText pb-14 pt-4"><?php echo get_field( 'overview_classic_description' ); ?></p>
                <?php
						$button = get_field('overview_classic_button');
						if( $button ):
						$link_url = $button['url'];
						$link_title = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
						?>
						<a class="btn btn-primary-2 mb-14 xl:mb-0" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
						<?php echo esc_html($link_title); ?>
						</a>
					<?php endif; ?>
            </div>
            <div class="col-span-2 md:col-span-3 xl:col-start-8 xl:col-span-3 xl:pl-16">
                <h3 class="h2 text-blockText"><?php echo get_field( 'overview_signature_title' ); ?></h3>
                <h4 class="h3 text-blockText pt-4"><?php echo get_field( 'overview_signature_subtitle' ); ?></h4>
                <p class="text-blockText pb-20 pt-4"><?php echo get_field( 'overview_signature_description' ); ?></p>
                <?php
						$button = get_field('overview_signature_button');
						if( $button ):
						$link_url = $button['url'];
						$link_title = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
						?>
						<a class="btn btn-primary-2" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
						<?php echo esc_html($link_title); ?>
						</a>
					<?php endif; ?>
            </div>
		</div>
	</div>
</section>