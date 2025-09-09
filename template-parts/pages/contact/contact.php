<section id="contact" class="contact bg-background">
    <div class="theme-container pt-[130px] md:pt-[194px] xl:pt-[280px]">
        <div class="theme-grid">
             <div class="col-span-2 md:col-span-6 xl:col-span-12 xl:col-start-2 pb-[30px] md:pb-[56px]"> 
                    <?php do_action ( 'breadcrumbs' ); ?>
                </div>
            <div class="col-start-1 xl:col-start-2 col-span-2 md:col-span-5 xl:col-span-4">
                <h1 class="text-dark pb-[28px] md:pb-[38px] "><?php echo get_field('kontakt_title'); ?></h1>
                <h3 class="text-dark  pb-[28px] md:pb-[38px]"><?php echo get_field('kontakt_sub_title'); ?></h3>
                <p class="block-text text-blockText w-[335px] md:w-[560px] xl:w-full pb-[48px] md:pb-[75px] xl:pb-0"><?php echo get_field('kontakt_description'); ?></p>
            </div>

            <div class="col-start-1 xl:col-start-8 col-span-2 md:col-span-6 xl:col-span-2 self-start">
                <h1 class="text-dark pb-[28px] md:pb-[65px] xl:pb-[74px]">
                    <?php echo get_field('kontakt_kontact'); ?> 
                </h1>

                <?php 
                $address = get_field('address', 'option');
                if ($address): ?>
                    <div class="flex items-center xl:justify-center pb-7 md:pb-[30px] xl:pb-12">
                        <img class="w-auto h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/basil_location.svg" alt="Location" title="Location"/>
                        <p class="text-dark pl-[19px]"><?php echo esc_html($address); ?></p>
                    </div>
                <?php endif; ?>

                <?php 
                $email = get_field('email', 'option');
                if ($email): ?>
                    <div class="flex items-center">
                        <img class="w-auto h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/email.svg" alt="Email" title="Email"/>
                        <p class="text-dark pl-[16px]"><?php echo esc_html($email); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            </div>
            <div class="theme-grid">
            <div class="xl:col-start-2 col-span-2 md:col-span-6 xl:col-span-10 pt-16 md:pt-[88px] xl:pt-44 md:mb-52 xl:mb-[283px]">
                <div class=" bg-[#140606] -mx-[16px] md:-mx-0 pr-8 pl-8 md:pl-[60px] md:pr-[60px] xl:pr-16 xl:pl-16 pb-6 pt-1">
                    <div class="w-full mb-10 mt-12">
                        <?php 
                        $image = get_field('theme_logo', 'option');
                        $size = 'full'; // (thumbnail, medium, large, full or custom size)
                        $classes = 'w-[193px] md:w-[285px]';
                        if( $image ) {
                            echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                        }?>
                    </div>
                    <?php echo do_shortcode('[contact-form-7 id="7900e59" title="Contact Page Form"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>