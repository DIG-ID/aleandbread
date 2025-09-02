<section id="events" class="events relative overflow-hidden bg-background pb-[55px] md:pb-[92px] xl:pb-[192px] xl:pt-[280px] md:pt-[194px] pt-[152px]">
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
      <div class="col-start-1 col-span-2 md:col-span-4 xl:col-start-8 xl:col-span-4 pt-[48px] md:pt-[56px] xl:pt-0 xl:pb-[192px]">
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

      <!-- Mobile Swiper (grid of 2 cols, 3 items per slide) -->
      <div class="block md:hidden">
        <div class="swiper mobile-event-swiper mt-12">
          <div class="swiper-wrapper px-4">
            <?php
            $counter = 0;
            while ($the_query->have_posts()) : $the_query->the_post();
              if ($counter % 3 === 0) {
                if ($counter > 0) echo '</div></div>';
                echo '<div class="swiper-slide w-full pr-4"><div class="grid grid-cols-2 gap-5">';
              }
            ?>
              <div class="event-item col-span-2 mt-12">
                <div class="event-meta">
                  <?php if (get_the_post_thumbnail()) :
                    the_post_thumbnail('full', ['class' => 'rounded-xl w-full h-auto object-cover']);
                  endif; ?>
                  <h4 class="pt-4"><?php the_title(); ?></h4>
                  <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/calendar.svg" alt="Calendar" />
                  <span class="block-text-bold"><?php echo get_field('events_cpt_date'); ?></span>
                  <p class="text-dark block-text pt-4"><?php echo get_field('events_cpt_small_description'); ?></p>
                  <a href="<?php the_permalink(); ?>" class="group text-dark font-semibold text-sm flex items-center gap-2 pt-6">
                    <span class="group-hover:underline"><?php esc_html_e('Mehr Erfahren', 'aleandbread'); ?></span>
                    <span class="ml-1">→</span>
                  </a>
                </div>
                <?php the_content(); ?>
              </div>
            <?php $counter++; endwhile; ?>
            </div></div>
          </div>
          <div class="swiper-pagination pt-52"></div>
        </div>
      </div>

      <?php wp_reset_postdata(); ?>

      <!-- Tablet Swiper (1.25 cards per view) -->
      <div class="hidden md:block xl:hidden">
        <div class="swiper tablet-event-swiper mt-12">
          <div class="swiper-wrapper px-4">
            <?php
            $the_query = new WP_Query($args);
            while ($the_query->have_posts()) : $the_query->the_post(); ?>
              <div class="swiper-slide w-[80%] flex-shrink-0 pr-4">
                <div class="event-item mt-12">
                  <div class="event-meta">
                    <?php if (get_the_post_thumbnail()) :
                      the_post_thumbnail('full', ['class' => 'rounded-xl w-full h-auto object-cover']);
                    endif; ?>
                    <h4 class="pt-4"><?php the_title(); ?></h4>
                    <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/calendar.svg" alt="Calendar" />
                    <span class="block-text-bold"><?php echo get_field('events_cpt_date'); ?></span>
                    <p class="text-dark block-text pt-4"><?php echo get_field('events_cpt_small_description'); ?></p>
                    <a href="<?php the_permalink(); ?>" class="group text-dark font-semibold text-sm flex items-center gap-2 pt-6">
                      <span class="group-hover:underline"><?php esc_html_e('Mehr Erfahren', 'aleandbread'); ?></span>
                      <span class="ml-1">→</span>
                    </a>
                  </div>
                  <?php the_content(); ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <div class="swiper-pagination pt-52"></div>
        </div>
      </div>

      <?php wp_reset_postdata(); ?>

      <!-- Desktop Swiper (3 items per view) -->
      <div class="hidden xl:block">
        <div class="swiper desktop-event-swiper mt-12">
          <div class="swiper-wrapper px-4">
            <?php
            $the_query = new WP_Query($args);
            while ($the_query->have_posts()) : $the_query->the_post(); ?>
              <div class="swiper-slide w-[33.33%] flex-shrink-0 pr-4">
                <div class="event-item mt-12">
                  <div class="event-meta">
                    <?php if (get_the_post_thumbnail()) :
                      the_post_thumbnail('full', ['class' => 'rounded-xl w-full h-auto object-cover']);
                    endif; ?>
                    <h4 class="xl:pt-8 xl:pb-7"><?php the_title(); ?></h4>
                    <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/calendar.svg" alt="Calendar" />
                    <span class="block-text-bold"><?php echo get_field('events_cpt_date'); ?></span>
                    <p class="text-dark block-text xl:pt-7 xl:h-[90px] xl:w-[415px]"><?php echo get_field('events_cpt_small_description'); ?></p>
                    <a href="<?php the_permalink(); ?>" class="group text-dark font-semibold text-sm flex items-center gap-2 xl:pt-10">
                      <span class="group-hover:underline"><?php esc_html_e('Mehr Erfahren', 'aleandbread'); ?></span>
                      <span class="ml-1">→</span>
                    </a>
                  </div>
                  <?php the_content(); ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
        </div>
        <div class="col-span-12 flex items-center justify-center">
          <div class="events-controls gap-4 mt-[110px]">
            <span class="swiper-button-prev-2" aria-label="Next"></span>
            <div class="events-pagination "></div>
            <span class="swiper-button-next-2" aria-label="Next"></span>
          </div> 
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</section>