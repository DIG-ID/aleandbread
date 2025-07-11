<section id="experiences" class="experiences relative overflow-hidden bg-background pt-[152px] md:pt-[194px] xl:pt-[280px]">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
            <div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-5 pb-[30px] md:pb-[56px] xl-pb-[58px]">
                <?php do_action('breadcrumbs'); ?>
            </div>
            <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-2 xl:col-span-4">
                <h1 class="text-dark pb-[16px] md:pb-[56px] xl:pb-[231px]">
                    <?php echo get_field('experiences_cpt_title'); ?>
                </h1>
            </div>
                <p class="text-dark block-text col-start-1 col-span-2 md:col-span-6 xl:col-start-8 xl:col-span-4 pb-[46px] md:pb-[165px] xl:pb-0">
                    <?php echo get_field('experiences_cpt_description'); ?>
                </p>
            </div>
                <div class="theme-grid grid-cols-2 md:grid-cols-4 xl:grid-cols-12 bg-dark">
                    <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-1 xl:col-span-5">
                    <?php 
                            $image = get_field('experiences_cpt_workshop_image');
                            $size = 'full'; // (thumbnail, medium, large, full or custom size)
                            $classes = 'w-full'; 
                            if( $image ) {
                                echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                            }?>
                    </div>
                    <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-6 xl:col-span-7 bg-dark">
                            <h2 class="text-background pb-[7px] pl-[27px] md:pl-[39px] xl:pl-[110px] pt-[27px] md:pt-[52px] xl:pt-[80px]">
                                <?php echo get_field('experiences_cpt_workshop_title'); ?>
                            </h2>
                            <p class="text-background pb-0 md:pb-[16px] pl-[30px] md:pl-[42px] xl:pl-[110px]">
                                <?php echo get_field('experiences_cpt_workshop_subtitle'); ?>
                            </p>
                            <h4 class="text-background pb:[36px] md:pb-[81px] xl:pb-[39px] pl-[30px] md:pl-[42px] xl:pl-[110px]">
                                <?php echo get_field('experiences_cpt_workshop_description'); ?>
                            </h4>
                            <div class="flex flex-wrap items-center text-dark text-sm font-semibold">

                            <div class="flex items-center gap-2 xl:pl-[110px]">
                                <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/clock.svg" alt="Clock" />
                                <span class="text-background block-text"><?php echo get_field('experiences_cpt_workshop_duration'); ?></span>
                            </div>
                            <div class="flex items-center gap-2  xl:pl-[120px]">
                                <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
                                <span class="text-background block-text"><?php echo get_field('experiences_cpt_workshop_localisation'); ?></span>
                            </div>
                    </div>
                </div>
            </div>
            
            <?php if (
            get_field('experiences_cpt_workshop_image_2') ||
            get_field('experiences_cpt_workshop_title_2') ||
            get_field('experiences_cpt_workshop_subtitle_2') ||
            get_field('experiences_cpt_workshop_description_2') ||
            get_field('experiences_cpt_workshop_duration_2') ||
            get_field('experiences_cpt_workshop_localisation_2')
            ): ?>
            <div class="theme-grid grid-cols-2 md:grid-cols-4 xl:grid-cols-12 bg-background pb-[108px]">
            </div>
                <div class="theme-grid grid-cols-2 md:grid-cols-4 xl:grid-cols-12 bg-dark">
                    <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-1 xl:col-span-5">
                    <?php 
                            $image = get_field('experiences_cpt_workshop_image_2');
                            $size = 'full'; // (thumbnail, medium, large, full or custom size)
                            $classes = 'w-full'; 
                            if( $image ) {
                                echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                            }?>
                    </div>
                    <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-6 xl:col-span-7 bg-dark">
                            <h2 class="text-background xl:pb-[7px] xl:pl-[110px] xl:pt-[80px]">
                                <?php echo get_field('experiences_cpt_workshop_title_2'); ?>
                            </h2>
                            <p class="text-background xl:pb-[16px] xl:pl-[110px]">
                                <?php echo get_field('experiences_cpt_workshop_subtitle_2'); ?>
                            </p>
                            <h4 class="text-background xl:pb-[39px] xl:pl-[110px]">
                                <?php echo get_field('experiences_cpt_workshop_description_2'); ?>
                            </h4>
                            <div class="flex flex-wrap gap-6 items-center text-dark text-sm font-semibold">

                            <div class="flex items-center gap-2 xl:pl-[110px]">
                                <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/clock.svg" alt="Clock" />
                                <span class="text-background block-text"><?php echo get_field('experiences_cpt_workshop_duration_2'); ?></span>
                            </div>
                            <div class="flex items-center gap-2  xl:pl-[120px]">
                                <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
                                <span class="text-background block-text"><?php echo get_field('experiences_cpt_workshop_localisation_2'); ?></span>
                            </div>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="align-items-center justify-center text-center pt-[50px] md:pt-[80px] pb-[69px] md:pb-[105px] xl:pt-[94px] xl:pb-[92px] mb[120px]">
                <a class="btn btn-tertiary !border-accent w-[250px]">
                <?php esc_html_e( 'see all experiences', 'aleandbread' ); ?>
                </a>
            </div>
  </div>
</section>