<section class="distellerie-highlights highlight theme-container pt-20 xl:pt-28 pb-20 xl:pb-36">
  <div class="theme-grid">
    <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-6 mb-14 md:mb-16 xl:mb-24">
      <h2 class="h1 text-dark uppercase"><?php esc_html_e( 'Distillerie Highlights','aleandbread' ); ?></h2>
    </div>

    <div class="col-span-2 md:col-span-6 xl:col-span-12">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php
        
        $args = array(
          'post_type'      => 'product',
          'posts_per_page' => 2, 
          'tax_query'      => array(
            array(
              'taxonomy' => 'product_cat',
              'field'    => 'slug',
              'terms'    => array( 'spirituosen' ),
            ),
          ),
          'meta_query'     => array(
            array(
              'key'     => 'enable_highlight',
              'value'   => '1',
              'compare' => '=',
            ),
          ),
        );

        $highlight_q = new WP_Query( $args );

        if ( $highlight_q->have_posts() ) :
          while ( $highlight_q->have_posts() ) :
            $highlight_q->the_post();

            $product = function_exists( 'wc_get_product' ) ? wc_get_product( get_the_ID() ) : null;

            $image_id   = get_field( 'highlight_content_image' );
            $image_html = $image_id ? wp_get_attachment_image(
                $image_id,
                'highlights-size',
                false,
                array( 'class' => 'w-full h-full object-cover', 'loading' => 'lazy' )
            ) : '';

            $title       = get_the_title();
            $slogan      = get_field( 'slogan' ); 
            $description = $product ? $product->get_short_description() : get_the_excerpt();
            $permalink   = get_permalink();
            ?>
            <div class="card-highlight">
              <a href="<?php echo esc_url( $permalink ); ?>">
                <div class="card-highlight--image bg-[#C4C4C4]">
                  <?php
                  // Fallback gray block is already there via bg color
                  if ( $image_html ) {
                    echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                  }
                  ?>
                </div>

                <div class="card-highlight--content">
                  <span class="overlay"></span>

                  <?php if ( ! empty( $description ) ) : ?>
                    <span class="block-text"><?php echo wp_kses_post( $description ); ?></span>
                  <?php endif; ?>

                  <div class="card-highlight--footer flex justify-between items-center">
                    <div>
                      <?php if ( $title ) : ?>
                        <h2 class="card-highlight--title uppercase"><?php echo esc_html( $title ); ?></h2>
                      <?php endif; ?>

                      <?php if ( ! empty( $slogan ) ) : ?>
                        <h3 class="card-highlight--slogan"><?php echo esc_html( $slogan ); ?></h3>
                      <?php endif; ?>
                    </div>
                    <div class="card-highlight--arrow"></div>
                  </div>
                </div>
              </a>
            </div>
          <?php
          endwhile;
          wp_reset_postdata();
        else :
          ?>
          <p class="text-gray-600"><?php echo esc_html__( 'No highlights yet.', 'aleandbread' ); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
