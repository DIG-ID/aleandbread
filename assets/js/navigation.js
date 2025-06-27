// wait until DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  //wait until images, links, fonts, stylesheets, and js is loaded
  window.addEventListener("load", () => {

    /* Make header sticky on*/
    let header = $('#header-main');
    let lastScroll = 0; 
  
    $(window).on( 'scroll', function() {
      const currentScroll = window.pageYOffset;
      if ( currentScroll <= 0 ) {
        //console.log('current scroll is ' + currentScroll);
        header.removeClass( 'sticky' );
        return;
      } 
      if ( currentScroll > lastScroll && currentScroll > 0 && ! header.hasClass('sticky') ) {
        //down
        header.removeClass( 'sticky' );
        header.addClass( 'sticky' );
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