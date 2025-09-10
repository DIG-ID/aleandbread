<section class="distellerie-highlights highlight theme-container pt-20 xl:pt-28 pb-20 xl:pb-36">
    <div class="theme-grid">
        <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-6 mb-14 md:mb-16 xl:mb-24">
            <h2 class="h1 text-dark uppercase"><?php esc_html_e( 'Distillerie Highlights','aleandbread' ); ?></h2>
        </div>

        <div class="col-span-2 md:col-span-6 xl:col-span-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if ( have_rows( 'highlights' ) ) : ?>
                <?php while ( have_rows( 'highlights' ) ) : the_row();
                    // Sub fields
                    $image_id    = get_sub_field( 'image' );
                    $title       = get_sub_field( 'title' );
                    $slogan      = get_sub_field( 'slogan' );
                    $description = get_sub_field( 'description' );
                    $productUrl = get_sub_field( 'product_url' );
                ?>
                <div class="card-highlight">
                    <a href="<?php echo wp_kses_post( $productUrl ); ?>">
                        <div class="card-highlight--image bg-[#C4C4C4]">
                            <?php 
                            if ( $image_id ) {
                                echo wp_get_attachment_image(
                                    $image_id,
                                    'highlights-size', 
                                    false,
                                    ['class' => 'w-full h-full object-cover', 'loading' => 'lazy']
                                );
                            }
                            ?>
                        </div>

                        <div class="card-highlight--content">
                            <span class="overlay"></span>

                            <?php if ( $description ) : ?>
                                <span class="block-text"><?php echo wp_kses_post( $description ); ?></span>
                            <?php endif; ?>

                            <div class="card-highlight--footer flex justify-between items-center">
                                <div>
                                    <?php if ( $title ) : ?>
                                        <h2 class="card-highlight--title uppercase"><?php echo esc_html( $title ); ?></h2>
                                    <?php endif; ?>
                                    <?php if ( $slogan ) : ?>
                                        <h3 class="card-highlight--slogan"><?php echo esc_html( $slogan ); ?></h3>
                                    <?php endif; ?>
                                </div>
                                <div class="card-highlight--arrow"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="text-gray-600"><?php echo esc_html__( 'No highlights yet.', 'aleandbread' ); ?></p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>
