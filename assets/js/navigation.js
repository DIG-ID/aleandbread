/* globals jQuery */
(function ($) {
  document.addEventListener('DOMContentLoaded', function () {
    const $header = $('#header-main');
    const $toggle = $('#megaToggle'); 
    const $menu   = $('.mega-menu-wrapper');

    if (!$toggle.length || !$menu.length) return;

    // ----- Dynamic mega menu height -----
    const setElementHeight = () => {
      const navHeight = 0; 
      const height = (window.innerHeight - navHeight) * 1;
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

// Sticky header 
(function($){
  $(function(){
    var $header = $('#header-main');
    if (!$header.length) return;

    // tweak: use a fixed threshold or the header height
    var THRESHOLD = 100; // or: $header.outerHeight();

    function apply() {
      if (window.pageYOffset > THRESHOLD) {
        $header.addClass('sticky');
      } else {
        $header.removeClass('sticky');
      }
    }

    // --- avoid transition on initial paint / refresh ---
    function applyWithoutTransition() {
      $header.addClass('no-transition');
      apply();
      // remove the no-transition flag next frame (double RAF for safety)
      requestAnimationFrame(function(){
        requestAnimationFrame(function(){
          $header.removeClass('no-transition');
        });
      });
    }

    // Initial state (on DOM ready)
    applyWithoutTransition();

    // Scroll / resize keep it in sync
    $(window).on('scroll.sticky', apply);
    $(window).on('resize.sticky', apply);

    // After all assets load (in case layout shifts), re-apply without anim
    $(window).on('load.sticky', applyWithoutTransition);

    // Handle bfcache restores (Safari/Firefox): pageshow with persisted = true
    $(window).on('pageshow.sticky', function(e){
      var ev = e.originalEvent;
      if (ev && ev.persisted) {
        applyWithoutTransition();
      } else {
        apply();
      }
    });
  });
})(jQuery);

