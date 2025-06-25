import Swiper from 'swiper/bundle';

window.addEventListener("load", () => {
    // Swiper #1 — Homepage Hero
    if (document.querySelector(".page-template-page-home")) {
        new Swiper('.swiper', {
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

    // Swiper #2 — Distellerie Craftmanship Gallery
    if (document.querySelector(".page-template-page-distellerie")) {
        new Swiper('.craftmanship-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 0,
            loop: true,
            speed: 4000,
            grabCursor: true,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            freeMode: true,
            freeModeMomentum: false,
            allowTouchMove: true,
            mousewheel: {
                forceToAxis: true,
                releaseOnEdges: true,
            },
        });
    }
});