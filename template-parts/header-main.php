<header id="header-main" class="header-main transition-all duration-300 relative w-full z-50 pt-7" itemscope itemtype="http://schema.org/WebSite">
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
      <div class="flex justify-end items-center gap-6">
        <?php if ( is_user_logged_in() ) : ?>
          <!-- Only this wrapper needs to be relative for dropdown positioning -->
          <div class="relative" x-data="{ open: false }">
            <!-- User Icon Button -->
            <button
              id="user-menu-button"
              @click="open = !open"
              class="flex items-center gap-2 focus:outline-none"
              :aria-expanded="open.toString()"
              aria-haspopup="true"
              aria-controls="user-menu"
            >
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/user.svg" alt="User Icon" />
            </button>

            <!-- Dropdown Menu -->
            <div
              x-show="open"
              @click.away="open = false"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95 -translate-y-2 origin-top"
              x-transition:enter-end="opacity-100 scale-100 translate-y-0"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100 scale-100 translate-y-0"
              x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
              x-cloak
              id="user-menu"
              role="menu"
              aria-labelledby="user-menu-button"
              class="absolute left-1/2 -translate-x-1/2 top-full mt-2 w-56 bg-black text-yellow-600 p-4 rounded shadow-lg z-50 transform origin-top"
            >
              <?php
              $current_user = wp_get_current_user();
              if ( is_user_logged_in() && function_exists( 'wc_get_account_menu_items' ) ) :
                $endpoints = wc_get_account_menu_items();
              ?>
                <p class="text-white font-bold mb-2">
                  Hi, <?php echo esc_html( $current_user->first_name ); ?>
                </p>
                <ul class="space-y-1">
                  <?php foreach ( $endpoints as $endpoint => $label ) : ?>
                    <li role="menuitem">
                      <a
                        href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
                        class="block text-sm font-semibold hover:underline"
                      >
                        <?php echo esc_html( $label ); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php else : ?>
                <p class="text-white">Account menu unavailable.</p>
              <?php endif; ?>
            </div>

          </div>
        <?php else : ?>
          <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="flex items-center gap-2">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/user.svg" alt="Login" />
          </a>
        <?php endif; ?>

        <!-- Cart and Shop -->
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/cart.svg" alt="Cart" />
        </a>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn-secondary ml-2 !hidden xl:!flex ">
          <?php esc_html_e( 'ZUM SHOP', 'aleandbread' ); ?>
        </a>
      </div>



    </div>
  </nav>
  <?php get_template_part( 'template-parts/mega-menu' ); ?>
</header>


        