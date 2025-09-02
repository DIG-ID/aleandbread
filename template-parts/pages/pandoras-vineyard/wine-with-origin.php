<section id="wine-with-origin" class="wine-with-origin bg-background pb-36 md:pb-32 xl:pb-56">
  <div class="theme-container">
    <div class="theme-grid">

      <!-- Section Titles -->
      <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-5 xl:col-span-4 pt-[57px] xl:mt-56 gap-4 md:pt-[108px] xl:pt-0 w-[285px] md:w-full">
        <h1 class="text-dark"><?php echo get_field('wine_with_origin_title'); ?></h1>
      </div>

      <div class="col-start-1 md:col-start-1 xl:col-start-9 col-span-2 md:col-span-5 xl:col-span-4 pt-6 md:pt-11 md:pb-14 pb-2 xl:pt-56">
        <p class="block-text text-dark"><?php echo get_field('wine_with_origin_subtitle'); ?></p>
      </div>
      </div>

       <?php 
      $image = get_field('wine_with_origin_image');
      $img_url = wp_get_attachment_image_url( $image, 'full', array(
          'class' => 'object-cover md:mx-auto'
        ) );
      ?> 

       <!-- Image + Overlay + Interactive Elements -->
      <div class="col-span-2 md:col-span-6 xl:col-span-12">
        <a href="/distellerie/" class="gin-history-wrapper block">
        <div class="inner-content h-[343px] md:h-[672px] relative" style="background-image:url(<?php echo esc_url( $img_url ); ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">    
          <span class="cta-overlay">
          </span>
          <div class="gin-history-container p-16">
            <div class="flex justify-between items-center w-full">
              <div class="">
                <!-- Description Popup -->
                <div class="gin-popup w-[645px] mb-[85px] translate-y-[100%] opacity-0 pointer-events-none transition-all duration-700">
                  <?php echo get_field('wine_with_origin_image_description'); ?>
                </div>
                <h2 class="gin-title transition-all duration-700">
                  <?php echo get_field('wine_with_origin_image_title'); ?>
                </h2>
              </div>
                  <!-- Toggle Button bottom-right -->
                  <i class="round-button self-end"> <svg width="16" height="25" viewBox="0 0 16 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.70711 0.292892C8.31658 -0.0976315 7.68342 -0.0976315 7.29289 0.292892L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292892ZM8 25L9 25L9 1L8 1L7 1L7 25L8 25Z" fill="#CC9933"/>
                    </svg>
                  </i>
            </div>
          </div>  
        </div>
        </a>
      </div>
  </div>
</div>
</section>