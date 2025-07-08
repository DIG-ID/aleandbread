<section id="hero" class="section-hero relative overflow-hidden">
  <?php 
    $desktop_gallery = get_field('section_hero_gallery');
    $mobile_image_id = get_field('section_hero_background_tablet');
    $mobile_image_url = wp_get_attachment_image_url($mobile_image_id, 'full');
  ?>

  <!-- Desktop Swiper -->
  <?php if ($desktop_gallery): ?>
    <div class="hidden xl:block absolute inset-0 z-0">
      <div class="swiper h-screen w-screen overflow-hidden">
        <div class="swiper-wrapper">
          <?php foreach($desktop_gallery as $image_id): 
            $image_url = wp_get_attachment_image_url($image_id, 'full'); ?>
            <div class="swiper-slide bg-cover bg-center" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- Tablet/Mobile Static Background Image -->
  <?php if ($mobile_image_url): ?>
    <div class="xl:hidden absolute inset-0 w-full h-screen md:h-full z-0 pointer-events-none">
      <img 
        src="<?php echo esc_url($mobile_image_url); ?>" 
        alt="<?php echo esc_attr(get_post_meta($mobile_image_id, '_wp_attachment_image_alt', true)); ?>"
        class="w-full h-full object-cover"
        loading="lazy"
      />
    </div>
  <?php endif; ?>

  <!-- Content always visible -->
  <div class="theme-container !max-w-full relative z-10">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-4 xl:col-span-6 xl:col-start-2 pt-40 md:pt-60 xl:pt-[320px] md:min-h-full xl:min-h-0">
        <h1 class="text-blockTextLight w-[240px] md:w-full">
          <?php echo get_field('section_hero_title'); ?>
        </h1>
        <p class="block-text text-blockTextLight pt-[52px] md:pt-16 xl:pt-14 w-[290px] md:w-[375px] xl:w-[415px] pb-[38px]">
          <?php echo get_field('section_hero_description'); ?>
        </p>
        <div class="flex flex-col items-start justify-start xl:flex-row xl:items-center gap-8 md:gap-8 xl:gap-6 md:pt-10 col-start-1  pb-[184px] md:pb-[387px] xl:pb-56">                        
          <a class="btn btn-primary w-1/2"><?php esc_html_e( 'unsere Produkte', 'aleandbread' ); ?></a>
          <a class="btn btn-tertiary w-1/2"><?php esc_html_e( 'Buche dein Erlebnisse', 'aleandbread' ); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>