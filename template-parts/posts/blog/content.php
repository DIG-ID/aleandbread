<section id="blog" class="blog relative overflow-hidden bg-background pt-pt-combo-sm md:pt-pt-combo-md xl:pt-pt-combo-xl">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-6 xl:col-span-12 flex items-center justify-between pb-[30px] md:pb-[40px] xl:pb-[34px]">
        <!-- Previous post -->
        <div class="flex items-center gap-3">
          <?php
            // PREVIOUS
            $prev_link = get_previous_post_link(
              '%link',
              esc_html__('Letzter Beitrag', 'aleandbread')
            );
            if ( $prev_link ) : ?>
              <div class="flex items-center gap-2 text-[#0D0D0D] font-barlow text-[16px] not-italic font-semibold leading-[13px] uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="inline-block" aria-hidden="true" focusable="false">
                  <path d="M0.497044 6.96965C0.10652 7.36017 0.10652 7.99334 0.497044 8.38386L6.86101 14.7478C7.25153 15.1383 7.88469 15.1383 8.27522 14.7478C8.66574 14.3573 8.66574 13.7241 8.27522 13.3336L2.61836 7.67676L8.27522 2.0199C8.66574 1.62938 8.66574 0.996212 8.27522 0.605688C7.8847 0.215164 7.25153 0.215163 6.86101 0.605688L0.497044 6.96965ZM32 7.67676L32 6.67676L1.20415 6.67676L1.20415 7.67676L1.20415 8.67676L32 8.67676L32 7.67676Z" fill="#0D0D0D"/>
                </svg>
                <span class="mb-1"><?php echo $prev_link; ?></span>
              </div>
            <?php endif; ?>
        </div>

        <!-- Next post -->
        <div class="flex items-center gap-3">
          <?php
            // NEXT
            $next_link = get_next_post_link(
              '%link',
              esc_html__('Nächster Beitrag', 'aleandbread')
            );
            if ( $next_link ) : ?>
              <div class="flex items-center gap-2 text-[#0D0D0D] font-barlow text-[16px] not-italic font-semibold leading-[13px] uppercase">
                <span class="mb-1"><?php echo $next_link; ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="inline-block" aria-hidden="true" focusable="false">
                  <path d="M31.503 8.3741C31.8935 7.98357 31.8935 7.35041 31.503 6.95989L25.139 0.595924C24.7485 0.2054 24.1153 0.2054 23.7248 0.595924C23.3343 0.986449 23.3343 1.61961 23.7248 2.01014L29.3816 7.66699L23.7248 13.3238C23.3343 13.7144 23.3343 14.3475 23.7248 14.7381C24.1153 15.1286 24.7485 15.1286 25.139 14.7381L31.503 8.3741ZM0 7.66699L0 8.66699L30.7958 8.66699V7.66699V6.66699L0 6.66699L0 7.66699Z" fill="#0D0D0D"/>
                </svg>
              </div>
            <?php endif; ?>

        </div>
      </div>
    </div>
    <div class="theme-grid pb-[16px] md:pb-[25px]">
      <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-5 xl:col-start-1">
      <?php do_action('breadcrumbs'); ?>
      </div>
      <!-- Tags 
      <div class="col-span-1 md:col-start-1 xl:col-start-6 pt-3"> 
        <p class="text-accent text-left xl:text-right font-barlow text-[20px] not-italic font-medium leading-[30px] uppercase">
          Tags
        </p>
      </div>  -->
        <!-- Categories 
      <div class="col-start-2 md:col-start-5 xl:col-start-8 xl:col-span-2 pb-[16px] md:pb-[22px] xl:pb-[25px] pt-3">
        <p class="text-accent text-right font-barlow text-[20px] not-italic font-medium leading-[30px] uppercase">
          Categories
        </p>
      </div> -->
    </div>
      <!-- Blog post content -->
      <div class="theme-grid gap-x-8">
  
  <!-- LEFT CONTENT -->
  <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-9 order-1 xl:order-none">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('full', ['class' => 'w-full h-auto object-cover rounded-none']); ?>
    <?php endif; ?>

    <h1 class="xl:max-w-[706px] pt-[15px] md:pt-[23px] xl:pt-[27px]"><?php the_title(); ?></h1>

    <p class="text-accent font-barlow text-[20px] not-italic font-normal leading-[34px] pt-[29px] md:pt-[41px] xl:pt-[50px]"><?php echo get_the_date('d. M Y'); ?></p>

    <div class="pt-[25px] md:pt-[35px] xl:max-w-[1142px] pb-[66px] md:pb-[117px] xl:pb-[198px]">
      <div class="blog-content max-w-[1142px]"><?php the_content(); ?></div>
    </div>
  </div>

  <!-- RIGHT SIDEBAR -->
  <aside class="col-start-1 xl:col-start-10 col-span-2 md:col-span-6 xl:col-span-3 self-start order-2 xl:order-none pb-[4px] md:pb-[113px] xl:pb-0">
    <p class="text-[#CC9933] font-barlow text-[20px] not-italic font-medium leading-[30px] uppercase pb-[16px]">Letzte Beiträge</p>
    
    <?php
    $args = [
      'post_type'      => 'blog',
      'posts_per_page' => 3,
      'post__not_in'   => [ get_the_ID() ]
    ];
    $the_query = new WP_Query($args);
    while ($the_query->have_posts()) : $the_query->the_post();
      $description = get_field('blog_cpt_description');
      $image       = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    ?>
      <div class="mb-[54px] md:mb-[60px] xl:mb-[72px]">
        <?php if ($image): ?>
          <a href="<?php the_permalink(); ?>" class="overflow-hidden mb-3">
            <img src="<?= esc_url($image); ?>" alt="<?= esc_attr(get_the_title()); ?>" class="w-full h-auto object-cover rounded-[28px] mb-[33px]">
        </a>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>">
          <h4 class="font-semibold text-xl mb-[22px] xl:mb-5"><?php the_title(); ?>
          </h4>
        </a>
        <?php if ($description): ?>
          <p class="text-dark block-text mb-[65px] xl:mb-5"><?= esc_html($description); ?></p>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>" class="group text-[#0D0D0D] font-barlow text-[16px] not-italic font-semibold leading-[13px] uppercase flex items-center gap-2">
          <span class="uppercase group-hover:underline">
            <?php esc_html_e('Weiterlesen', 'aleandbread'); ?>
          </span>
          <span class="inline-block mt-1 w-8 h-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="16" viewBox="0 0 32 16" fill="none" class="w-full h-full">
              <path d="M31.7061 8.3741C32.0966 7.98357 32.0966 7.35041 31.7061 6.95989L25.3421 0.595924C24.9516 0.2054 24.3184 0.2054 23.9279 0.595924C23.5374 0.986449 23.5374 1.61961 23.9279 2.01014L29.5848 7.66699L23.9279 13.3238C23.5374 13.7144 23.5374 14.3475 23.9279 14.7381C24.3184 15.1286 24.9516 15.1286 25.3421 14.7381L31.7061 8.3741ZM0.203125 7.66699V8.66699H30.999V7.66699V6.66699H0.203125V7.66699Z" fill="#0D0D0D"/>
            </svg>
          </span>
        </a>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </aside>
</div>
</section>