<section id="hero" class="section-hero relative overflow-hidden md:pb-[340px] ">
  <figure class="img-overlay img-overlay--horizontal-left-top absolute xl:left-0 xl:top-0 inset-0 w-full h-full xl:object-cover xl:z-[-1] pointer-events-none">

    <?php 
      $desktop_bg = get_field('hero_background');
      $mobile_bg = get_field('hero_background_tablet');
      
      if( $mobile_bg ):
        $mobile_url = wp_get_attachment_image_url($mobile_bg, 'full');
    ?>
      <!-- Mobile/Tablet background -->
      <div class="absolute inset-0 z-0 bg-cover bg-center block xl:hidden" style="background-image: url('<?php echo esc_url($mobile_url); ?>');"></div>
    <?php endif; ?>

    <?php 
      if( $desktop_bg ):
        $desktop_url = wp_get_attachment_image_url($desktop_bg, 'full');
    ?>
      <!-- Desktop background -->
      <div class="absolute inset-0 z-0 bg-cover bg-center hidden xl:block" style="background-image: url('<?php echo esc_url($desktop_url); ?>');"></div>
    <?php endif; ?>

  </figure>

  <div class="theme-container relative z-10">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-6 xl:col-span-6 xl:col-start-2 pt-40 md:pt-48 xl:pt-[275px] h-full">
        <?php do_action('breadcrumbs'); ?>
        <h1 class="text-blockTextLight pt-[56px] max-w-[240px] md:max-w-none"><?php echo get_field('hero_title'); ?></h1>
        <p class="block-text text-blockTextLight pt-[56px] md:pt-[56px] xl:pt-14 w-[343px] md:w-[560px] pb-[56px]">
          <?php echo get_field('hero_description'); ?>
        </p>
        <div class="flex flex-col items-start justify-start xl:flex-row xl:items-center gap-8 md:gap-8 xl:gap-6 pb-32 xl:pb-56 col-start-1">
            <?php
              $button = get_field('hero_button');
              if( $button ):
              $link_url = $button['url'];
              $link_title = $button['title'];
              $link_target = $button['target'] ? $button['target'] : '_self';
              ?>
              <a class="btn btn-primary w-1/2" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
              <?php echo esc_html($link_title); ?>
              </a>
            <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>