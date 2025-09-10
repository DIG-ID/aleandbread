<section id="distellerie" class="distellerie bg-dark xl:bg-transparent 2xl:h-screen 2xl:w-screen relative overflow-hidden">
  <?php
    // Get both images from ACF
    $desktop_image_id = get_field('distellerie_background_image');
    $tablet_image_id = get_field('distellerie_background_image_tablet');

    $desktop_image_url = wp_get_attachment_image_url($desktop_image_id, 'full');
    $tablet_image_url = wp_get_attachment_image_url($tablet_image_id, 'full');
  ?>

  <!-- Tablet/Mobile full-width background image -->
  <?php if ($tablet_image_url): ?>
    <div class="block xl:hidden w-full h-full">
      <img 
        src="<?php echo esc_url($tablet_image_url); ?>" 
        alt="<?php echo esc_attr(get_post_meta($tablet_image_id, '_wp_attachment_image_alt', true)); ?>"
        class="w-full h-auto object-cover"
        loading="lazy"
      />
    </div>
  <?php endif; ?>

  <div class="theme-container xl:px-0 !max-w-full h-full">
    <div class="theme-grid relative h-full">

      <!-- Desktop background image (positioned absolutely) -->
      <?php if ($desktop_image_url): ?>
        <figure class="hidden xl:block absolute inset-0 w-full h-full z-0 pointer-events-none">
          <img 
            src="<?php echo esc_url($desktop_image_url); ?>" 
            alt="<?php echo esc_attr(get_post_meta($desktop_image_id, '_wp_attachment_image_alt', true)); ?>" 
            class="w-full h-full object-cover"
            loading="lazy"
          />
        </figure>
      <?php endif; ?>

      <!-- Placeholder div to align layout -->
      <div class="-mx-6 xl:mx-0 col-span-2 md:col-span-6"></div>

      <!-- Text content -->
      <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-2 pt-8 md:pt-20 xl:pt-36 pb-28 md:pb-[148px] xl:pb-36 relative z-10">
        <p class="over-title text-accent">
          <?php echo get_field('distellerie_over_title'); ?>
        </p>
        <h1 class="text-blockTextLight pt-[35.5px] md:pt-[58px] xl:pt-10">
          <?php echo get_field('distellerie_title'); ?>
        </h1>
        <p class="block-text text-blockTextLight pt-[35.5px] md:pt-[58px] xl:pt-10 w-[343px] md:w-[560px] xl:w-full">
          <?php echo get_field('distellerie_description'); ?>
        </p>

        <div class="flex items-center gap-9 pt-[35.5px] md:pt-[58px] xl:pt-10">
          <img class="w-auto h-[70px]" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/icon1.svg" alt="Icon 1" />
          <p class="block-text-bold text-blockTextLight md:leading-[29.7px] max-w-[200px] md:max-w-[320px]">
            <?php echo get_field('distellerie_block_text_1'); ?>
          </p>
        </div>

        <div class="flex items-center gap-9 pt-[35.5px] md:pt-[58px] xl:pt-10">
          <img class="w-auto h-[70px]" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/icon2.svg" alt="Icon 2" />
          <p class="block-text-bold text-blockTextLight md:leading-[29.7px] max-w-[200px] md:max-w-[320px]">
            <?php echo get_field('distellerie_block_text_2'); ?>
          </p>
        </div>
        <?php
          $button = get_field('distellerie_button');
          if( $button ):
          $link_url = $button['url'];
          $link_title = $button['title'];
          $link_target = $button['target'] ? $button['target'] : '_self';
          ?>
          <a class="btn btn-big-button pt-[38.5px]" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php echo esc_html($link_title); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>