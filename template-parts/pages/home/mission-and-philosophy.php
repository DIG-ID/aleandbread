<section id="mission-and-philosophy" class="mission-and-philosophy  bg-dark pb-36 md:pb-48 xl:pb-56">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 md:col-start-1 xl:col-start-8 col-span-2 md:col-span-5 xl:col-span-4 order-2">
                <p class="over-title text-accent mt-8 md:mt-20 xl:mt-[270px]"><?php echo get_field('mission_und_philosophie_over_title'); ?></p>
                <h1 class="text-blockTextLight pt-12 md:pt-20 xl:pt-16 pb-11 md:pb[60px] xl:pb-14"><?php echo get_field('mission_und_philosophie_title'); ?></h1>
                <h4 class="text-blockTextLight pb-12 md:pb-9 self-stretch font-medium capitalize "><?php echo get_field('mission_und_philosophie_sub_title'); ?></h3>
                <p class="text-blockTextLight block-text pb-12 md:pb-20"><?php echo get_field('mission_und_philosophie_description'); ?></p>
                <?php 
                    $link = get_field('mission_und_philosophie_button');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                 <?php 
                    $image = get_field('theme_logo', 'option');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $classes = 'w-[184px] md:w-[415px] mt-16 md:mt-[154px] xl:mt-[148px]';
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                    }?>
            </div>
            <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-6 xl:col-span-6 order-1 xl:mt-56">
                <?php 
                    $image = get_field('mission_und_philosophie_image_1');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $classes = 'w-[850px]'; 
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                    }
                ?> 
            </div> 
         </div>
    </div>
</section>