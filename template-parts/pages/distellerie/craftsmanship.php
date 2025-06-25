<section id="craftmanship" class="craftmanship  bg-dark pb-36 md:pb-48 xl:pb-56">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-12 order-1 xl:mt-56 grid grid-cols-12 gap-4">
                    <?php 
                        $image1 = get_field('craftmanship_image_1');
                        if( $image1 ):
                    ?>
                        <div class="col-span-3">
                            <?php echo wp_get_attachment_image( $image1, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                        $image2 = get_field('craftmanship_image_2');
                        if( $image2 ):
                    ?>
                        <div class="col-start-4 col-span-6">
                            <?php echo wp_get_attachment_image( $image2, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                        $image3 = get_field('craftmanship_image_3');
                        if( $image3 ):
                    ?>
                    <div class="col-start-10 col-span-3 flex items-end">
                        <?php echo wp_get_attachment_image( $image3, 'full', false, array('class' => 'w-full h-auto') ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-12 order-1 xl:mt-56 grid grid-cols-12 gap-4">
                    <?php 
                        $image1 = get_field('craftmanship_image_4');
                        if( $image1 ):
                    ?>
                        <div class="col-span-3">
                            <?php echo wp_get_attachment_image( $image1, 'full', false, array('class' => 'w-full h-auto') ); ?>
                        </div>
                    <?php endif; ?>
                <div>
                <h1 class="text-blockTextLight w-[560px]"><?php echo get_field('craftmanship_title'); ?></h1>
                <h3 class="text-blockTextLight pt-[56px] md:pt-16 xl:pt-14 w-[560px] pb-[56px]"><?php echo get_field('craftmanship_sub_title'); ?></h3>
                <?php 
                    $link = get_field('craftmanship_button');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="col-start-8 col-span-4">
                <p class="block-text text-blockTextLight"><?php echo get_field('craftmanship_description'); ?></p>
                </div>
            </div>
            <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-12 order-1 xl:mt-56 grid grid-cols-12 gap-4">
                <h2 class="text-blockTextLight w-[280px]"><?php echo get_field('craftmanship_gallery_title'); ?></h2>
                <p class="block-text text-blockTextLight ml-[140px] w-[800px] mt-5"><?php echo get_field('craftmanship_gallery_title_2'); ?></p>
            </div>
         </div>
         <div class="theme-grid">
                <?php 
                $gallery = get_field('craftmanship_gallery');
                if( $gallery ): ?>
                    <div class="col-start-1 col-span-12 mt-20">
                        <div class="swiper craftmanship-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach( $gallery as $image_id ): ?>
                                    <div class="swiper-slide !w-[270px] mr-5 last:mr-0">
                                        <img 
                                            src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>" 
                                            alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
                                            class="w-full h-auto object-cover "
                                            loading="lazy"
                                        />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div> 
        </div>
</section>