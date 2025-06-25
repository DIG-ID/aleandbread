<section id="craftmanship" class="craftmanship  bg-dark pb-36 md:pb-48 xl:pb-56">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-12 order-1 xl:mt-[139px] grid grid-cols-12 gap-4">
                    <?php 
                        $image1 = get_field('craftmanship_image_1');
                        if( $image1 ):
                    ?>
                        <div class="col-span-2">
                            <?php echo wp_get_attachment_image( $image1, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>
                <div class="col-start-4 col-span-2">
                <h1 class="text-blockTextLight w-[380px] col-start-4 "><?php echo get_field('craftmanship_title'); ?></h1>
                <h3 class="text-blockTextLight pt-[56px] md:pt-16 xl:pt-14 w-[365px] pb-[56px]"><?php echo get_field('craftmanship_subtitle'); ?></h3>
                <?php 
                    $link = get_field('craftmanship_button');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="btn btn-primary !col-span-2" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="col-start-8 col-span-4">
                <p class="block-text text-blockTextLight mb-24"><?php echo get_field('craftmanship_description_1'); ?></p>
                <p class="block-text text-blockTextLight"><?php echo get_field('craftmanship_description_2'); ?></p>
                </div>
            </div>
            <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-12 order-1 xl:mt-24 grid grid-cols-12 gap-4">
                    <?php 
                        $image1 = get_field('craftmanship_image_2');
                        if( $image1 ):
                    ?>
                        <div class="col-span-6">
                            <?php echo wp_get_attachment_image( $image1, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                        $image2 = get_field('craftmanship_image_3');
                        if( $image2 ):
                    ?>
                        <div class="col-start-7 col-span-6">
                            <?php echo wp_get_attachment_image( $image2, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>
            </div>
         </div>
    </div>
</section>