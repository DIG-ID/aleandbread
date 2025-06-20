import Swiper from 'swiper/bundle';

window.addEventListener("load", () => {

    // Only run on homepage template
    if (document.querySelector(".page-template-page-home")) {

        const swiper = new Swiper('.swiper', {
            speed: 900, 
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