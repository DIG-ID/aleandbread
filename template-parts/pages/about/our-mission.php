<section id="our-mission" class="our-mission pt-14 bg-dark pb-36 md:pb-48 xl:pb-56">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 md:col-start-1 xl:col-start-2 col-span-2 md:col-span-5 xl:col-span-4 mt-16 md:mt-14 xl:mt-12 order-2 xl:order-1">
                <h1 class="text-blockTextLight py-14"><?php echo get_field('unsere_mission_title'); ?></h1>
                <h3 class="text-blockTextLight pb-9 "><?php echo get_field('unsere_mission_sub-title'); ?></h3>
                <p class="text-blockTextLight block-text pb-24 xl:pb-56"><?php echo get_field('unsere_mission_description'); ?></p>
                <?php 
                    $image = get_field('theme_logo', 'option');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $classes = 'w-[184px] md:w-[415px]';
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                    }?>
            </div>
            <div class="col-start-1 md:col-start-1 xl:col-start-7 col-span-2 md:col-span-6 xl:col-span-6 mt-12 order-1 xl:order-2">
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