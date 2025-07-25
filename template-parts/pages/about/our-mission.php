<section id="our-mission" class="our-mission bg-dark pt-[82px] md:pt-[128px] xl:pt-[280px] pb-[145px] md:pb-[200px] xl:pb-[226px]">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 md:col-start-1 xl:col-start-2 col-span-2 md:col-span-5 xl:col-span-4 order-2 xl:order-1">
                <div class="pt-[64px] md:pt-[54px] xl:pt-[43px]">
                    <?php do_action ( 'breadcrumbs' ); ?>
                </div>
                <h1 class="text-blockTextLight py-14"><?php echo get_field('unsere_mission_title'); ?></h1>
                <h3 class="text-blockTextLight "><?php echo get_field('unsere_mission_sub-title'); ?></h3>
                <p class="text-blockTextLight block-text pt-[32px] pb-[90px] md:pb-[85px] xl:pb-[200px]"><?php echo get_field('unsere_mission_description'); ?></p>
                <?php 
                    $image = get_field('theme_logo', 'option');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $classes = 'w-[184px] md:w-[415px]';
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                    }?>
            </div>
            <div class="-mx-4 md:-mx-8 xl:mx-0 col-span-full order-1 xl:order-2 xl:col-start-7 xl:col-span-6">
                <?php 
						$image = get_field('unsere_mission_image');
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						$classes = 'w-full'; 
						if( $image ) {
							echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
						}?> 
            </div>
        </div> 
    </div>
</section>