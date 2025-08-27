<section id="events" class="events bg-dark xl:bg-transparent relative overflow-hidden pb-[91px] md:pb-[180px] xl:pb-[223px]">
  <?php
    // ACF image fields
    $desktop_tablet_image_id = get_field('events_background_image'); // Used for desktop and tablet
    $mobile_image_id = get_field('events_background_image_mobile');  // Mobile only

    // URLs
    $desktop_tablet_image_url = wp_get_attachment_image_url($desktop_tablet_image_id, 'full');
    $mobile_image_url = wp_get_attachment_image_url($mobile_image_id, 'full');
  ?>

  <!-- Mobile only: Different image + vertical overlay -->
  <?php if ($mobile_image_url): ?>
    <div class="block md:hidden w-full relative">
      <figure class="img-overlay img-overlay--vertical">
        <img 
          src="<?php echo esc_url($mobile_image_url); ?>" 
          alt="<?php echo esc_attr(get_post_meta($mobile_image_id, '_wp_attachment_image_alt', true)); ?>" 
          class="w-full h-auto object-cover"
          loading="lazy"
        />
      </figure>
    </div>
  <?php endif; ?>

  <!-- Tablet only: Shared image + vertical overlay -->
  <?php if ($desktop_tablet_image_url): ?>
    <div class="hidden md:block xl:hidden w-full relative">
      <figure class="img-overlay img-overlay--vertical">
        <img 
          src="<?php echo esc_url($desktop_tablet_image_url); ?>" 
          alt="<?php echo esc_attr(get_post_meta($desktop_tablet_image_id, '_wp_attachment_image_alt', true)); ?>" 
          class="w-full h-auto object-cover"
          loading="lazy"
        />
      </figure>
    </div>
  <?php endif; ?>

  <!-- Desktop only: Shared image + horizontal overlay -->
  <?php if ($desktop_tablet_image_url): ?>
    <figure class="hidden xl:block absolute inset-0 w-full h-full z-0 img-overlay img-overlay--horizontal-right-2 pointer-events-none">
      <img 
        src="<?php echo esc_url($desktop_tablet_image_url); ?>" 
        alt="<?php echo esc_attr(get_post_meta($desktop_tablet_image_id, '_wp_attachment_image_alt', true)); ?>" 
        class="w-full h-full object-cover"
        loading="lazy"
      />
    </figure>
  <?php endif; ?>

  <!-- Text content -->
  <div class="theme-container !max-w-full">
    <div class="theme-grid relative">
      <!-- Empty div to align with grid -->
      <div class="-mx-6 xl:mx-0 col-span-2 md:col-span-6"></div>

      <!-- Main content -->
      <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-8 xl:pt-[130px] relative z-10">
        <p class="over-title text-accent">
          <?php echo get_field('events_over_title'); ?>
        </p>
        <h1 class="text-blockTextLight pt-[26px] md:pt-[53px] w-[282.7px] md:w-[561px] xl:w-full">
          <?php echo get_field('events_title'); ?>
        </h1>
        <p class="block-text text-blockTextLight pb-[26px] md:pb-[53px] pt-[26px] md:pt-[53px] w-[282.7px] md:w-[561px] xl:w-full">
          <?php echo get_field('events_description'); ?>
        </p>
        <?php
          $button = get_field('events_button');
          if( $button ):
          $link_url = $button['url'];
          $link_title = $button['title'];
          $link_target = $button['target'] ? $button['target'] : '_self';
          ?>
          <a class="btn btn-primary-2" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php echo esc_html($link_title); ?>
          </a>
        <?php endif; ?>
        </a>
      </div>
    </div>
  </div>
</section>