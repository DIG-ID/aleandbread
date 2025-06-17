<section class="section-hero pt-0 pb-0"> 
    <?php 
        $section_hero = get_field('section_hero_gallery');

        if( $section_hero ): 
    ?>
        <div class="swiper h-screen w-screen overflow-hidden">
            <div class="swiper-wrapper">
                <?php 
                foreach($section_hero as $image_id):

                    $image_url = wp_get_attachment_image_url($image_id, 'full'); 
                ?>
                    <div class="swiper-slide bg-cover bg-center" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>