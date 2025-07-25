<section id="content" class="content relative overflow-hidden bg-background pb-[110px] md:pb-[134px] xl:pb-[243px] pt-[152px] md:pt-[192px] xl:pt-[264px]">
  <div class="theme-container relative z-10">
    <div class="theme-grid">

      <?php $image = get_field('events_cpt_image'); ?>
      <?php if ($image): ?>
        <div class="col-span-2 md:col-span-6 xl:col-span-6 xl:col-start-1">
          <?php echo wp_get_attachment_image($image, 'full', false, [
            'class' => 'w-full h-auto object-cover'
          ]); ?>
        </div>
      <?php endif; ?>

      <div class="col-span-2 md:col-span-6 xl:col-span-6 xl:col-start-8 pt-[52px] md:pt-[72px] xl:pt-0 flex flex-col gap-8 xl:gap-10">

        <h2 class="text-dark font-bold text-[28px] md:text-[32px] xl:text-[36px] leading-tight w-[350px] md:w-[385px] xl:w-[437px]">
          <?php echo get_field('events_cpt_title'); ?>
        </h2>

        <p class="text-dark block-text w-[345px] md:w-[556px]">
          <?php echo get_field('events_cpt_description'); ?>
        </p>

        <div class="flex flex-wrap gap-6 flex-col md:flex-row md:items-center text-dark text-sm font-semibold">

          <div class="flex items-center gap-2">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/clock.svg" alt="Clock" />
            <span class="block-text-bold -mb-0.5"><?php echo get_field('events_cpt_time'); ?></span>
          </div>

          <div class="flex items-center gap-2">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/calendar.svg" alt="Calendar" />
            <span class="block-text-bold mb-0.5"><?php echo get_field('events_cpt_date'); ?></span>
          </div>

          <div class="flex items-center gap-2">
            <img class="inline-block w-4 h-4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/location.svg" alt="Location" />
            <span class="block-text-bold mb-0.5"><?php echo get_field('events_cpt_place'); ?></span>
          </div>

        </div>

        <div>
          <a class="btn btn-tertiary mt-4 w-[260px] !inline pr-12">
            <span>ZUR FLANEUR WEBSEITE</span>
          </a>
        </div>

      </div>
    </div>
  </div>
</section>