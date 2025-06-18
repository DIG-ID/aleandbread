<section class="section-hero pt-0 pb-0 relative"> <!-- relative added here -->

    <?php 
        $section_hero = get_field('section_hero_gallery');
        if( $section_hero ): 
    ?>
        <!-- Swiper absolutely positioned in background -->
        <div class="absolute inset-0 z-0">
            <div class="swiper h-screen w-screen overflow-hidden">
                <div class="swiper-wrapper">
                    <?php 
                    foreach($section_hero as $image_id):
                        $image_url = wp_get_attachment_image_url($image_id, 'full'); 
                    ?>
                        <div class="swiper-slide bg-cover bg-center" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Content stays normally positioned with higher z-index -->
    <div class="theme-container !max-w-full relative z-10">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-5 xl:col-span-6 xl:col-start-2 pt-1 md:pt-3 xl:pt-[135px]">
                <h1 class="text-blockTextLight pt-5 md:pt-20 "><?php echo get_field('section_hero_title'); ?></h1>
                <p class="block-text text-blockTextLight pt-10 md:pt-16 md:max-w-[435px]"><?php echo get_field('section_hero_description'); ?></p>
                <div class="flex items-center gap-9 pt-20">
                        <a class="btn btn-tertiary mt-20 pb-64 !border-accent "><span>Buche dein Erlebnisse</span></a>
                        <a class="btn btn-tertiary mt-20 pb-64 "><span>unsere Produkte</span></a>
                </div>
            </div>
        </div>
    </div>

</section>