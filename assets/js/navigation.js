/* globals jQuery */
(function ($) {
  document.addEventListener('DOMContentLoaded', function () {
    const $header = $('#header-main');
    const $toggle = $('#megaToggle'); 
    const $menu   = $('.mega-menu-wrapper');

    if (!$toggle.length || !$menu.length) return;

    // ----- Sticky header  -----
    $(window).on('scroll', function () {
      const y = window.pageYOffset || document.documentElement.scrollTop;
      if (y > 100) $header.addClass('sticky');
      else $header.removeClass('sticky');
    });

    // ----- Dynamic mega menu height -----
    const setElementHeight = () => {
      const navHeight = 0; 
      const height = (window.innerHeight - navHeight) * 0.7;
      $menu[0].style.setProperty('--element-height', `${height}px`);
    };
    setElementHeight();
    window.addEventListener('resize', setElementHeight);

    // ----- Open / close -----
    $toggle.on('click', function (e) {
      e.stopPropagation();
      $header.toggleClass('mega-menu-open');
    });

    // clicks inside menu do not close it
    $menu.on('click', function (e) {
      e.stopPropagation();
    });

    // clicks anywhere else close it
    $(document).on('click', function () {
      $header.removeClass('mega-menu-open');
    });

    // Esc closes it too
    $(document).on('keydown', function (e) {
      if (e.key === 'Escape') $header.removeClass('mega-menu-open');
    });
  });
})(jQuery);