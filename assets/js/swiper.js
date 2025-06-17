import Swiper from 'swiper/bundle';

window.addEventListener("load", () => {
    if ( $(".page-template-page-home")[0] ) {
            const swiper = new Swiper('.swiper', {
            speed: 500, 
            loop: true,
            autoplay: {
                delay: 5000, 
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            spaceBetween: 0,
            effect: 'slide',
        });
    }

}, false);