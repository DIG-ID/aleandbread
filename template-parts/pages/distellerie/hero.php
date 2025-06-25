<section  id="hero" class="section-hero pb-0 relative overflow-hidden">
    <figure class="img-overlay img-overlay--horizontal-left-top xl:absolute xl:left-0 xl:top-0 inset-0 w-full h-full xl:object-cover xl:z-[-1] pointer-events-none">
    <?php 
        $background = get_field('hero_background');
        if( $background ): 
            $image_url = wp_get_attachment_image_url($background, 'full'); 
    ?>
        <!-- Static background image -->
        <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
    <?php endif; ?>
    </figure>
    <!-- Content stays normally positioned with higher z-index -->
    <div class="theme-container relative z-10">
        <div class="theme-grid">
            <div class="col-span-2 md:col-span-4 xl:col-span-6 xl:col-start-2 pt-40 md:pt-60 xl:pt-[275px] max-h-dvh min-h-dvh">
                <?php do_action ( 'breadcrumbs' ); ?>
                <h1 class="text-blockTextLight pt-[56px] w-[240px] md:w-full"><?php echo get_field('hero_title'); ?></h1>
                <p class="block-text text-blockTextLight pt-[56px] md:pt-16 xl:pt-14 w-[560px] pb-[56px]"><?php echo get_field('hero_description'); ?></p>
                <div class="flex flex-col items-start justify-start xl:flex-row xl:items-center gap-8 md:gap-8 xl:gap-6 md:pt-10 mb-[184px] xl:pb-56 col-start-1">                        
                <a class="btn btn-primary w-1/2"><?php esc_html_e( 'HEARTS & TAILS SHOP', 'aleandbread' );  ?></a>
                </div>
            </div>
        </div>
    </div>
</section>