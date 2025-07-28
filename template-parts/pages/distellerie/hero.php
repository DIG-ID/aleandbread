<section id="hero" class="section-hero pb-0 relative overflow-hidden md:min-h-[1100px] xl:h-[670px]">  
  
<!-- Background Overlay -->

  <?php 
    $desktop_bg = get_field('hero_background');
    $tablet_bg_id = get_field('hero_background_tablet');
    $tablet_bg = wp_get_attachment_image_url($tablet_bg_id, 'full');
  ?>

  <!-- Desktop background -->
  <?php if( $desktop_bg ): ?>
    <figure class="img-overlay img-overlay--horizontal-left-top absolute inset-0 w-full h-full object-cover z-0 pointer-events-none hidden xl:block">
      <div class="absolute inset-0 bg-cover bg-center w-full h-full" style="background-image: url('<?php echo esc_url(wp_get_attachment_image_url($desktop_bg, 'full')); ?>');"></div>
    </figure>
  <?php endif; ?>

  <!-- Tablet/Mobile background -->
  <?php if( $tablet_bg ): ?>
    <figure class="img-overlay img-overlay--horizontal-left-top absolute inset-0 w-full h-full object-cover z-0 pointer-events-none block xl:hidden ">
      <div class="absolute inset-0 bg-cover bg-center w-full h-full" style="background-image: url('<?php echo esc_url($tablet_bg); ?>');"></div>
    </figure>
  <?php endif; ?>

  <!-- Content Container -->
  <div class="theme-container relative z-10 h-full md:h-auto">
    <div class="theme-grid h-full md:h-auto items-end pb-[155px] md:pb-[377px]">
      <div class="col-span-2 md:col-span-4 xl:col-span-6 col-start-1 xl:col-start-2 h-full pt-[152px] md:pt-[197px] xl:pt-[275px]">
        <?php do_action('breadcrumbs'); ?>

        <h1 class="text-blockTextLight pt-[30px] md:pt-[56px] w-[300px] md:w-full xl:w-auto">
          <?php echo get_field('hero_title'); ?>
        </h1>

        <p class="block-text text-blockTextLight pt-[52px] md:pt-[56px] xl:pt-14 w-[340px] md:w-[450px] xl:w-[560px] pb-[35px] md:pb-[56px]">
          <?php echo get_field('hero_description'); ?>
        </p>

        <div class="flex flex-col items-start justify-start xl:flex-row xl:items-center gap-8 md:gap-8 xl:gap-6">
        <?php
          $button = get_field('hero_button');
          if( $button ):
          $link_url = $button['url'];
          $link_title = $button['title'];
          $link_target = $button['target'] ? $button['target'] : '_self';
          ?>
          <a class="btn btn-primary w-[250px]" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php echo esc_html($link_title); ?>
          </a>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>