<section class="wine-highlights highlight theme-container pt-20 xl:pt-28 pb-40">
    <div class="theme-grid">
        <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4 mb-14 md:mb-16 xl:mb-24">
            <h2 class="h1 text-dark uppercase"><?php esc_html_e( 'Vineyard Highlights','aleandbread' ); ?></h2>
        </div>

        <div class="col-span-2 md:col-span-6 xl:col-span-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php
            $wine_highlights = new WP_Query([
            'post_type'      => 'product',
            'posts_per_page' => 2,
            'tax_query'      => [
                'relation' => 'AND',
                [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => ['wines'],          // category filter
                ],
                [
                'taxonomy' => 'product_tag',
                'field'    => 'slug',
                'terms'    => ['Highlight'],      // tag filter
                ],
                [
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => ['outofstock', 'exclude-from-catalog'],
                'operator' => 'NOT IN',
                ],
            ],
            ]);

            if ( $wine_highlights->have_posts() ) :
                while ( $wine_highlights->have_posts() ) : $wine_highlights->the_post();
                $permalink = get_permalink();
                $title     = get_the_title();
                ?>
                <div class="card-highlight">
                    <a href="<?php echo esc_url( $permalink ); ?>">
                    <div class="card-highlight--image bg-[#C4C4C4]">
                        <?php echo get_the_post_thumbnail( null, 'full', ['class' => 'w-full h-full object-cover'] ); ?>
                    </div>
                    <div class="card-highlight--content">
                        <span class="overlay"></span>
                        <span class="block-text"><?php the_excerpt(); ?></span>
                        <div class="card-highlight--footer flex justify-between items-center">
                        <h3 class="card-highlight--title"><?php echo esc_html( $title ); ?></h3>
                        <div class="card-highlight--arrow"></div>
                        </div>
                    </div>
                    </a>
                </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-gray-600">'.esc_html__( 'No wines to highlight yet.', 'aleandbread' ).'</p>';
            endif;
            ?>
            </div>
        </div>
    </div>
</section>
