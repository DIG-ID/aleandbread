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

  // Swiper #3 — Events Mobile Swiper (1 slide = 3 events in grid)
  if (document.querySelector('.mobile-event-swiper')) {
    new Swiper('.mobile-event-swiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: false,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  }

  // Swiper #4 — Events Tablet Swiper (1.25 cards per slide)
  if (document.querySelector('.tablet-event-swiper')) {
    new Swiper('.tablet-event-swiper', {
      slidesPerView: 1.25,
      spaceBetween: 24,
      loop: false,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  }

// Swiper #5 — Events Desktop Swiper (3 slides per view)
if (document.querySelector('.desktop-event-swiper')) {
  new Swiper('.desktop-event-swiper', {
    slidesPerView: 3,
    slidesPerGroup: 3,
    spaceBetween: 30,
    loop: false,
    navigation: {
      nextEl: '.swiper-button-next-2',
      prevEl: '.swiper-button-prev-2',
    },
    pagination: {
      el: '.swiper-pagination-numbers',
      type: 'custom',
      clickable: true,
      renderCustom: function (swiper, current, total) {
        let output = '';

        // Show previous page
        if (current > 1) {
          output += pageButton(current - 1, current);
        }

        // Show current page
        output += pageButton(current, current);

        // Show next page
        if (current < total) {
          output += pageButton(current + 1, current);
        }

        // Separator and last page
        if (current < total - 1) {
          output += `<span class="pagination-separator" aria-hidden="true"></span>`;
          output += pageButton(total, current);
        }

        return output;
      }
    }
  });

  // Define pageButton helper
  function pageButton(index, current) {
    const padded = index.toString().padStart(2, '0');
    const isActive = index === current;
    const baseClass = 'swiper-pagination-bullet';
    const activeClass = isActive ? 'swiper-pagination-bullet-active' : '';
    return `<span class="${baseClass} ${activeClass}">${padded}</span>`;
  }
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
// Accordion functionality for FAQ page 
document.addEventListener('DOMContentLoaded', function () {
  const accordionItems = document.querySelectorAll('[data-accordion]');

  accordionItems.forEach((item) => {
    const header = item.querySelector('.toggle-header');
    const content = item.querySelector('.accordion-content');
    const icon = item.querySelector('.toggle-icon');
    const questionText = item.querySelector('.faq-question');

    header.addEventListener('click', () => {
      const isOpen = !content.classList.contains('hidden');

      // Close all
      accordionItems.forEach((el) => {
        const contentEl = el.querySelector('.accordion-content');
        const iconEl = el.querySelector('.toggle-icon');
        const textEl = el.querySelector('.faq-question');

        contentEl.classList.add('hidden');
        contentEl.style.maxHeight = null;
        iconEl.textContent = '+';
        textEl.classList.remove('text-accent');
        textEl.classList.add('text-dark');
      });

      // Open current
      if (!isOpen) {
        content.classList.remove('hidden');
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.textContent = '-';
        questionText.classList.remove('text-dark');
        questionText.classList.add('text-accent');
      }
    });
  });
});

if (document.querySelector('.our-experience-swiper')) {
  console.log("Found .our-experience-swiper");
  new Swiper('.our-experience-swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
      nextEl: '.swiper-button-next-2',
      prevEl: '.swiper-button-prev-2',
    },
  });
}