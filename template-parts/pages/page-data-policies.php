<section id="page-default" class="page-default relative overflow-hidden bg-background pb-16 md:pb-16 xl:pb-32 pt-36 md:pt-44 xl:pt-52">
    <div class="theme-container relative">
        <div class="theme-grid pb-[16px] md:pb-[25px]">
            <div class="col-span-2 md:col-span-6 xl:col-span-12">
                <?php do_action('breadcrumbs'); ?>
            </div>
            <div class="col-span-2 md:col-span-6 xl:col-span-12 pb-[21px] md:pb-[58px] xl:pb-">
                <h1 class="text-dark"><?php the_title(); ?></h1>
            </div>
        </div>

        <div class="theme-grid gap-x-8 page-content">
            <div class="col-span-2 md:col-span-6 xl:col-span-7">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>