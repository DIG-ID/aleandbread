<section id="craftmanship" class="craftmanship bg-dark pb-36 md:pb-48 xl:pb-56 md:pt-14">
  <div class="theme-container">
    <div class="theme-grid">

      <!-- Top Images Row -->
      <div class="col-span-2 md:col-span-6 xl:col-span-12 xl:mt-56 grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-4">
        <?php 
          $image1 = get_field('craftmanship_image_1');
          if( $image1 ):
        ?>
          <div class="hidden xl:block col-span-3">
            <?php echo wp_get_attachment_image( $image1, 'full', false, array('class' => 'w-full h-auto') ); ?>
          </div>
        <?php endif; ?>

        <?php 
          $image2 = get_field('craftmanship_image_2');
          if( $image2 ):
        ?>
          <div class="col-span-2 md:col-span-6 xl:col-start-4 xl:col-span-6">
            <?php echo wp_get_attachment_image( $image2, 'full', false, array('class' => 'w-full h-auto') ); ?>
          </div>
        <?php endif; ?>

        <?php 
          $image3 = get_field('craftmanship_image_3');
          if( $image3 ):
        ?>
          <div class="hidden xl:flex col-start-10 col-span-3 items-end">
            <?php echo wp_get_attachment_image( $image3, 'full', false, array('class' => 'w-full h-auto') ); ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Text Block Row -->
      <div class="col-span-2 md:col-span-6 xl:col-span-12 xl:pb-56 grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-4 pt-14">
        <?php 
          $image4 = get_field('craftmanship_image_4');
          if( $image4 ):
        ?>
          <div class="col-span-2 md:col-span-4 xl:col-span-3 w-[210px] md:w-full pt-4 ">
            <?php echo wp_get_attachment_image( $image4, 'full', false, array('class' => 'w-full h-auto') ); ?>
          </div>
        <?php endif; ?>

        <div class="col-span-2 md:col-span-5 xl:col-span-4 md:pt-14 xl:pt-0">
          <h1 class="text-blockTextLight xl:w-[560px] md:w-[470px]"><?php echo get_field('craftmanship_title'); ?></h1>
          <h3 class="text-blockTextLight pt-5 md:pt-12 xl:pt-14 xl:w-[560px] pb-9 md:pb-12 "><?php echo get_field('craftmanship_sub_title'); ?>
          </h3>
          <?php 
            $link = get_field('craftmanship_button');
            if( $link ): 
              $link_url = $link['url'];
              $link_title = $link['title'];
              $link_target = $link['target'] ? $link['target'] : '_self';
          ?>
            <a class="btn btn-primary col-span-1 md:col-span-3 xl:col-span-2" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
              <?php echo esc_html( $link_title ); ?>
            </a>
          <?php endif; ?>
        </div>

        <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-5 xl:col-start-8 xl:col-span-4">
          <p class="block-text text-blockTextLight pt-9 md:pt-12 xl:pt-[22px] md:w-[550px] pb-28 md:pb-40 xl:pb-32"><?php echo get_field('craftmanship_description'); ?></p>
        </div>
      </div>

      <!-- Gallery Title Row -->
      <div class="col-span-2 md:col-span-6 xl:col-span-12 grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-4">

        <h2 class="text-blockTextLight w-[280px]"><?php echo get_field('craftmanship_gallery_title'); ?></h2>

            <p class="hidden xl:block block-text text-blockTextLight xl:ml-[140px] w-[800px] mt-5"><?php echo get_field('craftmanship_gallery_title_2'); ?></p>

            <h3 class="block xl:hidden text-blockTextLight w-[465px] -ml-[205px] md:-ml-[120px] pt-14"><?php echo get_field('craftmanship_gallery_title_2'); ?></h3>

      </div>

    </div>

    <!-- Swiper Gallery -->
    <div class="theme-grid">
      <?php 
        $gallery = get_field('craftmanship_gallery');
        if( $gallery ): ?>
        <div class="col-span-2 md:col-span-6 xl:col-span-12 -mb-20 mt-8 md:mt-20 md:-mb-36">
          <div class="swiper craftmanship-swiper">
            <div class="swiper-wrapper">
              <?php foreach( $gallery as $image_id ): ?>
                <div class="swiper-slide !w-[270px] mr-5 last:mr-0">
                  <img 
                    src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>" 
                    alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
                    class="w-full h-auto object-cover"
                    loading="lazy"
                  />
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>