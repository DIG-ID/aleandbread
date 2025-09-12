<section id="content" class="content relative overflow-hidden bg-background pb-[110px] md:pb-[134px] xl:pb-[243px] pt-[152px] md:pt-[192px] xl:pt-60">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-8 xl:col-start-1 mb-14">
        <?php do_action('breadcrumbs'); ?>
      </div>
      <?php $image = get_field('events_cpt_image'); ?>
      <?php if ($image): ?>
        <div class="col-span-2 md:col-span-6 xl:col-span-6 xl:col-start-1">
          <?php echo wp_get_attachment_image($image, 'full', false, [
            'class' => 'w-full h-auto object-cover'
          ]); ?>
        </div>
      <?php endif; ?>

      <div class="col-span-2 md:col-span-6 xl:col-span-6 xl:col-start-8 pt-[52px] md:pt-[72px] xl:pt-0 flex flex-col gap-8 xl:gap-10">
        <div class="flex items-center gap-3">
          <a href="<?php echo esc_url( get_post_type_archive_link( 'event' ) ); ?>" 
            class="flex items-center gap-2 text-[#0D0D0D] font-barlow text-[16px] not-italic font-semibold leading-[13px] uppercase">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="inline-block">
              <path d="M0.497044 6.96965C0.10652 7.36017 0.10652 7.99334 0.497044 8.38386L6.86101 14.7478C7.25153 15.1383 7.88469 15.1383 8.27522 14.7478C8.66574 14.3573 8.66574 13.7241 8.27522 13.3336L2.61836 7.67676L8.27522 2.0199C8.66574 1.62938 8.66574 0.996212 8.27522 0.605688C7.8847 0.215164 7.25153 0.215163 6.86101 0.605688L0.497044 6.96965ZM32 7.67676L32 6.67676L1.20415 6.67676L1.20415 7.67676L1.20415 8.67676L32 8.67676L32 7.67676Z" fill="#0D0D0D"/>
            </svg>
            <span class="mb-1"><?php esc_html_e( 'Zurück', 'aleandbread' ); ?></span>
          </a>
        </div>


        <h2 class="text-dark font-bold text-[28px] md:text-[32px] xl:text-[36px] leading-tight w-[350px] md:w-[385px] xl:w-[437px] -mt-6">
          <?php echo get_field('events_cpt_title'); ?>
        </h2>

        <p class="text-dark block-text w-[345px] md:w-[556px]">
          <?php echo get_field('events_cpt_description'); ?>
        </p>

        <div class="flex flex-wrap gap-6 flex-col md:flex-row md:items-center text-dark text-sm font-semibold">

          <div class="flex items-center gap-2">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/clock.svg" alt="Clock" />
            <span class="block-text-bold -mb-0.5"><?php echo get_field('events_cpt_time'); ?></span>
          </div>

          <div class="flex items-center gap-2">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/calendar.svg" alt="Calendar" />
            <span class="block-text-bold mb-0.5"><?php echo get_field('events_cpt_date'); ?></span>
          </div>

          <div class="flex items-center gap-2">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
            <span class="block-text-bold mb-0.5"><?php echo get_field('events_cpt_place'); ?></span>
          </div>

        </div>

        <div>
          <?php
            $button = get_field('events_cpt_button');
            if( $button ):
            $link_url = $button['url'];
            $link_title = $button['title'];
            $link_target = $button['target'] ? $button['target'] : '_self';
            ?>
            <a class="btn btn-tertiary mt-4 w-[260px] !inline pr-12" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
            <?php echo esc_html($link_title); ?>
            </a>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</section>