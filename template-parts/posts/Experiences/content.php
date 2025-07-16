<section id="experiences" class="experiences relative overflow-hidden bg-background pt-[152px] md:pt-[194px] xl:pt-[280px]">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      <div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-5 pb-[30px] md:pb-[56px] xl:pb-[58px] w-full">
        <?php do_action('breadcrumbs'); ?>
      </div>

      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-2 xl:col-span-4">
        <h1 class="text-dark pb-[16px] md:pb-[56px] xl:pb-[231px] w-[343px] md:w-[585px] xl:max-w-full">
          <?php echo get_field('experiences_cpt_title'); ?>
        </h1>
      </div>

      <p class="text-dark block-text col-start-1 col-span-2 md:col-span-6 xl:col-start-8 xl:col-span-4 pb-[54px] md:pb-[159px] xl:pb-0 max-w-[343px] md:max-w-[438px] xl:max-w-full">
        <?php echo get_field('experiences_cpt_description'); ?>
      </p>
    </div>

    <!-- Workshop 1 -->
    <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 bg-dark">
      <div class=" col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-1 xl:col-span-5">
        <?php 
        $image = get_field('experiences_cpt_workshop_image');
        $size = 'full';
        $classes = 'w-full'; 
        if( $image ) {
            echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
        }?>
      </div>

      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-6 xl:col-span-12 bg-dark">
        <h2 class="text-background pb-[7px] pl-[27px] md:pl-[42px] xl:pl-[110px] pt-[27px] md:pt-[52px] xl:pt-[72px]">
          <?php echo get_field('experiences_cpt_workshop_title'); ?>
        </h2>
        <p class="text-background pb-[20px] md:pb-[47px] xl:pb-[26px] pl-[30px] md:pl-[42px] xl:pl-[110px]">
          <?php echo get_field('experiences_cpt_workshop_subtitle'); ?>
        </p>
        <h4 class="text-background pb-[36px] md:pb-[41px] xl:pb-[39px] pl-[30px] md:pl-[42px] xl:pl-[110px] max-w-[270px] md:max-w-[528px] xl:max-w-[614px]">
          <?php echo get_field('experiences_cpt_workshop_description'); ?>
        </h4>

        <div class="grid flex-wrap items-center text-dark text-sm font-semibold md:pb-[60px] col-start-1 col-span-6">
          <div class="flex items-center gap-2 pb-[17px] md:pb-0 pl-[30px] md:pl-[42px] xl:pl-[110px]">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/clock.svg" alt="Clock" />
            <span class="text-background block-text"><?php echo get_field('experiences_cpt_workshop_duration'); ?></span>
          </div>
          <div class="md:col-span-2 pb-[53px] md:pb-0 md:col-start-2 flex items-center gap-2 pl-[30px] xl:pl-0">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
            <span class="text-background block-text"><?php echo get_field('experiences_cpt_workshop_localisation'); ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Workshop 2 (conditionally rendered) -->
    <?php if (
    get_field('experiences_cpt_workshop_image_2') ||
    get_field('experiences_cpt_workshop_title_2') ||
    get_field('experiences_cpt_workshop_subtitle_2') ||
    get_field('experiences_cpt_workshop_description_2') ||
    get_field('experiences_cpt_workshop_duration_2') ||
    get_field('experiences_cpt_workshop_localisation_2')
    ): ?>
    <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-12 bg-background pb-[48px] md:pb-[68px]">
    </div>
    <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 bg-dark">
        <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-1 xl:col-span-5">
        <?php 
        $image = get_field('experiences_cpt_workshop_image_2');
        $size = 'full';
        $classes = 'w-full'; 
        if( $image ) {
            echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
        }?>
        </div>

        <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-6 xl:col-span-12 bg-dark">
        <h2 class="text-background pb-[7px] pl-[27px] md:pl-[42px] xl:pl-[110px] pt-[27px] md:pt-[52px] xl:pt-[72px]">
            <?php echo get_field('experiences_cpt_workshop_title_2'); ?>
        </h2>
        <p class="text-background pb-[20px] md:pb-[47px] xl:pb-[26px] pl-[30px] md:pl-[42px] xl:pl-[110px]">
            <?php echo get_field('experiences_cpt_workshop_subtitle_2'); ?>
        </p>
        <h4 class="text-background pb-[36px] md:pb-[41px] xl:pb-[39px] pl-[30px] md:pl-[42px] xl:pl-[110px] max-w-[270px] md:max-w-[528px]">
            <?php echo get_field('experiences_cpt_workshop_description_2'); ?>
        </h4>

        <div class="grid flex-wrap items-center text-dark text-sm font-semibold md:pb-[60px] col-start-1 col-span-6">
            <div class="flex items-center gap-2 pb-[17px] md:pb-0 pl-[30px] md:pl-[42px] xl:pl-[110px]">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/clock.svg" alt="Clock" />
            <span class="text-background block-text">
                <?php echo get_field('experiences_cpt_workshop_duration_2'); ?>
            </span>
            </div>
            <div class="md:col-span-2 pb-[53px] md:pb-0 md:col-start-2 flex items-center gap-2 pl-[30px] xl:pl-[120px]">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
            <span class="text-background block-text">
                <?php echo get_field('experiences_cpt_workshop_localisation_2'); ?>
            </span>
            </div>
        </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- CTA Button -->
    <div class="align-items-center justify-center text-center pt-[50px] md:pt-[80px] pb-[69px] md:pb-[105px] xl:pt-[94px] xl:pb-[92px] mb[120px]">
      <a class="btn btn-tertiary !border-accent md:w-[250px]">
        <?php esc_html_e( 'see all experiences', 'aleandbread' ); ?>
      </a>
    </div>
  </div>
</section>