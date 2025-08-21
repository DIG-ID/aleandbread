<section id="blog" class="blog relative overflow-hidden bg-background pt-[109px] md:pt-[157px] xl:pt-[248px]">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      <div class="col-span-12 flex items-center justify-between py-6 pb-[30px] md:pb-[40px] xl:pb-[34px]">
        <!-- Previous post -->
        <div class="flex items-center gap-3">
          <?php previous_post_link(
            '<span class="text-xs uppercase tracking-wide text-dark/70">← %link</span>',
            esc_html__('Previous post', 'ale')
          ); ?>
        </div>

        <!-- Next post -->
        <div class="flex items-center gap-3">
          <?php next_post_link(
            '<span class="text-xs uppercase tracking-wide text-dark/70">%link →</span>',
            esc_html__('Next post', 'ale')
          ); ?>
        </div>
      </div>
      <div class="col-span-5 col-start-1">
      <?php do_action('breadcrumbs'); ?>
      </div>
      <div class="col-start-6 col-span-1">
        <p class="text-xs uppercase tracking-wide text-dark/70">Tags</p>
      </div>
      <div class="col-start-9 pb-[16px] md:pb-[22px] xl:pb-[25px]">
        <p class="text-xs uppercase tracking-wide text-dark/70">Categories</p>
      </div>
      <div class="col-start-1 col-span-9">
        <?php 
        if ( has_post_thumbnail() ) {
            the_post_thumbnail('full', ['class' => 'w-full h-auto object-cover']);
        }
        ?>
      </div>
      <div class="col-start-10 col-span-3">
        <p class="text-xs uppercase tracking-wide text-dark/70">related posts</p>
    </div>
  </div>
</section>