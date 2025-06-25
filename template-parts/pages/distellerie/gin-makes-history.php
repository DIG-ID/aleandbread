<section id="gin-makes-history" class="gin-makes-history bg-background pb-36 md:pb-48 xl:pb-56">
  <div class="theme-container">
    <div class="theme-grid">

      <!-- Section Titles -->
      <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-12 order-1 xl:mt-56 grid grid-cols-12 gap-4">
        <h1 class="text-dark col-span-5">
          <?php echo get_field('gin_makes_history_title'); ?>
        </h1>
        <p class="block-text text-dark col-start-9 col-span-4">
          <?php echo get_field('gin_makes_history_subtitle'); ?>
        </p>
      </div>

      <!-- Image + Overlay + Interactive Elements -->
      <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-12 mt-12 order-1 xl:order-2">
        <div class="relative w-full h-full group" id="gin-history-container">

          <!-- Image -->
          <?php 
            $image = get_field('gin_makes_history_image');
            if( $image ):
              echo wp_get_attachment_image( $image, 'full', false, array('class' => 'w-full h-auto') );
            endif;
          ?> 

          <!-- Bottom Gradient Overlay (initially hidden) -->
          <div id="gin-overlay" class="absolute inset-0 bg-none transition-all duration-500 z-10 pointer-events-none"></div>

          <!-- Title bottom-left -->
          <div>
            <h2 id="gin-title" class="absolute bottom-16 left-16 text-background z-20 transition-colors duration-300">
              <?php echo get_field('gin_makes_history_image_title'); ?>
            </h2>
          </div>

          <!-- Toggle Button bottom-right -->
          <button 
            id="gin-toggle-btn" 
            class="btn btn-round-button absolute bottom-24 right-32 z-20"
            type="button">
          </button>

          <!-- Description Popup -->
          <div id="gin-popup" class="w-[660px] absolute inset-0 flex text-background pl-[60px] pt-[450px] opacity-0 pointer-events-none transition-opacity duration-500 z-30">
            <?php echo get_field('gin_makes_history_image_description'); ?>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>