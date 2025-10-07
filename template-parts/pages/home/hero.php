<section id="hero" class="section-hero relative h-[100svh] md:h-screen w-full overflow-hidden">
  <?php 
    $desktop_gallery = get_field('section_hero_gallery');
    $mobile_image_id = get_field('section_hero_background_tablet');
    $mobile_image_url = wp_get_attachment_image_url($mobile_image_id, 'full');
  ?>

  <!-- Desktop Swiper -->
  <?php if ($desktop_gallery): ?>
    <div class="hidden xl:block absolute inset-0 z-0">
      <div class="swiper overflow-hidden">
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
    <div class="xl:hidden absolute inset-0 z-0 pointer-events-none">
        <img 
          src="<?php echo esc_url($mobile_image_url); ?>" 
          alt="<?php echo esc_attr(get_post_meta($mobile_image_id, '_wp_attachment_image_alt', true)); ?>"
          class="w-full h-full object-cover"
          loading="lazy"
        />
    </div>
  <?php endif; ?>

  <!-- Content always visible -->
  <div class="theme-container relative z-10 h-full md:h-screen">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-4 xl:col-span-6 xl:col-start-2 pt-40 md:pt-60 xl:pt-[320px] md:min-h-full xl:min-h-0">
        <h1 class="text-blockTextLight w-[240px] md:w-full">
          <?php echo get_field('section_hero_title'); ?>
        </h1>
        <p class="block-text text-blockTextLight pt-[52px] md:pt-16 xl:pt-14 w-[290px] md:w-[375px] xl:w-[415px] pb-[38px]">
          <?php echo get_field('section_hero_description'); ?>
        </p>
        <div class="flex flex-col items-start justify-start xl:flex-row xl:items-center gap-8 md:gap-8 xl:gap-6 md:pt-10 col-start-1  pb-[184px] md:pb-[387px] xl:pb-0">                        
          <?php
            $button = get_field('section_hero_products_button');
            if( $button ):
            $link_url = $button['url'];
            $link_title = $button['title'];
            $link_target = $button['target'] ? $button['target'] : '_self';
            ?>
            <a class="btn btn-primary w-1/2" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
              <?php echo esc_html($link_title); ?>
            </a>
            <?php endif; ?>
          <?php
            $button = get_field('section_hero_booking_button');
            if( $button ):
            $link_url = $button['url'];
            $link_title = $button['title'];
            $link_target = $button['target'] ? $button['target'] : '_self';
            ?>
            <a class="btn btn-tertiary w-1/2" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
              <?php echo esc_html($link_title); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
      <a class="btn btn-scroll !hidden xl:block absolute bottom-16 right-8"></a>
    </div>
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.btn-scroll')?.addEventListener('click', function (e) {
      e.preventDefault();
      // scroll one viewport down with Lenis
      lenis.scrollTo(window.scrollY + window.innerHeight, {
        duration: 2, 
        easing: (t) => t, 
      })
    });
  });
</script>