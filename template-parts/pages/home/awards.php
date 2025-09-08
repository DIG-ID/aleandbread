<section id="awards" class="awards bg-dark text-center pt-24 md:pt-52 xl:pt-60 pb-[100px] md:pb-[208px] xl:pb-[232px]">
  <div class="theme-container">
    <div class="theme-grid">
      <!-- Title + Description Block -->
      <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-6 xl:col-span-12 flex flex-col items-center">
        <h1 class="text-blockTextLight text-[40px] md:text-[48px] xl:text-[58px] font-bold leading-tight max-w-[949px] pb-8 md:pb-14">
          <?php echo get_field('awards_title'); ?>
        </h1>
        <p class="text-blockTextLight block-text text-base md:text-lg leading-normal w-[337px] md:w-[457px] xl:w-[850px] pb-[73px] md:pb-[85px] xl:pb-[130px]">
          <?php echo get_field('awards_description'); ?>
        </p>

        <!-- Award Logos -->
        <div class="flex flex-wrap justify-center items-center gap-14">
        <?php 
            $images = [
            get_field('awards_award_1'),
            get_field('awards_award_2'),
            get_field('awards_award_3')
            ];
            foreach ($images as $index => $img) {
            if ($img) {
                // Assign a class string based on index
                $classes = match ($index) {
                0 => 'w-[77px] md:w-[139px] h-auto',
                1 => 'w-[87.87px] md:w-[158px] h-auto',
                2 => 'w-[81px] md:w-[146px] h-auto',
                default => 'w-auto h-auto'
                };
                echo wp_get_attachment_image($img, 'full', false, ['class' => $classes]);
            }
            }
        ?>
        </div>
      </div>
    </div>
  </div>
</section>