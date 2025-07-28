<section id="our-experiences" class="our-experiences bg-dark xl:bg-transparent relative overflow-hidden">
  <?php
    // ACF image fields
    $image_desktop_id = get_field('our_experience_background_image_desktop');
    $image_tablet_id  = get_field('our_experience_background_image_tablet');
    $image_mobile_id  = get_field('our_experience_background_image_mobile');

    // URLs
    $image_desktop_url = wp_get_attachment_image_url($image_desktop_id, 'full');
    $image_tablet_url  = wp_get_attachment_image_url($image_tablet_id, 'full');
    $image_mobile_url  = wp_get_attachment_image_url($image_mobile_id, 'full');
  ?>

  <!-- Mobile only -->
  <?php if ($image_mobile_url): ?>
    <div class="block md:hidden w-full relative">
      <figure class="img-overlay img-overlay--vertical">
        <img 
          src="<?php echo esc_url($image_mobile_url); ?>" 
          alt="<?php echo esc_attr(get_post_meta($image_mobile_id, '_wp_attachment_image_alt', true)); ?>" 
          class="w-full h-auto object-cover"
          loading="lazy"
        />
      </figure>
    </div>
  <?php endif; ?>

  <!-- Tablet only -->
  <?php if ($image_tablet_url): ?>
    <div class="hidden md:block xl:hidden w-full relative">
      <figure class="img-overlay img-overlay--vertical">
        <img 
          src="<?php echo esc_url($image_tablet_url); ?>" 
          alt="<?php echo esc_attr(get_post_meta($image_tablet_id, '_wp_attachment_image_alt', true)); ?>" 
          class="w-full h-auto object-cover"
          loading="lazy"
        />
      </figure>
    </div>
  <?php endif; ?>

  <!-- Desktop only -->
  <?php if ($image_desktop_url): ?>
    <figure class="hidden xl:block absolute inset-0 w-full h-full z-0 img-overlay img-overlay--horizontal-right-2 pointer-events-none">
      <img 
        src="<?php echo esc_url($image_desktop_url); ?>" 
        alt="<?php echo esc_attr(get_post_meta($image_desktop_id, '_wp_attachment_image_alt', true)); ?>" 
        class="w-full h-full object-cover"
        loading="lazy"
      />
    </figure>
  <?php endif; ?>

  <!-- Text content -->
  <div class="theme-container !max-w-full">
    <div class="theme-grid relative">
      <div class="-mx-6 xl:mx-0 col-span-2 md:col-span-6 order-1">
        <!-- Empty grid spacer for layout alignment -->
      </div>

      <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-8 pt-1 md:pt-3 xl:pt-[130px] order-2 z-10 relative">
        <p class="over-title text-accent">
          <?php echo get_field('our_experience_over_title'); ?>
        </p>
        <h1 class="text-blockTextLight pt-5 md:pt-14 max-w-[283px] md:max-w-[450px] xl:max-w-[561px]">
          <?php echo get_field('our_experience_title'); ?>
        </h1>
        <p class="block-text text-blockTextLight pt-10 md:pt-14 max-w-[276px] md:max-w-[547px]">
          <?php echo get_field('our_experience_description'); ?>
        </p>
        <?php
          $button = get_field('our_experience_button');
          if( $button ):
          $link_url = $button['url'];
          $link_title = $button['title'];
          $link_target = $button['target'] ? $button['target'] : '_self';
          ?>
          <a class="btn btn-tertiary mt-14 !border-accent mb-44" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php echo esc_html($link_title); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>