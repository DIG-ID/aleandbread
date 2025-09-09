<section id="faq" class="faq bg-background pb-[74px] md:pb-[200px]">
  <div class="theme-container">
    <div class="theme-grid">

      <?php 
        $image1 = get_field('faq_image');
        $image2 = get_field('faq_image_2');
      ?>

      <!-- Breadcrumbs + Title -->
      <div class="theme-grid col-span-2 md:col-span-6 xl:col-span-12 pt-[144px] xl:pt-[280px] pb-[60px] md:pb-[200px] xl:pb-[133px]">
        <div class="col-start-1 col-span-2  xl:col-start-2 ">
          <?php do_action('breadcrumbs'); ?>
          <h1 class="text-dark pt-[12px]">
            <?php echo get_field('faq_title'); ?>
          </h1>
        </div>
      </div>

      <!-- Section 1: Accordion Q1–Q7 on Left, Image on Right -->
      <div class="theme-grid col-span-2 md:col-span-6 xl:col-span-12">
        <!-- Accordion -->
        <div class="xl:col-start-1 xl:col-span-7 col-span-full">
          <?php for ($i = 1; $i <= 7; $i++): 
            $question = get_field("faq_question_$i");
            $answer = get_field("faq_response_$i");
            if ($question && $answer): ?>
              <div class="faq-item bg-[#F3F3F3] border border-[#E2E2E2] rounded-none mb-4 px-6 py-5 transition-all duration-300" data-accordion>
                <div class="flex items-center justify-between cursor-pointer toggle-header">
                  <p class="faq-question text-dark block-text !font-bold md:!font-medium transition-colors duration-300 max-w-[292px] md:max-w-[580px] xl:max-w-full !text-sm md:!text-xl">
                    <?php echo esc_html($question); ?>
                  </p>
                  <span class="toggle-icon text-dark text-xl font-bold leading-none transition-all">+</span>
                </div>
                <div class="accordion-content max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out !text-sm md:!text-base xl:!text-base text-dark pt-4 hidden max-w-[275px] md:max-w-[540px] xl:max-w-[848px]">
                  <p class="block-text"><?php echo esc_html($answer); ?></p>
                </div>
              </div>
            <?php endif;
          endfor; ?>
        </div>

        <!-- Image -->
        <?php if ($image1): ?>
          <div class="hidden xl:flex xl:col-start-9 xl:col-span-4">
            <div class="w-[559px] max-w-full">
              <?php echo wp_get_attachment_image($image1, 'full', false, ['class' => 'w-full h-auto']); ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Section 2: Image Left, Questions 8–14 on Right -->
      <div class="theme-grid col-span-2 md:col-span-6 xl:col-span-12 xl:pt-[133px]">
        <!-- Image -->
        <?php if ($image2): ?>
          <div class="hidden xl:flex xl:col-start-1 xl:col-span-4">
            <div class="w-[559px] max-w-full">
              <?php echo wp_get_attachment_image($image2, 'full', false, ['class' => 'w-full h-auto']); ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- Accordion -->
        <div class="xl:col-start-6 xl:col-span-7 col-span-full">
          <?php for ($i = 8; $i <= 14; $i++): 
            $question = get_field("faq_question_$i");
            $answer = get_field("faq_response_$i");
            if ($question && $answer): ?>
              <div class="faq-item bg-[#F3F3F3] border border-[#E2E2E2] rounded-none mb-4 px-6 py-6 transition-all duration-300" data-accordion>
                <div class="flex items-center justify-between cursor-pointer toggle-header">
                  <p class="faq-question text-dark block-text !font-bold md:!font-medium transition-colors duration-300 max-w-[292px] md:max-w-[580px] xl:max-w-full !text-sm md:!text-xl">
                    <?php echo esc_html($question); ?>
                  </p>
                  <span class="toggle-icon text-dark text-xl font-bold leading-none transition-all">+</span>
                </div>
                <div class="accordion-content max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out !text-sm md:!text-base xl:!text-base text-dark pt-4 hidden max-w-[275px] md:max-w-[540px] xl:max-w-[848px]">
                  <p><?php echo esc_html($answer); ?></p>
                </div>
              </div>
            <?php endif;
          endfor; ?>
        </div>
      </div>

    </div>
  </div>
</section>