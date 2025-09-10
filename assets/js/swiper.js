import Swiper from 'swiper/bundle';

window.addEventListener("load", () => {
  // Homepage Hero Swiper
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

  // Distellerie Craftmanship Gallery
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

  // Events Swiper (mobile, tablet, desktop)
  if (document.querySelector('.events-unified-swiper')) {
    new Swiper('.events-unified-swiper', {
      loop: false,
      spaceBetween: 20,
      navigation: {
        nextEl: '.swiper-button-next-2',
        prevEl: '.swiper-button-prev-2',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
          grid: {
            rows: 3,
            fill: 'row',
          },
        },
        768: {
          slidesPerView: 1.25,
          grid: {
            rows: 1,
          },
        },
        1280: {
          slidesPerView: 3,
          slidesPerGroup: 3,
          grid: {
            rows: 1,
          },
          pagination: {
            el: '.events-pagination',
            type: 'custom',
            clickable: true,
            renderCustom: function (swiper, current, total) {
              let output = '';
              if (current > 1) output += pageButton(current - 1, current);
              output += pageButton(current, current);
              if (current < total) output += pageButton(current + 1, current);
              if (current < total - 1) {
                output += `<span class="pagination-separator" aria-hidden="true"></span>`;
                output += pageButton(total, current);
              }
              return output;
            }
          }
        }
      }
    });

    // Pagination bullet helper
    function pageButton(index, current) {
      const padded = index.toString().padStart(2, '0');
      const isActive = index === current;
      const baseClass = 'swiper-pagination-bullet';
      const activeClass = isActive ? 'swiper-pagination-bullet-active' : '';
      return `<span class="${baseClass} ${activeClass}">${padded}</span>`;
    }
  }

  // Our Experience Swiper
  if (document.querySelector('.our-experience-swiper')) {
    new Swiper('.our-experience-swiper', {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 20,
      navigation: {
        nextEl: '.swiper-button-next-3',
        prevEl: '.swiper-button-prev-3',
      },
    });
  }

  // Testimonials Swiper
  if (document.querySelector(".post-type-archive-product")) {
    new Swiper('.testimonialsSwiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      grabCursor: true,
      loop: true,
      navigation: {
        nextEl: ".testimonials-swiper-button-next",
        prevEl: ".testimonials-swiper-button-prev",
      },
      breakpoints: {
        640: { slidesPerView: 1 },
        768: { slidesPerView: 1.15 },
        1024: { slidesPerView: 3.15 },
      },
      autoplay: {
        delay: 2500,
        disableOnInteraction: true,
      },
    });
  }
});

// Accordion FAQ functionality
document.addEventListener('DOMContentLoaded', function () {
  const accordionItems = document.querySelectorAll('[data-accordion]');
  accordionItems.forEach((item) => {
    const header = item.querySelector('.toggle-header');
    const content = item.querySelector('.accordion-content');
    const icon = item.querySelector('.toggle-icon');
    const questionText = item.querySelector('.faq-question');

    header.addEventListener('click', () => {
      const isOpen = !content.classList.contains('hidden');
      accordionItems.forEach((el) => {
        const contentEl = el.querySelector('.accordion-content');
        const iconEl = el.querySelector('.toggle-icon');
        const textEl = el.querySelector('.faq-question');
        contentEl.classList.add('hidden');
        contentEl.style.maxHeight = null;
        iconEl.textContent = '+';
        iconEl.classList.remove('text-accent');
        iconEl.classList.add('text-dark');
        textEl.classList.remove('text-accent');
        textEl.classList.add('text-dark');
      });

      if (!isOpen) {
        content.classList.remove('hidden');
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.textContent = '-';
        icon.classList.remove('text-dark');
        icon.classList.add('text-accent');
        questionText.classList.remove('text-dark');
        questionText.classList.add('text-accent');
      }
    });
  });
});