<div class="mega-menu-wrapper bg-dark absolute top-[82px] md:top-[102px] xl:top-[104px] left-0 bottom-0 z-30 w-full h-0 overflow-scroll xl:overflow-hidden transition-all duration-500 ease-in-out xl:flex xl:justify-center xl:items-center">
    <div class="theme-container">
        <div class="mega-menu-content theme-grid">
            <div class="col-span-2 md:col-span-6 xl:col-span-4 col-start-1 md:col-start-1 xl:col-start-3">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'main-menu',
                        'container'      => false,
                        'menu_class'     => 'mega-menu-nav mega-menu-top-level',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'fallback_cb'    => '__return_false',
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>