<section id="vineyard" class="vineyard bg-dark xl:bg-transparent 2xl:h-screen 2xl:w-screen relative overflow-hidden">
  <?php
    $image_id = get_field('vineyard_background_image');
    $image_url = wp_get_attachment_image_url($image_id, 'full');
  ?>

  <!-- Mobile/Tablet full-width image with vertical overlay -->
  <?php if ($image_url): ?>
    <div class="block xl:hidden w-full relative">
      <figure class="img-overlay img-overlay--vertical">
        <img 
          src="<?php echo esc_url($image_url); ?>" 
          alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
          class="w-full h-auto object-cover"
          loading="lazy"
        />
      </figure>
    </div>
  <?php endif; ?>

  <div class="theme-container xl:px-0 !max-w-full">
    <div class="theme-grid relative">

      <!-- Desktop absolute image with horizontal overlay -->
      <?php if ($image_url): ?>
        <figure class="hidden xl:block absolute inset-0 w-full h-full z-0 img-overlay img-overlay--horizontal-right pointer-events-none">
          <img 
            src="<?php echo esc_url($image_url); ?>" 
            alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
            class="w-full h-full object-cover"
            loading="lazy"
          />
        </figure>
      <?php endif; ?>

      <!-- Placeholder for layout alignment -->
      <div class="-mx-6 xl:mx-0 col-span-2 md:col-span-6"></div>

      <!-- Text Content -->
      <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-8 pt-8 md:pt-20 xl:pt-36 pb-28 md:pb-[148px] xl:pb-36 relative z-10">
        <p class="over-title text-accent"><?php echo get_field('vineyard_over_title'); ?></p>
        <h1 class="text-blockTextLight pt-[26.5px] md:pt-[53px] xl:pt-10"><?php echo get_field('vineyard_title'); ?></h1>
        <p class="block-text text-blockTextLight pt-[26.5px] md:pt-[53px] xl:pt-10 w-[280px] md:w-[560px] xl:w-full">
          <?php echo get_field('vineyard_description'); ?>
        </p>

        <div class="flex items-center gap-[8px] md:gap-9 pt-[26.5px] md:pt-[53px] xl:pt-10">
          <img class="w-auto h-[70px]" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/icon3.svg" alt="Icon 1" />
          <p class="block-text-bold text-blockTextLight md:leading-[29.7px] w-[226px] md:w-[305px]">
            <?php echo get_field('vineyard_block_text_1'); ?>
          </p>
        </div>

        <div class="flex items-center gap-[8px] md:gap-9 pt-[26.5px] md:pt-[53px] xl:pt-10">
          <img class="w-auto h-[70px]" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/sun-and-birds.svg" alt="Icon 2" />
          <p class="block-text-bold text-blockTextLight md:leading-[29.7px] w-[226px] md:w-[305px]">
            <?php echo get_field('vineyard_block_text_2'); ?>
          </p>
        </div>
        <?php
          $button = get_field('vineyard_button');
          if( $button ):
          $link_url = $button['url'];
          $link_title = $button['title'];
          $link_target = $button['target'] ? $button['target'] : '_self';
          ?>
          <a class="btn btn-big-button pt-[29.5px] md:pt-[58px] xl:pt-16" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php echo esc_html($link_title); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>