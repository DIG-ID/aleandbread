<section id="outro" class="outro bg-dark xl:bg-transparent">
  <div class="theme-container !max-w-full">
    <?php
    $image_id = get_field('outro_background');
    $image_url = wp_get_attachment_image_url($image_id, 'full');
    ?>
    <div class="theme-grid relative">

      <!-- Background Image -->
      <?php if ($image_url): ?>
        <figure class="img-overlay img-overlay--horizontal-right xl:absolute xl:left-0 xl:top-0 inset-0 w-full h-full xl:object-cover xl:z-[-1] pointer-events-none">
          <img 
            src="<?php echo esc_url($image_url); ?>" 
            alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
            class="w-full h-full object-cover"
            loading="lazy"
          />
        </figure>
      <?php endif; ?>

      <!-- Logo -->
      <div class="col-span-full flex justify-center">
        <?php 
          $image = get_field('theme_logo', 'option');
          $size = 'full';
          $classes = 'w-[184px] md:w-[270px] mt-16 md:mt-[154px] xl:mt-[90px]';
          if( $image ) {
              echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
          }
        ?>
      </div>

      <!-- Text -->
      <div class="col-span-2 md:col-span-5 xl:col-span-8 xl:col-start-3 pt-1 md:pt-3 xl:pt-[72px] flex flex-col items-center text-center">
        <h1 class="text-accent pt-5"><?php echo get_field('outro_title'); ?></h1>
        <h3 class="block-text text-blockTextLight pt-10 md:pt-[72px] pb-28 w-[450px]"><?php echo get_field('outro_description'); ?></p>
      </div>

    </div>
  </div>
</section>