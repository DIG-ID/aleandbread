<header id="header-main" class="header-main transition-all duration-300 relative w-full z-50 pt-7 xl:border-b-[3px] xl:border-accent" itemscope itemtype="http://schema.org/WebSite">
  <nav class="navbar relative z-40" role="navigation" aria-label="<?php esc_attr_e( 'Main menu', 'aleandbread' ); ?>">
    <div class="theme-container ">
    <div class="header-wrapper grid grid-cols-3 items-center pb-4">
      <!-- Left: Burger + Menü + Language -->
      <div class="flex items-center">
        <div class="menu-toggle-wrapper">
          <button id="megaToggle" class="menu-toggle" aria-label="Menu">
            <span class="menu-toggle__bars">
              <span class="bar bar--top"></span>
              <span class="bar bar--middle"></span>
              <span class="bar bar--bottom"></span>
            </span>
            <span class="menu-label ml-1 uppercase hidden md:block"><?php esc_html_e( 'MENÜ', 'aleandbread' ) ?></span>
          </button>
        </div>
        <div class="!hidden items-center gap-4">
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
          <div class="relative min-h-[37px] flex items-end" x-data="{ open: false }">
            <!-- User Icon Button -->
            <button
              id="user-menu-button"
              @click="open = !open"
              class="flex items-center gap-2 z-40 relative focus:outline-none"
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
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0"
              x-cloak
              id="user-menu"
              role="menu"
              aria-labelledby="user-menu-button"
              class="absolute left-1/2 -translate-x-[90%] -top-2 mt-0 w-[270px] bg-dark text-accent shadow-lg z-30 origin-top"
            >

              <?php
              $current_user = wp_get_current_user();
              if ( is_user_logged_in() && function_exists( 'wc_get_account_menu_items' ) ) :
                $endpoints = wc_get_account_menu_items();
              ?>
                <p class="font-barlow text-[20px] leading-[28px] bg-dark text-accent font-bold text-left mb-2 pl-5 pr-16 pt-5 pb-6">
                  Hi, <?php echo esc_html( $current_user->first_name ); ?>
                </p>
                <ul class="space-y-1 pb-5">
                  <?php foreach ( $endpoints as $endpoint => $label ) : ?>
                    <li role="menuitem">
                      <a
                        href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
                        class="block font-barlow text-[20px] leading-[28px] text-accent font-normal hover:underline px-5 py-2"
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
          <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="flex items-end gap-2 min-h-[37px] z-40 relative focus:outline-none">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/user.svg" alt="Login" />
          </a>
        <?php endif; ?>

        <!-- Cart and Shop -->
        <div class="relative min-h-[37px] flex items-end" x-data="{ cartOpen: false }" id="header-cart-area">
          <button
            type="button"
            id="cart-toggle"
            class="z-50 relative"
            @click="cartOpen = !cartOpen"
            aria-label="Toggle cart"
          >
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svgs/cart.svg" alt="Cart" />
          </button>

          <!-- Wrap dropdown in a container to manage @click.outside -->
          <div
            x-show="cartOpen"
            @click.outside="cartOpen = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
            class="absolute left-1/2 -translate-x-[87%] -top-2 mt-0 w-[270px] bg-dark text-accent shadow-lg z-40 origin-top"
          >
            <div class="bg-dark text-yellow-600 shadow-lg">
              <p class="font-barlow text-[20px] leading-[28px] bg-dark text-accent font-bold text-left mb-2 pl-5 pr-16 pt-5 pb-6">
                <?php esc_html_e('Ihr Warenkorb','aleandbread') ?>
              </p>
              <div class="px-5 pt-0 pb-5">
                <div class="widget_shopping_cart_content">
                  <?php woocommerce_mini_cart(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>



        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn-secondary ml-2 !hidden xl:!flex">
          <?php esc_html_e( 'ZUM SHOP', 'aleandbread' ); ?>
        </a>

    </div>
  </nav>
  <?php get_template_part( 'template-parts/mega-menu' ); ?>
</header>
