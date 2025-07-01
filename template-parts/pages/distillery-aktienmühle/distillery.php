<section id="distillery" class="distillery pb-[94px] md:pb-[222px] xl:pb-[261px] relative overflow-hidden bg-background">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      
      <!-- Breadcrumb -->
      <div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-5 pt-[152px] md:pt-[197px] xl:pt-[280px]">
        <?php do_action('breadcrumbs'); ?>
      </div>

      <!-- Title -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-5">
        <h1 class="text-dark pt-[33px] md:pt-[54px] xl:pt-[52px] w-[324px] md:w-full">
          <?php echo get_field('distillery_aktienmuhle_title'); ?>
        </h1>
      </div>

      <!-- Subtitle 1 -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
        <h4 class="text-dark !font-medium pt-[33px] md:pt-[52px] xl:pt-[52px] md:w-[560px] xl:w-[555px]">
          <?php echo get_field('distillery_aktienmuhle_subtitle'); ?>
        </h4>
      </div>

      <!-- Description 1 -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
        <p class="block-text text-dark pt-[12px] md:pt-[17px] xl:pt-[17px] w-[273px] md:w-[560px] xl:w-[560px]">
          <?php echo get_field('distillery_aktienmuhle_description'); ?>
        </p>
      </div>

      <!-- Subtitle 2 -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
        <h4 class="text-dark !font-medium pt-[33px] md:pt-[52px] xl:pt-[52px] md:w-[444px] xl:w-[555px]">
          <?php echo get_field('distillery_aktienmuhle_subtitle2'); ?>
        </h4>
      </div>

      <!-- Description 2 -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
        <p class="block-text text-dark pt-[15px] md:pt-[20px] xl:pt-[20px] w-[273px] md:w-[560px] xl:w-[560px]">
          <?php echo get_field('distillery_aktienmuhle_description2'); ?>
        </p>
      </div>

      <!-- Contact -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
        <h4 class="text-dark !font-medium pt-[33px] md:pt-[52px] xl:pt-[52px] md:w-[444px] xl:w-[555px]">
          <?php echo get_field('distillery_aktienmuhle_contact'); ?>
        </h4>
      </div>

      <!-- Address -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
        <p class="block-text text-dark pt-[8px] md:pt-[23px] xl:pt-[23px] md:w-[444px] xl:w-[555px]">
          <?php echo get_field('distillery_aktienmuhle_address'); ?>
        </p>
      </div>

      <!-- ✅ Swiper (now correctly inside .theme-grid) -->
      <div class="col-span-2 md:col-span-6 xl:col-span-4 xl:col-start-8 order-3">
        <?php 
$gallery = get_field('distillery_aktienmuhle'); 
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
                        class="w-[375px] h-[488px] md:w-[744px] md:h-[976px] xl:w-[705px] xl:h-[928px] object-cover"
                    />
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Navigation buttons -->
        <div class="swiper-button-prev !left-4 !text-black !bg-white !rounded-full !border !w-10 !h-10 flex items-center justify-center"></div>
        <div class="swiper-button-next !right-4 !text-black !bg-white !rounded-full !border !w-10 !h-10 flex items-center justify-center"></div>
    </div>
<?php endif; ?>
      </div>

    </div>
  </div>
</section>