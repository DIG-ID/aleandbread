<div class="mega-menu-wrapper bg-dark absolute top-[82px] md:top-[102px] xl:top-[104px] left-0 bottom-0 z-30 w-full h-0 overflow-scroll xl:overflow-hidden transition-all duration-500 ease-in-out xl:flex xl:justify-center">
  <div class="theme-container pb-12 xl:pb-0">
    <div class="mega-menu-content theme-grid gap-y-10 pt-12 md:pt-12 xl:pt-40 pb-20 px-[10%]">
      <!-- LEFT COLUMN -->
      <div class="col-span-2 md:col-span-6 xl:col-span-4 xl:col-start-3">
        <h2 class="text-[#CBCBCB]">
        <?php
        wp_nav_menu([
          'theme_location' => 'mega-left',  
          'container'      => false,
          'menu_class'     => 'flex flex-col space-y-2 xl:space-y-4',
          'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'fallback_cb'    => '__return_false',
        ]);
        ?>
        </h2>
      </div>

      <!-- MIDDLE COLUMN -->
      <div class="col-span-2 md:col-span-6 xl:col-span-2 xl:col-start-7">
        <h2 class="text-[#CBCBCB]">
        <?php
        wp_nav_menu([
          'theme_location' => 'mega-middle',
          'container'      => false,
          'menu_class'     => 'flex flex-col space-y-2 xl:space-y-4',
          'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'fallback_cb'    => '__return_false',
        ]);
        ?>
        </h2>
      </div>

<!-- RIGHT COLUMN (account section, with standalone divider) -->
<div class="col-span-2 md:col-span-6 xl:col-span-4 xl:col-start-9 flex -ml-5 xl:ml-0">
  
  <!-- Divider -->
  <div class="block mt-[10px] md:mt-[19px] w-[3px] h-[71px] md:h-[106px] bg-accent"></div>
  
  <!-- Menu content -->
  <div class="pl-4 border-accent">
    <h2 class="text-[#CBCBCB]">
      <?php
      wp_nav_menu([
        'theme_location' => 'mega-right',
        'container'      => false, 
        'menu_class'     => 'flex flex-col space-y-2 xl:space-y-4 text-[#CBCBCB]',
        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'fallback_cb'    => '__return_false',
      ]);
      ?>
    </h2>
  </div>

</div>
  </div>
</div>