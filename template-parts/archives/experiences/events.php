<section id="events" class="events relative overflow-hidden bg-dark xl:bg-transparent">
  <?php
    $image_id = get_field('experiences_events_background_image', 'option');
    $image_url = wp_get_attachment_image_url($image_id, 'full');
  ?>
  
  <?php if ($image_url): ?>
    <figure class="xl:absolute inset-0 xl:w-full xl:h-full xl:z-0 relative w-auto h-auto z-auto pointer-events-none img-overlay img-overlay--horizontal-right-2">
      <img 
        src="<?php echo esc_url($image_url); ?>" 
        alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
        class="w-full h-full xl:object-cover object-contain"
        loading="lazy"
      />
    </figure>
  <?php endif; ?>

  <div class="theme-container !max-w-full relative z-10">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-8 xl:pt-[130px]">
        <p class="over-title text-accent">
          <?php echo get_field('experiences_events_over_title', 'option'); ?>
        </p>
        <h1 class="text-blockTextLight pt-7 md:pt-14 w-[283px] md:w-[561px] xl:w-full">
          <?php echo get_field('experiences_events_title', 'option'); ?>
        </h1>
        <p class="block-text text-blockTextLight pt-10 md:pt-14 w-[276px] md:w-[547px] xl:w-full pb-[27px] md:pb-[53px]">
          <?php echo get_field('experiences_events_description', 'option'); ?>
        </p>
        <?php
            $button = get_field('experiences_events_button', 'option');
            if( $button ):
            $link_url = $button['url'];
            $link_title = $button['title'];
            $link_target = $button['target'] ? $button['target'] : '_self';
            ?>
            <a class="btn btn-tertiary !border-accent mb-[108px] md:mb-[165px] xl:mb-[223px]" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
            <?php echo esc_html($link_title); ?>
            </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>