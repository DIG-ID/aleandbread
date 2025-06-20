<header id="header-main" class="header-main relative w-full z-50 pt-7" itemscope itemtype="http://schema.org/WebSite">
  <nav class="navbar relative" role="navigation" aria-label="<?php esc_attr_e( 'Main menu', 'aleandbread' ); ?>">
    <div class="theme-container">
    <div class="header-wrapper grid grid-cols-3 items-center xl:border-b-[3px] xl:border-accent pb-4">
      <!-- Left: Burger + Menü + Language -->
      <div class="flex items-center">
        <div class="menu-toggle-wrapper">
          <button class="menu-toggle" aria-label="Menu">
            <span class="menu-toggle__bars">
              <span class="bar"></span>
              <span class="bar"></span>
              <span class="bar"></span>
            </span>
          </button>
        </div>
        <div class="!hidden xl:!flex items-center gap-4">
            <span class="menu-label block-text-bold mr-10 -ml-2 text-background">MENÜ</span>
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
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/user.svg" alt="User" />
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/cart.svg" alt="Cart" />
        <a href="#" class="btn btn-secondary ml-2 !hidden xl:!flex ">ZUM SHOP</a>
      </div>

    </div>
  </nav>
</header>