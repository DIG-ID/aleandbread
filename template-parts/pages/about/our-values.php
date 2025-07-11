<section id="our-values" class="our-values bg-dark pb-[275px] md:pb-[345px]  xl:pb-[300px]">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 md:col-start-1 xl:col-start-2 col-span-2 md:col-span-6 xl:col-span-4 xl:pt-12 order-1 xl:order-1">
                <?php 
                    $image = get_field('unsere_werte_image');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $classes = 'w-full'; 
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                    }?> 
            </div>
                <div class="col-start-1 md:col-start-1 xl:col-start-8 col-span-2 md:col-span-5 xl:col-span-4 order-2 xl:order-2 md:w-[560px] xl:w-full">
                    <p class="over-title text-accent pt-[88px] md:pt-[72px] "><?php echo get_field('unsere_werte_over_title'); ?></p>
                    <h1 class="text-blockTextLight self-stretch pt-[56px]"><?php echo get_field('unsere_werte_title'); ?></h1>
                    <h3 class="text-blockTextLight block-text-bold pt-[56px]"><?php echo get_field('unsere_werte_sub_title'); ?></h3>
                    <p class="text-blockTextLight block-text pt-[30px]"><?php echo get_field('unsere_werte_description'); ?></p>
                </div>
            </div> 
        </div>
    </div>
</section>