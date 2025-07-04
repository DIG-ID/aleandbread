<section id="outro" class="outro relative overflow-hidden">
    <?php
// Get image ID from ACF
$image_id = get_field('gin_lab_cpt_outro_image');

// Get image URL from ID
$image_url = wp_get_attachment_image_url($image_id, 'full');
?>
        <?php if ($image_url): ?>
            <figure class="absolute xl:left-0 xl:top-0 inset-0 w-[1920px] h-[596px] xl:object-cover xl:z-[-1] pointer-events-none">
                <img 
                    src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
                    class="w-full h-full object-cover"
                    loading="lazy"
                />
            </figure>
            <?php endif; ?>
<div class="theme-container relative z-10">
    <div class="theme-grid relative z-10">
      <!-- Title -->
      <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-3">
        <h1 class="text-background pt-[189px] pb-[156px] w-[355px]"><?php echo get_field('gin_lab_cpt_outro_title'); ?></h1>
      </div>

      <!-- Description 1 -->
      <div class="col-span-2 md:col-span-6 xl:col-start-6 xl:col-span-3">
        <p class="text-background block-text pt-[189px] pb-[179px] w-[411px]">
          <?php echo get_field('gin_lab_cpt_outro_description_1'); ?>
        </p>
      </div>

      <!-- Description 2 -->
      <div class="col-span-2 md:col-span-6 xl:col-start-9 xl:col-span-3">
        <p class="text-background block-text pt-[189px] pb-[255px] w-[415px]">
          <?php echo get_field('gin_lab_cpt_outro_description_2'); ?>
        </p>
      </div>

    </div> 
  </div> 
</section>