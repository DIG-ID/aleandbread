<section id="outro" class="outro relative overflow-hidden -mb-4">
    <?php
    // Get image IDs from ACF
    $image_desktop_id = get_field('experiences_cpt_outro_image');
    $image_tablet_id  = get_field('experiences_cpt_outro_image_tablet');
    $image_mobile_id  = get_field('experiences_cpt_outro_image_mobile');

    // Get image URLs
    $image_desktop_url = wp_get_attachment_image_url($image_desktop_id, 'full');
    $image_tablet_url  = wp_get_attachment_image_url($image_tablet_id, 'full');
    $image_mobile_url  = wp_get_attachment_image_url($image_mobile_id, 'full');

    // Use alt text from desktop image as fallback
    $image_alt = esc_attr(get_post_meta($image_desktop_id, '_wp_attachment_image_alt', true));
    ?>
    <div class="theme-container relative z-10">
        <div class="theme-grid relative z-10">
    <!-- Mobile image (visible below md) -->
    <?php if ($image_mobile_url): ?>
        <figure class="absolute img-overlay img-overlay--vertical-2 top-0 left-0 right-0 inset-0 w-screen h-[616px] -mx-4 object-cover z-[-1] pointer-events-none block md:hidden">
            <img 
                src="<?php echo esc_url($image_mobile_url); ?>" 
                alt="<?php echo $image_alt; ?>" 
                class="w-full h-full object-cover"
                loading="lazy"
            />
        </figure>
    <?php endif; ?>

    <!-- Tablet image (visible md to below xl) -->
    <?php if ($image_tablet_url): ?>
        <figure class="absolute img-overlay img-overlay--vertical-2 inset-0 max-w-screen h-full -mx-8 object-cover z-[-1] pointer-events-none hidden md:block xl:hidden">
            <img 
                src="<?php echo esc_url($image_tablet_url); ?>" 
                alt="<?php echo $image_alt; ?>" 
                class="w-full h-full object-cover"
                loading="lazy"
            />
        </figure>
    <?php endif; ?>

    <!-- Desktop image (visible xl and up) -->
    <?php if ($image_desktop_url): ?>
        <figure class="absolute img-overlay img-overlay--vertical-2 xl:left-0 xl:top-0 inset-0 -mx-10 w-screen h-[596px] xl:object-cover xl:z-[-1] pointer-events-none hidden xl:block">
            <img 
                src="<?php echo esc_url($image_desktop_url); ?>" 
                alt="<?php echo $image_alt; ?>" 
                class="w-full h-full object-cover"
                loading="lazy"
            />
        </figure>
    <?php endif; ?>

            <!-- Title -->
            <div class="col-span-2 md:col-span-6 xl:col-start-2 xl:col-span-3 order-1 xl:order-none">
                <h1 class="text-background pt-[58px] md:pt-[125px] xl:pt-[189px] xl:pb-[156px] max-w-[283px] md:max-w-[560px] xl:max-w-[360px]">
                    <?php echo get_field('experiences_cpt_outro_title'); ?>
                </h1>
            </div>

            <!-- Description 1 -->
            <div class="col-span-2 md:col-span-6 xl:col-start-6 xl:col-span-3 order-2 xl:order-none">
                <p class="text-background block-text pt-[27px] md:pt-[54px] xl:pt-[189px] xl:pb-[179px] max-w-[275px] md:max-w-[563px] xl:max-w-[411px]">
                    <?php echo get_field('experiences_cpt_outro_description_1'); ?>
                </p>
            </div>

            <!-- Description 2 -->
            <div class="col-span-2 md:col-span-6 xl:col-start-9 xl:col-span-3 order-3 xl:order-none">
                <p class="text-background block-text pb-[57px] md:pb-[112px] xl:pb-[255px] pt-[27px] md:pt-[54px] xl:pt-[189px] max-w-[275px] md:max-w-[563px] xl:max-w-[415px]">
                    <?php echo get_field('experiences_cpt_outro_description_2'); ?>
                </p>
            </div>
        </div> 
    </div> 
</section>