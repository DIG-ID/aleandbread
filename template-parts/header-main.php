<header id="header-main" class="header-main relative w-full z-50 pt-7" itemscope itemtype="http://schema.org/WebSite">
  <nav class="navbar relative z-40" role="navigation" aria-label="<?php esc_attr_e( 'Main menu', 'aleandbread' ); ?>">
    <div class="theme-container">
    <div class="header-wrapper grid grid-cols-3 items-center xl:border-b-[3px] xl:border-accent pb-4">
      <!-- Left: Burger + Menü + Language -->
      <div class="flex items-center">
        <div class="menu-toggle-wrapper">
          <button class="menu-toggle" aria-label="Menu">
            <span class="menu-toggle__bars">
              <span class="bar bar--top"></span>
              <span class="bar bar--middle"></span>
              <span class="bar bar--bottom"></span>
            </span>
            <span class="menu-label ml-1 uppercase"><?php esc_html_e( 'MENÜ', 'aleandbread' ) ?></span>
          </button>
        </div>
        <div class="!hidden xl:!flex items-center gap-4">
            <?php do_action( 'wpml_add_language_selector' ); ?>
        </div>
      </div>

      <!-- Center: Logo -->
      <div class="col-start-2 flex justify-center items-center">
        <div class="logo">
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
      </div>

      <!-- Right: Icons + Button -->
      <div class="flex justify-end items-center gap-6  ">
        <?php if ( is_user_logged_in() ) : ?>
            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>"><span class="hidden">Logout</span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/user.svg" alt="User" /></a>
        <?php else : ?>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><span class="hidden">Login</span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/user.svg" alt="User" /></a>
        <?php endif; ?>
        
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/cart.svg" alt="Cart" />
        </a>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn-secondary ml-2 !hidden xl:!flex "><?php esc_html_e( 'ZUM SHOP', 'aleandbread' ); ?></a>
      </div>

    </div>
  </nav>
  <?php get_template_part( 'template-parts/mega-menu' ); ?>
</header>