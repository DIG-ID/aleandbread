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

  // Interactive Overlay Toggle — Gin Makes History
  const toggleBtn = document.getElementById("gin-toggle-btn");
  const overlay = document.getElementById("gin-overlay");
  const popup = document.getElementById("gin-popup");
  const title = document.getElementById("gin-title");

  if (toggleBtn && overlay && popup && title) {
    let isOpen = false;

    toggleBtn.addEventListener("click", () => {
      isOpen = !isOpen;

      if (isOpen) {
        overlay.style.background = "linear-gradient(0deg, #0D0D0D 0%, rgba(13,13,13,0.85) 50%, rgba(13,13,13,0.0) 65%)";

        popup.classList.remove("opacity-0", "pointer-events-none");
        popup.classList.add("opacity-100", "pointer-events-auto");

        title.classList.remove("text-background");
        title.classList.add("text-accent");
      } else {
        overlay.style.background = "none";

        popup.classList.add("opacity-0", "pointer-events-none");
        popup.classList.remove("opacity-100", "pointer-events-auto");

        title.classList.remove("text-accent");
        title.classList.add("text-background");
      }
    });
  }
});