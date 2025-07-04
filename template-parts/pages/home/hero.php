<section  id="hero" class="section-hero pb-0 relative overflow-hidden "> <!-- relative added here -->

    <?php 
        $section_hero = get_field('section_hero_gallery');
        if( $section_hero ): 
    ?>
        <!-- Swiper absolutely positioned in background -->
        <div class="swiper-container-desktop absolute inset-0 z-0">
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

       <?php 
        $section_hero = get_field('section_hero_gallery_mobile');
        if( $section_hero ): 
    ?>
        <!-- Swiper absolutely positioned in background -->
        <div class="swiper-container-mobile absolute inset-0 z-0">
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
            <div class="col-span-2 md:col-span-4 xl:col-span-6 xl:col-start-2 pt-40 md:pt-60 xl:pt-[320px] max-h-dvh min-h-dvh md:">
                <h1 class="text-blockTextLight w-[240px] md:w-full"><?php echo get_field('section_hero_title'); ?></h1>
                <p class="block-text text-blockTextLight pt-[52px] md:pt-16 xl:pt-14 w-[290px] md:w-[375px] xl:w-[415px] pb-[38px]"><?php echo get_field('section_hero_description'); ?></p>
                    <div class="flex flex-col items-start justify-start xl:flex-row xl:items-center gap-8 md:gap-8 xl:gap-6 md:pt-10 mb-[184px] xl:pb-56 col-start-1">                        
                        <a class="btn btn-primary w-1/2"><span>unsere Produkte</span></a>
                        <a class="btn btn-tertiary w-1/2 "><span>Buche dein Erlebnisse</span></a>
                    </div>
            </div>
        </div>
    </div>
</section>  