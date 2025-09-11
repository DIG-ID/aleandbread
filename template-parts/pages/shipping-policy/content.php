<section id="return-policy" class="return-policy bg-background pb-12 md:pb-28 xl:pb-36">
  <div class="theme-container">
    <div class="theme-grid">

      <div class="theme-grid col-span-2 md:col-span-6 xl:col-span-12">
        <div class="xl:col-start-1 xl:col-span-7 col-span-full">
            <div class="rp-wrapper">
              <?php
              $group_title = get_field('return_policy_title');
              if ( $group_title ) : ?>
                <h2 class="text-dark mb-4 md:mb-6">
                  <?php echo esc_html( $group_title ); ?>
                </h2>
              <?php endif; ?>

              <?php if ( have_rows('return_policy_policy_list') ) : $item_i = 0; ?>
                <?php while ( have_rows('return_policy_policy_list') ) : the_row(); $item_i++; ?>
                  <?php
                    $question = get_sub_field('question');
                    $answer   = get_sub_field('response');

                    if ( ! $question || ! $answer ) {
                      continue;
                    }

                    $uid = 'rp-' . $item_i;
                  ?>

                  <div class="rp-item bg-[#F3F3F3] border border-[#E2E2E2] rounded-none mb-4 px-6 py-5 transition-all duration-300" data-accordion>
                    <div class="flex items-center justify-between cursor-pointer toggle-header" id="<?php echo esc_attr( $uid ); ?>-header">
                      <p class="accordion-question text-dark block-text !font-bold md:!font-medium transition-colors duration-300 max-w-[292px] md:max-w-[580px] xl:max-w-full !text-sm md:!text-xl">
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
                          echo wp_kses_post( wpautop( $answer ) );
                        ?>
                      </p>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>

        </div>
      </div>

    </div>
  </div>
</section>