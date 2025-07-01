<section id="hero" class="section-hero pb-0 relative overflow-hidden h-[670px] md:h-auto">
  <!-- Background Overlay -->
  <figure class="img-overlay img-overlay--horizontal-left-top absolute inset-0 w-full h-full object-cover z-0 pointer-events-none">
    <?php 
      $background = get_field('hero_background');
      if( $background ): 
        $image_url = wp_get_attachment_image_url($background, 'full'); 
    ?>
      <div class="absolute inset-0 bg-cover bg-center w-full h-full" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
    <?php endif; ?>
  </figure>

  <!-- Content Container -->
  <div class="theme-container relative z-10 h-full md:h-auto">
    <div class="theme-grid h-full md:h-auto items-end md:pb-[377px]">
        <div class="col-span-2 md:col-span-4 xl:col-span-6 col-start-1 xl:col-start-2 h-full pt-[155px] md:pt-48 xl:pt-[275px]">
    <?php do_action( 'breadcrumbs' ); ?>

    <h1 class="text-blockTextLight pt-8 md:pt-[56px] w-[300px] md:w-full xl:w-auto">
        <?php echo get_field('hero_title'); ?>
    </h1>

    <p class="block-text text-blockTextLight pt-[52px] md:pt-16 xl:pt-14 w-[340px] md:w-[450px] xl:w-[560px] pb-9 md:pb-[56px]">
        <?php echo get_field('hero_description'); ?>
    </p>

    <div class="flex flex-col items-start justify-start xl:flex-row xl:items-center gap-8 md:gap-8 xl:gap-6">
        <a class="btn btn-primary w-[250px]">
            <?php esc_html_e( 'HEARTS & TAILS SHOP', 'aleandbread' ); ?>
        </a>
    </div>
</div>
  </div>
</section>