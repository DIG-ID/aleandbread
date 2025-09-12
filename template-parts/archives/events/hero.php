<section id="events" class="events relative overflow-hidden bg-background pb-[55px] md:pb-[92px] xl:pb-[100px] pt-pt-combo-sm md:pt-pt-combo-md xl:pt-pt-combo-xl">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      
      <!-- Breadcrumb -->
      <div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-2 pb-[30px] md:pb-[56px] xl:pb-[58px] w-full">
        <?php do_action('breadcrumbs'); ?>
      </div>

      <!-- Title -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4 max-w-[300px] md:max-w-full">
        <h1 class="text-dark"><?php echo get_field('events_title', 'option'); ?></h1>
      </div> 
      
      <!-- Description -->
      <div class="col-start-1 col-span-2 md:col-span-4 xl:col-start-8 xl:col-span-4 pt-[48px] md:pt-[56px] xl:pt-0">
        <p class="text-dark block-text w-[342px] md:w-[438px] xl:w-full">
          <?php echo get_field('events_description', 'option'); ?>
        </p> 
      </div> 
    </div>

    <?php
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'date'
    );
    $the_query = new WP_Query($args);
    ?>

    <?php if ($the_query->have_posts()) : ?>

     <div class="swiper events-unified-swiper mt-[55px] md:mt-[92px] xl:mt-[195px]">
  <div class="swiper-wrapper">
    <?php
    $the_query = new WP_Query($args);
    while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <div class="swiper-slide w-full md:w-full xl:w-[33.33%] flex-shrink-0 md:pr-4">
        <div class="event-item pb-7 md:pb-0">
          <!-- Thumbnail -->
          <?php if (get_the_post_thumbnail()) :
            the_post_thumbnail('event-thumb', ['class' => 'rounded-xl w-full h-auto object-cover']);
          endif; ?>

          <!-- Title -->
          <h4 class="pt-4"><?php the_title(); ?></h4>

          <!-- Date -->
          <div class="flex items-center gap-2 pt-2">
          <img class="inline-block w-[20px] md:w-[24px] h-auto pt-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/calendar.svg" alt="Calendar" />
          <span class="block-text-bold pt-[5px] md:pt-1"><?php echo get_field('events_cpt_date'); ?></span>
          </div>
          <!-- Short description -->
          <p class="text-dark block-text pt-4"><?php echo get_field('events_cpt_small_description'); ?></p>

          <!-- Link -->
          <a href="<?php the_permalink(); ?>" class="group text-dark font-semibold text-sm flex items-center gap-2 pt-6 md:pt-12">
            <span class="block-text-bold !text-xs md:!text-[18px] !font-semibold md:!font-bold uppercase group-hover:underline"><?php esc_html_e('Mehr Erfahren', 'aleandbread'); ?></span>
            <div class="ml-1 mt-[2px] md:mt-1 w-3 md:w-6">
              <svg 
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 25 16" 
                fill="none"
                class="w-full h-auto"
              >
                <path d="M24.7071 8.70711C25.0976 8.31658 25.0976 7.68342 24.7071 7.29289L18.3431 0.928932C17.9526 0.538408 17.3195 0.538408 16.9289 0.928932C16.5384 1.31946 16.5384 1.95262 16.9289 2.34315L22.5858 8L16.9289 13.6569C16.5384 14.0474 16.5384 14.6805 16.9289 15.0711C17.3195 15.4616 17.9526 15.4616 18.3431 15.0711L24.7071 8.70711ZM0 8V9H24V8V7H0V8Z" fill="#0D0D0D"/>
              </svg>
            </div>
          </a>
        </div>
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  </div>
 <div class="cmd:col-span-6 xl:col-span-12 flex items-center justify-center">
          <div class="events-controls gap-4 mt-[50px] md:mt-[75px] xl:mt-[90px]">
            <span class="swiper-button-prev-2" aria-label="Previous"></span>
            <div class="events-pagination "></div>
            <span class="swiper-button-next-2" aria-label="Next"></span>
          </div> 
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</section>