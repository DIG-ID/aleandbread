<section id="overview" class="overview bg-white pb-24 md:pb-64">
	<div class="theme-container">
		<div class="theme-grid">
			
			<div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-8 pb-12 md:pb-24">
				<h1 class="text-blockText">
					<?php echo wp_kses_post( get_field( 'overview_title' ) ); ?>
				</h1>
			</div>
            <div class="col-span-2 md:col-span-4 xl:col-start-2 xl:col-span-3 max-w-[379px]">
                <h2 class="text-blockText"><?php echo get_field( 'overview_flandria_title' ); ?></h2>
                <h3 class="text-blockText pt-4"><?php echo get_field( 'overview_flandria_subtitle' ); ?></h3>
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
            <div class="col-span-2 md:col-span-4 xl:col-start-5 xl:col-span-3 xl:pl-16">
                <h2 class="text-blockText"><?php echo get_field( 'overview_classic_title' ); ?></h2>
                <h3 class="text-blockText pt-4"><?php echo get_field( 'overview_classic_subtitle' ); ?></h3>
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
            <div class="col-span-2 md:col-span-4 xl:col-start-8 xl:col-span-3 xl:pl-14">
                <h2 class="text-blockText"><?php echo get_field( 'overview_signature_title' ); ?></h2>
                <h3 class="text-blockText pt-4"><?php echo get_field( 'overview_signature_subtitle' ); ?></h3>
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