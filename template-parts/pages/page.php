<section id="page-default" class="page-default relative overflow-hidden bg-background pb-16 md:pb-16 xl:pb-32 pt-36 md:pt-44 xl:pt-52">
    <div class="theme-container relative">
        <div class="theme-grid pb-[16px] md:pb-[25px]">
            <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-5 xl:col-start-1">
                <?php do_action('breadcrumbs'); ?>
            </div>
        </div>

        <div class="theme-grid gap-x-8 page-content">
            <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-7 order-1 xl:order-none">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>