<section id="our-brand" class="our-brand bg-dark pb-[136px] md:pb-[200px] xl:pb-[506px]">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-span-12 pb-[74px] md:pb-[88px] xl:pb-[156px] text-center">
                <h1 class="text-blockTextLight py-14"><?php echo get_field('unsere_brands_title'); ?></h1>
            </div>
            <div class="col-span-2 md:col-span-6 xl:col-span-12 flex flex-col xl:flex-row items-center justify-center gap-y-[80px] md:gap-y-[86px] xl:gap-y-0 xl:gap-x-[184px]">
                <?php 
                    $image = get_field('unsere_brands_image-1');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $classes = ''; 
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                    }?> 
                <?php 
                    $image = get_field('unsere_brands_image-2');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $classes = ''; 
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                    }?>  
        </div>
    </div>
</section>