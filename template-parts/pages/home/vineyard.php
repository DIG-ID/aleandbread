<section id="vineyard" class="vineyard  bg-dark  xl:bg-transparent">
<div class="theme-container !max-w-full">
    <?php
// Get image ID from ACF
$image_id = get_field('vineyard_background_image');

// Get image URL from ID
$image_url = wp_get_attachment_image_url($image_id, 'full');
?>
    <div class="theme-grid relative">
        <div class="-mx-6 xl:mx-0 col-span-2 md:col-span-6 ">
        <?php if ($image_url): ?>
                <figure class="img-overlay img-overlay--horizontal-right xl:absolute xl:left-0 xl:top-0 inset-0 w-full h-full xl:object-cover xl:z-[-1] pointer-events-none">
                <img 
                    src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
                    class="w-full h-full object-cover"
                    loading="lazy"
                />
                </figure>
            <?php endif; ?>
        </div>
        <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-8 pt-1 md:pt-3 xl:pt-[186px]">
                <p class="over-title text-accent "><?php echo get_field('vineyard_over_title'); ?>
                <h1 class="text-blockTextLight pt-5 md:pt-20 "><?php echo get_field('vineyard_title'); ?></h1>
                <p class="block-text text-blockTextLight pt-10 md:pt-16"><?php echo get_field('vineyard_description'); ?></p>
                <div class="flex items-center gap-9 pt-20">
                    <img class="w-auto h-[70px]" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/icon3.svg" alt="Icon 1" />
                    <p class="block-text-bold text-blockTextLight md:leading-[29.7px] max-w-[200px] md:max-w-[320px]">
                        <?php echo get_field('vineyard_block_text_1'); ?>
                    </p>
                </div>

                <div class="flex items-center gap-9 pt-[75px]">
                    <img class="w-auto h-[70px]" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/sun-and-birds.svg" alt="Icon 2" />
                    <p class="block-text-bold text-blockTextLight md:leading-[29.7px] max-w-[200px] md:max-w-[320px]">
                        <?php echo get_field('vineyard_block_text_2'); ?>
                    </p>
                </div>
                <a class="btn btn-big-button mb-6 pt-16 pb-64">MEHR ERFAHREN</a>
        </div>
    </div>
</div>
</section>