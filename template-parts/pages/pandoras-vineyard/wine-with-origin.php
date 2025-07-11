<section id="wine-with-origin" class="wine-with-origin bg-background pb-36 md:pb-32 xl:pb-56">
  <div class="theme-container">
    <div class="theme-grid">

      <!-- Section Titles -->
      <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-5 xl:col-span-4 pt-12 xl:mt-56 gap-4 md:pt-28 xl:pt-0 w-[285px] md:w-full">
        <h1 class="text-dark"><?php echo get_field('wine_with_origin_title'); ?></h1>
      </div>

      <div class="col-start-1 md:col-start-1 xl:col-start-9 col-span-2 md:col-span-5 xl:col-span-4 pt-6 md:pt-11 md:pb-14 pb-2 xl:pt-56">
        <p class="block-text text-dark"><?php echo get_field('wine_with_origin_subtitle'); ?></p>
      </div>
      </div>

      <!-- Image + Overlay + Interactive Elements -->
      <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-6 xl:col-span-12 mt-12 order-1 xl:order-2">

      <div class="relative w-full h-[343px] md:w-[680px] md:h-[672px] xl:w-full xl:h-full md:mx-auto group -mb-12 " id="gin-history-container">

    <!-- Image -->
    <?php 
      $image = get_field('wine_with_origin_image');
      if( $image ):
        echo wp_get_attachment_image( $image, 'full', false, array(
          'class' => ' w-full h-[343px] md:w-[680px] md:h-[672px] xl:w-full xl:h-full object-cover md:mx-auto'
        ) );
      endif;
    ?> 

    <!-- Bottom Gradient Overlay (initially hidden) -->
    <div id="gin-overlay" class="absolute inset-0 bg-none transition-all duration-500 z-10 pointer-events-none"></div>

    <!-- Title bottom-left -->
    <div>
      <h2 id="gin-title" class="absolute bottom-[21px] left-8 md:bottom-10 md:left-16 text-background z-20 transition-colors duration-300 w-[210px] md:w-[345px]">
        <?php echo get_field('wine_with_origin_image_title'); ?>
      </h2>
    </div>

    <!-- Toggle Button bottom-right -->
    <button 
      id="gin-toggle-btn" 
      class="btn btn-round-button absolute bottom-14 right-20 md:bottom-24 md:right-32 z-20"
      type="button">
    </button>

    <!-- Description Popup -->
    <div id="gin-popup" class="w-[660px] absolute inset-0 flex text-background pl-[60px] md:pl-[66px] -left-7 md:-left-0 pt-[175px] md:pt-[400px] xl:pt-[375px] opacity-0 pointer-events-none transition-opacity duration-500 z-30">
      <?php echo get_field('wine_with_origin_image_description'); ?>
    </div>

  </div>
</div>
</section>