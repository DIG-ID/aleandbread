<section id="newsletter" class="newsletter bg-dark ">
  <div class="theme-container">
    <div class="theme-grid">

      <div class="col-start-1 md:col-start-1 xl:col-start-1 col-span-2 md:col-span-5 xl:col-span-4">
        <p class="over-title text-accent"><?php echo get_field('newsletter_overtitle'); ?></p>
        <h1 class="text-blockTextLight pt-8 pb-8 col-span-2">
          <?php echo get_field('newsletter_title'); ?>
        </h1>
        <p class="text-blockTextLight block-text text-base md:text-lg leading-normal pb-[73px] md:pb-20 xl:pb-72">
          <?php echo get_field('newsletter_description'); ?>
        </p>

        
      </div>
    </div>
  </div>
</section>