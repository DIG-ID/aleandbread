<section id="craftmanship" class="craftmanship  bg-dark pb-14 md:pb-24 xl:pb-56">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-span-12 grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 xl:mt-[139px] gap-4">
                    <?php 
                        $image1 = get_field('craftmanship_image_1');
                        if( $image1 ):
                    ?>
                        <div class="col-span-1 md:col-span-3 xl:col-span-2 pb-14">
                            <?php echo wp_get_attachment_image( $image1, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>
                <div class="col-start-1 xl:col-start-4 col-span-2 md:col-span-6 xl:col-span-3">
                <h1 class="text-blockTextLight w-[305px] md:w-[550px] xl:w-[380px] col-span-2 md:col-span-5 col-start-1 xl:col-start-4 "><?php echo get_field('craftmanship_title'); ?></h1>
                <h3 class="text-blockTextLight pt-[56px] md:pb-12 md:pt-12 xl:pt-14 md:w-full w-[300px] xl:w-[365px] pb-7 xl:pb-20"><?php echo get_field('craftmanship_subtitle'); ?></h3>
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
                <div class="col-start-1 xl:col-start-8 col-span-2 md:col-span-5 xl:col-span-4">
                <p class="block-text text-blockTextLight self-stretch pt-7 xl:pt-0 md:pt-12"><?php echo get_field('craftmanship_description_1'); ?></p>
                <p class="block-text text-blockTextLight pt-7 md:pt-12 xl:pt-24 pb-7 md:pb-0"><?php echo get_field('craftmanship_description_2'); ?></p>
                </div>
            </div>
            <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-6 xl:col-span-12 xl:mt-24 grid xl:grid-cols-12 gap-4 md:pt-14">
                    <?php 
                        $image1 = get_field('craftmanship_image_2');
                        if( $image1 ):
                    ?>
                        <div class="md:col-span-6 hidden xl:block">
                            <?php echo wp_get_attachment_image( $image1, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                        $image2 = get_field('craftmanship_image_3');
                        if( $image2 ):
                    ?>
                        <div class="xl:col-start-7 col-span-6">
                            <?php echo wp_get_attachment_image( $image2, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>
            </div>
         </div>
    </div>
</section>