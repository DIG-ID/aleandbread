<section id="weingut_roschard" class="weingut_roschard pb-[94px] md:pb-[145px] xl:pb-[261px] relative overflow-hidden bg-background">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      
      <!-- Text Content Block -->
      <div class="col-span-2 md:col-span-6 xl:col-span-6 xl:col-start-2 order-2 xl:order-none">
        <!-- Breadcrumb -->
        <div class="pt-[24px] md:pt-[54px] xl:pt-[280px]">
          <?php do_action('breadcrumbs'); ?>
        </div>

        <!-- Title -->
        <h1 class="text-dark pt-[36px] md:pt-[52px] w-full">
          <?php echo get_field('weingut_roschard_title'); ?>
        </h1>

        <!-- Subtitle 1 -->
        <h4 class="text-dark !font-medium pt-[36px] md:pt-[52px] xl:pt-[52px] md:w-[560px] xl:w-[555px]">
          <?php echo get_field('weingut_roschard_subtitle'); ?>
        </h4>

        <!-- Description 1 -->
        <p class="block-text text-dark pt-[2px] md:pt-[17px] xl:pt-[30px] w-[273px] md:w-[560px] xl:w-[560px]">
          <?php echo get_field('weingut_roschard_description'); ?>
        </p>

        <!-- Subtitle 2 -->
        <h4 class="text-dark !font-medium pt-[36px] md:pt-[52px] xl:pt-[52px] md:w-full xl:w-[555px]">
          <?php echo get_field('weingut_roschard_subtitle2'); ?>
        </h4>

        <!-- Description 2 -->
        <p class="block-text text-dark pt-[5px] md:pt-[20px] xl:pt-[43px] w-[273px] md:w-[560px] xl:w-[560px]">
          <?php echo get_field('weingut_roschard_description2'); ?>
        </p>

        <!-- Contact -->
        <h4 class="text-dark !font-medium pt-[33px] md:pt-[52px] xl:pt-[52px] md:w-[444px] xl:w-[555px]">
          <?php echo get_field('weingut_roschard_contact'); ?>
        </h4>

        <!-- Address -->
        <p class="block-text text-dark pt-[8px] md:pt-[23px] xl:pt-[43px] md:w-[444px] xl:w-[555px]">
          <?php echo get_field('weingut_roschard_address'); ?>
        </p>
      </div>

      <!--  Swiper  -->
      <div class="col-span-2 md:col-span-6 xl:col-span-5 xl:col-start-8 pt-[72px] md:pt-[128px] xl:pt-[280px] order-1 xl:order-none">
        <?php 
        $gallery = get_field('weingut_roschard_swiper'); 
        if( $gallery ): ?>
          <div class="swiper our-experience-swiper relative">
            <div class="swiper-wrapper">
              <?php foreach( $gallery as $image_id ): 
                $image_url = wp_get_attachment_image_url($image_id, 'full');
                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
              ?>
                <div class="swiper-slide">
                  <img 
                    src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr($image_alt); ?>" 
                    class="w-full h-[488px] md:w-[744px] md:h-[976px] xl:w-[705px] xl:h-[928px] object-cover"
                  />
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Navigation buttons -->
            <div class="swiper-button-prev-2 absolute top-1/2 -translate-y-1/2 left-4 z-10"></div>
            <div class="swiper-button-next-2 absolute top-1/2 -translate-y-1/2 right-4 z-10"></div>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>