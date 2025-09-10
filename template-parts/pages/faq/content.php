<section id="faq" class="faq bg-background pb-6">
  <div class="theme-container">
    <div class="theme-grid">

      <!-- Breadcrumbs + Title -->
      <div class="theme-grid col-span-2 md:col-span-6 xl:col-span-12 pt-36 md:pt-44 xl:pt-52 pb-12 md:pb-16 xl:pb-20">
        <div class="col-start-1 col-span-2 xl:col-start-2">
          <?php do_action('breadcrumbs'); ?>
          <h1 class="text-dark pt-[12px]">
            <?php the_title(); ?>
          </h1>
        </div>
      </div>

      <div class="theme-grid col-span-2 md:col-span-6 xl:col-span-12">
        <!-- Accordion -->
        <div class="xl:col-start-1 xl:col-span-7 col-span-full">

          <?php if ( have_rows('faq') ) : $group_i = 0; ?>
            <?php while ( have_rows('faq') ) : the_row(); $group_i++; ?>
            <div class="faq-wrapper mb-28">
              <?php
              $group_title = get_sub_field('title');
              if ( $group_title ) : ?>
                <h2 class="text-dark mb-4 md:mb-6">
                  <?php echo esc_html( $group_title ); ?>
                </h2>
              <?php endif; ?>

              <?php if ( have_rows('faq_accordion') ) : $item_i = 0; ?>
                <?php while ( have_rows('faq_accordion') ) : the_row(); $item_i++; ?>
                  <?php
                    $question = get_sub_field('question');
                    $answer   = get_sub_field('response');

                    if ( ! $question || ! $answer ) {
                      continue;
                    }

                    // Unique IDs help a11y and JS targeting if needed
                    $uid = 'faq-' . $group_i . '-' . $item_i;
                  ?>

                  <div class="faq-item bg-[#F3F3F3] border border-[#E2E2E2] rounded-none mb-4 px-6 py-5 transition-all duration-300" data-accordion>
                    <div class="flex items-center justify-between cursor-pointer toggle-header" id="<?php echo esc_attr( $uid ); ?>-header">
                      <p class="faq-question text-dark block-text !font-bold md:!font-medium transition-colors duration-300 max-w-[292px] md:max-w-[580px] xl:max-w-full !text-sm md:!text-xl">
                        <?php echo esc_html( $question ); ?>
                      </p>
                      <span class="toggle-icon text-dark text-xl font-bold leading-none transition-all">+</span>
                    </div>
                    <div
                      class="accordion-content max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out !text-sm md:!text-base xl:!text-base text-dark pt-4 hidden max-w-[275px] md:max-w-[540px] xl:max-w-[848px]"
                      id="<?php echo esc_attr( $uid ); ?>"
                      role="region"
                      aria-labelledby="<?php echo esc_attr( $uid ); ?>-header"
                    >
                      <p class="block-text">
                        <?php
                          // Use wp_kses_post + wpautop to allow basic formatting in responses.
                          // If you want plain text only, swap for esc_html( $answer ).
                          echo wp_kses_post( wpautop( $answer ) );
                        ?>
                      </p>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php endif; ?>
                  </div>
            <?php endwhile; ?>

          <?php else : ?>
            <!-- Optional: fallback if no FAQ rows -->
            <p class="text-dark"><?php esc_html_e( 'No FAQs found.', 'aleandbread' ); ?></p>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </div>
</section>
