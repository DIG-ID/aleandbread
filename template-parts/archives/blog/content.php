<section id="blog" class="blog relative overflow-hidden bg-background pb-[110px] md:pb-[134px] xl:pb-[243px] pt-[152px] md:pt-[192px] xl:pt-[264px]">
  <div class="theme-container relative z-10">
    <div class="theme-grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12">
      
      <!-- Header Section -->
        <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-2 xl:col-span-3 pb-[37px] md:pb-[58px]">
          <?php do_action('breadcrumbs', 'option'); ?>
        </div>
        <div class="col-start-1 col-span-2 md:col-span-3 xl:col-start-2 xl:col-span-3 pb-[21px] md:pb-[58px] xl:pb-0">
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
                <div class="rounded-[28px] overflow-hidden pb-[33px]">
                  <img src="<?= esc_url($image); ?>" alt="<?= esc_attr(get_the_title()); ?>" class="w-full h-auto object-cover" loading="lazy">
                </div>
              <?php endif; ?>

              <h4 class="font-semibold text-xl pb-[22px]">
                <?php the_title(); ?>
              </h4>

              <?php if ($description): ?>
                <p class="text-dark block-text pb-[65px]">
                  <?= esc_html($description); ?>
                </p>
              <?php endif; ?>

              <a href="<?php the_permalink(); ?>" class="group text-dark font-semibold text-sm flex items-center gap-2">
                <span class="group-hover:underline"><?php esc_html_e('Read More', 'aleandbread'); ?></span>
                <span class="ml-1">→</span>
              </a>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>

    </div>
  </div>
</section>