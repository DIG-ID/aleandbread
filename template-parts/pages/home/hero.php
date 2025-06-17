<?php
$section_hero_gallery = get_field('section_hero_gallery');
if( $section_hero_gallery ) {
    $image_id_1 = $section_hero_gallery[0];
    $image_url_1 = wp_get_attachment_image_url($image_id_1, 'full');

    $image_id_2 = $section_hero_gallery[1];
    $image_url_2 = wp_get_attachment_image_url($image_id_2, 'full');
}
?>
<section>
    <div class="swiper h-screen w-screen overflow-hidden">
    <div class="swiper-wrapper">

        <!-- Slide 1 -->
        <div class="swiper-slide relative">
            <div class="absolute inset-0 bg-cover bg-center" 
                 style="background-image: url('<?php echo esc_url($image_url_1); ?>');"></div>

            <div class="theme-container relative z-10">
                <div class="theme-grid">
                    <div class="col-span-2 md:col-span-5 xl:col-span-6 xl:col-start-2 pt-1 md:pt-3 xl:pt-[135px]">
                        <h1 class="text-blockTextLight pt-5 md:pt-20"><?php echo get_field('section_hero_title'); ?></h1>
                        <p class="block-text text-blockTextLight pt-10 md:pt-16 md:max-w-[435px]"><?php echo get_field('section_hero_description'); ?></p>
                        <div class="flex items-center gap-9 pt-20">
                            <a class="btn btn-tertiary mt-20 mb-64 !border-accent "><span>Buche dein Erlebnisse</span></a>
                            <a class="btn btn-tertiary mt-20 mb-64 "><span>unsere Produkte</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="swiper-slide relative">
            <div class="absolute inset-0 bg-cover bg-center" 
                 style="background-image: url('<?php echo esc_url($image_url_2); ?>');"></div>

            <div class="theme-container relative z-10">
                <div class="theme-grid">
                    <div class="col-span-2 md:col-span-5 xl:col-span-6 xl:col-start-2 pt-1 md:pt-3 xl:pt-[135px]">
                        <h1 class="text-blockTextLight pt-5 md:pt-20"><?php echo get_field('section_hero_title_2'); ?></h1>
                        <p class="block-text text-blockTextLight pt-10 md:pt-16 md:max-w-[435px]"><?php echo get_field('section_hero_description'); ?></p>
                        <div class="flex items-center gap-9 pt-20">
                            <a class="btn btn-tertiary mt-20 mb-64 !border-accent "><span>Buche dein Erlebnisse</span></a>
                            <a class="btn btn-tertiary mt-20 mb-64 "><span>unsere Produkte</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</section>