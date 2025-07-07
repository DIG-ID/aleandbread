<section id="mission-and-philosophy" class="mission-and-philosophy bg-dark pb-[108px] md:pb-[148px] xl:pb-[210px]">

  <?php 
    $image = get_field('mission_und_philosophie_image_1');
    if( $image ): 
      $image_url = wp_get_attachment_image_url($image, 'full');
      $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
  ?>
    <!-- Full-width image for mobile/tablet -->
    <div class="block xl:hidden">
      <img 
        src="<?php echo esc_url($image_url); ?>" 
        alt="<?php echo esc_attr($image_alt); ?>" 
        class="w-full h-auto object-cover"
      />
    </div>
  <?php endif; ?>

  <div class="theme-container">
    <div class="theme-grid">

      <!-- Text Content -->
      <div class="col-start-1 md:col-start-1 xl:col-start-8 col-span-2 md:col-span-5 xl:col-span-4 order-2">
        <p class="over-title text-accent mt-8 md:mt-20 xl:mt-[270px]"><?php echo get_field('mission_und_philosophie_over_title'); ?></p>
        
        <h1 class="text-blockTextLight pt-12 md:pt-20 xl:pt-16 pb-11 md:pb[60px] xl:pb-14 w-[343px] md:w-[560px] xl:w-full">
          <?php echo get_field('mission_und_philosophie_title'); ?>
        </h1>
        
        <h4 class="text-blockTextLight pb-12 md:pb-9 self-stretch font-medium capitalize w-[343px] md:w-[560px] xl:w-full">
          <?php echo get_field('mission_und_philosophie_sub_title'); ?>
        </h4>
        
        <p class="text-blockTextLight block-text pb-[34px] md:pb-[56px] w-[343px] md:w-[560px] xl:w-full">
          <?php echo get_field('mission_und_philosophie_description'); ?>
        </p>

        <?php 
          $link = get_field('mission_und_philosophie_button');
          if( $link ): 
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
          <a class="btn btn-primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
            <?php echo esc_html($link_title); ?>
          </a>
        <?php endif; ?>

        <?php 
          $logo = get_field('theme_logo', 'option');
          if( $logo ) {
            echo wp_get_attachment_image( $logo, 'full', false, array(
              'class' => 'w-[184px] md:w-[415px] mt-16 md:mt-[141px] xl:mt-[148px]'
            ));
          }
        ?>
      </div>

      <!-- Desktop-only Image -->
      <div class="hidden xl:block col-start-1 col-span-6 order-1 xl:mt-56">
        <?php 
          echo wp_get_attachment_image( $image, 'full', false, array('class' => 'w-[850px]') );
        ?>
      </div> 

    </div>
  </div>
</section>