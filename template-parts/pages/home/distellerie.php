<section id="distellerie" class="distellerie">
<div class="theme-container">
    <?php
// Get image ID from ACF
$image_id = get_field('distellerie_background_image');

// Get image URL from ID
$image_url = wp_get_attachment_image_url($image_id, 'full');
?>
    <div class="theme-grid">
        <?php if ($image_url): ?>
                <img 
                    src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
                    class="absolute inset-0 w-full h-full object-cover z-[-1] pointer-events-none"
                    loading="lazy"
                />
            <?php endif; ?>
        <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-2 pt-1 md:pt-3 xl:pt-48">
                <p class="over-title text-accent "><?php echo get_field('distellerie_over_title'); ?>
                <h1 class="text-blockTextLight pt-5 md:pt-20 "><?php echo get_field('distellerie_title'); ?></h1>
                <p class="block-text text-blockTextLight pt-10 md:pt-16"><?php echo get_field('distellerie_description'); ?></p>
                <div class="flex items-center gap-9 pt-20">
                    <img class="w-auto h-[70px]" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/icon1.svg" alt="Icon 1" />
                    <p class="block-text-bold text-blockTextLight md:leading-[29.7px] max-w-[200px] md:max-w-[320px]">
                        <?php echo get_field('distellerie_block_text_1'); ?>
                    </p>
                </div>

                <div class="flex items-center gap-9 pt-[75px]">
                    <img class="w-auto h-[70px]" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/icon2.svg" alt="Icon 2" />
                    <p class="block-text-bold text-blockTextLight md:leading-[29.7px] max-w-[200px] md:max-w-[320px]">
                        <?php echo get_field('distellerie_block_text_2'); ?>
                    </p>
                </div>
                <a class="btn btn-big-button mb-6 pt-16">MEHR ERFAHREN</a>
        </div>
    </div>
</div>
</section>