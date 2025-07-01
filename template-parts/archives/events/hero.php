<section id="events" class="events relative overflow-hidden bg-background pb-[55px] md:pb-[92px] xl:pb-[192px] xl:pt-[280px] md:pt-[194px] pt-[152px]">
  <div class="theme-container relative z-10">
    <div class="theme-grid">
      <div class="col-start-1 col-span-1 md:col-span-3 xl:col-start-2 xl:col-span-2 pb-[30px] md:pb-[56px] xl:pb-[58px] w-full">
            <?php do_action('breadcrumbs'); ?>
        </div>
        <div class="col-start-1 col-span-2 md:col-span-5 xl:col-start-2 xl:col-span-4">
            <h1 class="text-dark"><?php echo get_field('events_title', 'option'); ?></h1>
        </div> 
          
            <div class="col-start-1 col-span-2 md:col-span-4 xl:col-start-8 xl:col-span-4 pt-[48px] md:pt-[56px] xl:pt-0">
            <p class="text-dark block-text w-[342px] md:w-[438px] xl:w-full"><?php echo get_field('events_description', 'option'); ?></p> 
        </div> 
    </div>
  </div>
</section>