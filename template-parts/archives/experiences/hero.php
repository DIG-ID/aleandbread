<section  id="hero" class="section-hero pb-0 relative overflow-hidden">
    <figure class="absolute bg-background xl:left-[420px] xl:top-0 inset-0 xl:w-[1500px] xl:h-[1000px] xl:object-cover xl:z-[-1] pointer-events-none xl:mb-[158px]">
    <?php 
        $background = get_field('experiences_hero_background', 'option');
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
                <div class="col-start-1 col-span-1 md:col-start-1 md:col-span-3 xl:col-start-2 xl:col-span-2 pt-[152px] md:pt-[197px] xl:pt-[280px]">
                    <?php do_action ( 'breadcrumbs' ); ?>
                </div>
                <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-5 xl:col-start-2 xl:col-span-4">
                    <h1 class="text-dark pt-[30px] md:pt-[56px] xl:pt-[66px] w-[300px] md:w-full"><?php echo get_field('experiences_hero_title', 'option'); ?></h1>
                </div>
                <div class=" col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-2 xl:col-span-4">
                    <p class="block-text text-dark pt-[30px] md:pt-[56px] xl:pt-[66px] md:w-[444px] xl:w-[555px]"><?php echo get_field('experiences_hero_description', 'option'); ?></p>
                </div>
                <div class="flex flex-col items-start justify-start col-start-1 xl:col-start-2 pt-[30px] md:pt-[56px] xl:pt-[66px] pb-[270px] md:pb-[432px] xl:pb-[300px]">                        
                <?php
                    $button = get_field('experiences_hero_button', 'option');
                    if( $button ):
                    $link_url = $button['url'];
                    $link_title = $button['title'];
                    $link_target = $button['target'] ? $button['target'] : '_self';
                    ?>
                    <a class="btn btn-tertiary w-[160px] md:w-[270px] xl:w-[270px] !border-accent" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                    <?php echo esc_html($link_title); ?>
                    </a>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>