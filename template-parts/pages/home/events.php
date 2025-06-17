<section id="events" class="events  bg-dark xl:bg-transparent">
<div class="theme-container !max-w-full">
    <?php
// Get image ID from ACF
$image_id = get_field('events_background_image');

// Get image URL from ID
$image_url = wp_get_attachment_image_url($image_id, 'full');
?>
    <div class="theme-grid relative">
        <div class="-mx-6 xl:mx-0 col-span-2 md:col-span-6">
        <?php if ($image_url): ?>
                <img 
                    src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
                    class="xl:absolute xl:left-0 xl:top-0 inset-0 w-full h-full xl:object-cover xl:z-[-1] pointer-events-none"
                    loading="lazy"
                />
            <?php endif; ?>
        </div>
        <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-8 pt-1 md:pt-3 xl:pt-[135px]">
                <p class="over-title text-accent "><?php echo get_field('events_over_title'); ?>
                <h1 class="text-blockTextLight pt-5 md:pt-20 "><?php echo get_field('events_title'); ?></h1>
                <p class="block-text text-blockTextLight pt-10 md:pt-16"><?php echo get_field('events_description'); ?></p>
                <a class="btn btn-tertiary mt-20 mb-64 !border-accent "><span>Mehr erfahren</span></a>
        </div>
    </div>
</div>
</section>