// wait until DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  //wait until images, links, fonts, stylesheets, and js is loaded
  window.addEventListener("load", () => {

    /* Make header sticky on*/
    const header = $('#header-main');
    let lastScroll = 0;

    $(window).on('scroll', function () {
      const currentScroll = window.pageYOffset;

      // Blur in on scroll down
      if (currentScroll > 100 && !header.hasClass('sticky')) {
        header.addClass('sticky');
      }

      // Blur out on scroll back up
      if (currentScroll <= 100 && header.hasClass('sticky')) {
        header.removeClass('sticky');
      }

      lastScroll = currentScroll;
    });


    /* Set mega-menu height */
    const megaMenu = document.querySelector('.mega-menu-wrapper');
    let navHeight = '';

    if (window.innerWidth > 1280) {
    navHeight = 0; // Desktop nav height
    } else {
    navHeight = 0; // Mobile nav height
    }

    function setElementHeight() {
    const fullHeight = window.innerHeight - navHeight;
    const height = fullHeight * 0.7; // Set % of the original space
    megaMenu.style.setProperty('--element-height', `${height}px`);
    }

    setElementHeight();
    window.addEventListener('resize', setElementHeight);

    /* Hamburger toggle */
    const $toggleBtn = $('.menu-toggle');

    $toggleBtn.on('click', (e) => {
        $('#header-main').toggleClass('mega-menu-open');
    });


  }, false);
});

