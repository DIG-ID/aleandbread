<section id="our-experiences" class="our-experiences bg-dark xl:bg-transparent">
<div class="theme-container !max-w-full">
    <?php
// Get image ID from ACF
$image_id = get_field('our_experience_background_image', 'option');

// Get image URL from ID
$image_url = wp_get_attachment_image_url($image_id, 'full');
?>
    <div class="theme-grid relative">
        <div class="-mx-6 xl:mx-0 col-span-2 md:col-span-6 order-1">
        <?php if ($image_url): ?>
            <figure class="img-overlay img-overlay--horizontal-right-2 relative xl:absolute xl:left-0 xl:top-0 inset-0 w-full h-full xl:object-cover xl:z-[-1] pointer-events-none">
                <img 
                    src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
                    class=""
                    loading="lazy"
                />
            </figure>
            <?php endif; ?>
        </div>
        <div class="col-span-2 md:col-span-5 xl:col-span-4 xl:col-start-8 pt-1 md:pt-3 xl:pt-[130px] order-2">
                <p class="over-title text-accent"><?php echo get_field('our_experience_over_title', 'option'); ?>
                <h1 class="text-blockTextLight pt-5 md:pt-14 "><?php echo get_field('our_experience_title', 'option'); ?></h1>
                <p class="block-text text-blockTextLight pt-10 md:pt-14"><?php echo get_field('our_experience_description', 'option'); ?></p>
                <?php
                    $button = get_field('our_experience_button', 'option');
                    if( $button ):
                    $link_url = $button['url'];
                    $link_title = $button['title'];
                    $link_target = $button['target'] ? $button['target'] : '_self';
                    ?>
                    <a class="btn btn-tertiary mt-14 !border-accent mb-44" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                    <?php echo esc_html($link_title); ?>
                    </a>
                <?php endif; ?>
        </div>
    </div>
</div>
</section>