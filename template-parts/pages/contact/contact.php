<section id="contact" class="contact bg-background">
    <div class="theme-container pt-[130px] md:pt-[194px] xl:pt-[280px]">
        <div class="theme-grid">
            <div class="col-start-1 xl:col-start-2 col-span-2 md:col-span4 xl:col-span-3"> 
                <p class="over-title text-accent mb-14"><?php echo get_field('kontakt_over_title'); ?></p>
            </div>
            <div class="col-start-1 xl:col-start-2 col-span-2 md:col-span4 xl:col-span-3">
                <h1 class="text-dark mb-9"><?php echo get_field('kontakt_title'); ?></h1>
                <h3 class="text-dark mb-9"><?php echo get_field('kontakt_sub_title'); ?></h3>
                <p class="block-text text-blockText"><?php echo get_field('kontakt_description'); ?></p>
            </div>

            <div class="col-start-1 xl:col-start-8 col-span-2 md:col-span3 xl:col-span-2 self-start">
                <h1 class="text-dark mb-12">
                    <?php echo get_field('kontakt_kontact'); ?> 
                </h1>

                <?php 
                $address = get_field('address', 'option');
                if ($address): ?>
                    <div class="flex items-start">
                        <img class="w-auto h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" title="Location"/>
                        <p class="text-dark pl-[19px]"><?php echo esc_html($address); ?></p>
                    </div>
                <?php endif; ?>

                <?php 
                $email = get_field('email', 'option');
                if ($email): ?>
                    <div class="flex items-start pt-12">
                        <img class="w-auto h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/email.svg" alt="Email" title="Email"/>
                        <p class="text-dark pl-[16px]"><?php echo esc_html($email); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>