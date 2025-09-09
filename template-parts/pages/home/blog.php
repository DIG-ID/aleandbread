<section id="blog" class="blog bg-dark text-align-none xl:pt-36">
  <div class="theme-container">
    <div class="theme-grid">
        <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-6 xl:col-span-12 ">
            <p class="text-accent over-title capitalize pb-[73px] md:pb-[85px] xl:pb-[32px]">
                <?php echo get_field('blog_breadcrumbs'); ?>
            </p>
        </div>
        <div class="col-span-2 md:col-span-6 xl:col-span-12"></div>
            <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-5 xl:col-span-5">
                <h1 class="text-blockTextLight xl:max-w-[724px]">
                    <?php echo get_field('blog_title'); ?>
                </h1>
            </div>
            <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-5 xl:col-span-4 xl:col-start-9 flex items-center">
                <p class="block-text text-blockTextLight xl:max-w-[561px]">
                    <?php echo get_field('blog_description'); ?>
                </p>
            </div>
        </div>
        <div class="col-span-2 md:col-span-6 xl:col-span-4 pt-[35.5px] md:pt-[58px] xl:pt-[94px] pb-[25px] md:pb-[45px] xl:pb-[70px] ">
              <div class="theme-grid gap-6">
            <?php
            $args = array(
            'post_type'      => 'blog',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC'
            );
            $latest_posts = new WP_Query($args);    

            if ($latest_posts->have_posts()) :
            while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                
                <article class="col-span-2 md:col-span-3 xl:col-span-4 bg-white shadow rounded pb-[30px] group hover:bg-accent transition-all duration-500 ease-in-out flex flex-col">
                    <!-- Featured Image -->
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="block mb-4">
                            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']); ?>
                        </a>
                    <?php endif; ?>

                    <!-- Card content wrapper -->
                    <div class="flex flex-col flex-grow px-[40px]">
                        <!-- Title -->
                        <h4 class="text-blockText text-xl font-semibold mb-5 pr-[30px]">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <!-- Date -->
                        <div class="block-text-bold text-accent mb-6 group-hover:text-blockTextLight">
                            <?php echo get_the_date(); ?>
                        </div>

                        <!-- Description -->
                        <p class="text-blockText block-text pr-[30px] mb-6">
                            <?php if (get_field('blog_cpt_description')) : ?>
                                <?php echo esc_html(get_field('blog_cpt_description')); ?>
                            <?php endif; ?>
                        </p>

                        <!-- Read More bottom -->
                        <div class="mt-auto">
                            <a href="<?php the_permalink(); ?>" class="group block-text text-dark font-semibold text-sm flex items-center">
                                <span class="uppercase hover:underline"><?php esc_html_e('Weiterlesen', 'aleandbread'); ?></span>
                                <span class="ml-1">→</span>
                            </a>
                        </div>
                    </div>
                </article>

            <?php endwhile;
            wp_reset_postdata();
            else : ?>
            <p>No posts found.</p>
            <?php endif; ?>
            </div>
        </div>
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-span-2 xl:col-start-6 flex justify-center">
            <?php 
            $link = get_field('blog_button');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="btn btn-primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                <?php echo esc_html($link_title); ?>
            </a>
            <?php endif; ?>
            </div>
        </div>
    </div>
  </div>
</section>