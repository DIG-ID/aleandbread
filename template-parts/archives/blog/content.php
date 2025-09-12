<section id="blog" class="blog relative overflow-hidden bg-background pb-[110px] md:pb-[134px] xl:pb-[243px] pt-pt-combo-sm md:pt-pt-combo-md xl:pt-pt-combo-xl">
  <div class="theme-container relative z-10">
    <div class="theme-grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12">
      
      <!-- Header Section -->
        <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-2 xl:col-span-3 pb-[37px] md:pb-[58px]">
          <?php do_action('breadcrumbs', 'option'); ?>
        </div>
        <div class="col-start-1 col-span-2 md:col-span-3 xl:col-start-2 xl:col-span-3 pb-[21px] md:pb-[58px] xl:pb-">
          <h1 class="text-dark">
            <?php echo get_field('blog_title', 'option'); ?>
          </h1>
        </div>
        <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-8 xl:col-span-4 pb-[46px] md:pb-[100px]">
          <p class="block-text">
            <?php echo get_field('blog_description', 'option'); ?>
          </p>
        </div>
      </div>

      <!-- Blog Grid -->
      <div class="theme-grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-y-[60px] xl:gap-y-[120px]">
        <?php
        $args = array(
          'post_type' => 'blog',
          'posts_per_page' => 0
        );
        $the_query = new WP_Query($args);
        while ($the_query->have_posts()) : $the_query->the_post();
          $description = get_field('blog_cpt_description');
          $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        ?>
          <div class="col-span-2 md:col-span-6 xl:col-span-4">
            <div class="flex flex-col">
              <?php if ($image): ?>
                <a href="<?php the_permalink(); ?>" class="overflow-hidden pb-[33px]">
                  <img src="<?= esc_url($image); ?>" alt="<?= esc_attr(get_the_title()); ?>" class="w-full h-auto object-cover rounded-[20px]" loading="lazy">
                </a>
              <?php endif; ?>
              <a href="<?php the_permalink(); ?>">
                <h4 class="font-semibold text-xl pb-[22px]">
                  <?php the_title(); ?>
                </h4>
              </a>
              <?php if ($description): ?>
                <p class="text-dark block-text pb-[65px]">
                  <?= esc_html($description); ?>
                </p>
              <?php endif; ?>

              <a href="<?php the_permalink(); ?>" class="group text-dark font-semibold text-sm flex items-center gap-2">
                <span class="uppercase group-hover:underline"><?php esc_html_e('Weiterlesen', 'aleandbread'); ?></span>
                <span class="ml-1 mt-1 size-6">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="w-full h-full">
                  <path d="M31.7061 8.3741C32.0966 7.98357 32.0966 7.35041 31.7061 6.95989L25.3421 0.595924C24.9516 0.2054 24.3184 0.2054 23.9279 0.595924C23.5374 0.986449 23.5374 1.61961 23.9279 2.01014L29.5848 7.66699L23.9279 13.3238C23.5374 13.7144 23.5374 14.3475 23.9279 14.7381C24.3184 15.1286 24.9516 15.1286 25.3421 14.7381L31.7061 8.3741ZM0.203125 7.66699V8.66699H30.999V7.66699V6.66699H0.203125V7.66699Z" fill="#0D0D0D"/>
                  </svg>
                </span>
              </a>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</section>