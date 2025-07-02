<section id="events" class="events relative overflow-hidden bg-background pb-[55px] md:pb-[92px] xl:pb-[192px] xl:pt-[280px] md:pt-[194px] pt-[152px]">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      
      <!-- Breadcrumb -->
      <div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-2 pb-[30px] md:pb-[56px] xl:pb-[58px] w-full">
        <?php do_action('breadcrumbs'); ?>
      </div>

      <!-- Title -->
      <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
        <h1 class="text-dark"><?php echo get_field('events_title', 'option'); ?></h1>
      </div> 
      
      <!-- Description -->
      <div class="col-start-1 col-span-2 md:col-span-4 xl:col-start-8 xl:col-span-4 pt-[48px] md:pt-[56px] xl:pt-0 xl:pb-[192px]">
        <p class="text-dark block-text w-[342px] md:w-[438px] xl:w-full">
          <?php echo get_field('events_description', 'option'); ?>
        </p> 
      </div> 

      <!-- Events Loop -->
      <?php
      $args = [
        'post_type' => 'event',
        'posts_per_page' => 9,
        'orderby' => 'date',
        'order' => 'DESC'
      ];
      $event_query = new WP_Query($args);
      if ($event_query->have_posts()):
        $index = 0;
        while ($event_query->have_posts()):
          $event_query->the_post();
          $image = get_field('events_cpt_image');
          $date = get_field('events_cpt_date');
          $excerpt = get_field('events_cpt_excerpt');

          $col_start = 1 + ($index % 3) * 4;
      ?>
        <div class="col-span-4 xl:col-span-4 xl:col-start-<?php echo $col_start; ?>">
          <article class="flex flex-col gap-4">
            <!-- Image -->
            <?php if ($image): ?>
              <div class="w-full h-[300px] overflow-hidden rounded-[12px]">
                <?php echo wp_get_attachment_image($image, 'full', false, [
                  'class' => 'w-full h-full object-cover rounded-[12px]'
                ]); ?>
              </div>
            <?php endif; ?>

            <!-- Title -->
            <h4 class="text-dark">
              <?php the_title(); ?>
            </h4>

            <!-- Date -->
            <p class="text-dark block-text-bold">
              <img class="inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/calendar.svg" alt="Calendar Icon" />
              <?php echo $date ?: 'TBA'; ?>
            </p>

            <!-- Excerpt -->
            <p class="text-dark text-sm">
              <?php echo esc_html($excerpt); ?>
            </p>

            <!-- CTA -->
            <a href="<?php the_permalink(); ?>" class="text-dark font-semibold text-sm flex items-center gap-2 hover:underline">
              MEHR ERFAHREN <span class="ml-1">→</span>
            </a>
          </article>
        </div>
      <?php
        $index++;
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</section>