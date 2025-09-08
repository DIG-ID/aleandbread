<footer id="footer-main" class="footer-main relative w-full" itemscope itemtype="http://schema.org/WebSite">
    <div class="footer-info-bar bg-accent">
        <div class="theme-container">
            <div class="theme-grid">
                <div class="col-span-2 md:col-span-5 xl:col-span-12 flex flex-row justify-center">
                    <?php 
                    $email = get_field('email', 'option');
                    if ($email): ?>
                        <a href="mailto:<?php echo esc_html($email); ?>" class="flex items-center py-10">
                            <img class="w-auto h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/email.svg" alt="Email" title="Email"/>
                            <h3 class="text-dark pl-[16px] mb-[4px]"><?php echo esc_html($email); ?></h3>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-content py-14 mb:pt-20 mb:pb-24 xl:pt-24 xl:pb-20 bg-dark">
         <div class="theme-container">
            <div class="theme-grid">
                <div class="col-span-2 md:col-span-6 xl:col-span-3">
                    <div class="logo mb-9 md:mb-10 xl:mb-11">
                        <a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand custom-logo-link">
                            <?php 
                            $image = get_field('theme_logo', 'option');
                            $size = 'full'; // (thumbnail, medium, large, full or custom size)
                            $classes = 'w-[207px]';
                            if( $image ) {
                                echo wp_get_attachment_image( $image, $size, false, array('class' => $classes) );
                            }?>
                        </a>
                    </div>
                    <p class="block-text text-accent xl:max-w-52"><?php echo get_field( 'copyright', 'option' ); ?></p>
                    <div class="socials-devs hidden xl:block">
                        <p class="mb-4 block-text-bold text-accent pt-11 md:pt-24"><?php esc_html_e( 'Folgen Sie uns', 'aleandbread' ); ?></p>
                        <?php do_action( 'socials' ); ?>
                        <p class="mb-3 pt-11 md:pt-28 block-text-bold text-accent"><?php esc_html_e( 'Developed by:', 'aleandbread' ); ?></p>
                        <a href="https://dig.id" class="block-text text-accent underline"><?php esc_html_e( 'dig.id', 'aleandbread' ); ?></a>
                    </div>
                </div>
                <div class="col-span-1 md:col-span-3 xl:col-span-3">
                    <p class="mb-2 block-text-bold text-accent"><?php esc_html_e( 'Ale & Bread', 'aleandbread' ); ?></p>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu-ale',
                            'container'      => false,
                            'menu_class'     => 'footer-menu-nav',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'fallback_cb'    => '__return_false',
                        )
                    );
                    ?>
                    <p class="mb-2 block-text-bold text-accent xl:pt-11"><?php esc_html_e( 'Shop', 'aleandbread' ); ?></p>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu-shop',
                            'container'      => false,
                            'menu_class'     => 'footer-menu-nav',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'fallback_cb'    => '__return_false',
                        )
                    );
                    ?>
                </div>
                <div class="col-span-1 md:col-span-3 xl:col-span-3">
                    <p class="mb-2 block-text-bold text-accent"><?php esc_html_e( 'Experiences', 'aleandbread' ); ?></p>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu-experience',
                            'container'      => false,
                            'menu_class'     => 'footer-menu-nav',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'fallback_cb'    => '__return_false',
                        )
                    );
                    ?>
                    <p class="mb-2 block-text-bold text-accent xl:pt-11"><?php esc_html_e( 'Support', 'aleandbread' ); ?></p>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu-support',
                            'container'      => false,
                            'menu_class'     => 'footer-menu-nav',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'fallback_cb'    => '__return_false',
                        )
                    );
                    ?>
                </div>
                <div class="col-span-2 md:col-span-6 xl:col-span-3 mt-14 md:mt-20 xl:mt-0">
                    <h3 class="text-accent mb-9"><?php echo get_field( 'newsletter_title', 'option' ); ?></h3>
                    <p class="block-text text-accent mb-8 md:mb-14 xl:mb-16"><?php echo get_field( 'newsletter_description', 'option' ); ?></p>
                    <?php 
                    $form_shortcode = get_field('newsletter_newsletter_shortcode', 'option');
                    echo do_shortcode($form_shortcode);
                    ?>
                </div>
            </div>
        </div>
    </div>

</footer>
