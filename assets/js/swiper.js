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

  // Events Swiper (mobile, tablet, desktop)// Events Swiper (mobile, tablet, desktop)
  if (document.querySelector('.events-unified-swiper')) {
    const swiper = new Swiper('.events-unified-swiper', {
      loop: false,
      spaceBetween: 20,

      navigation: {
        nextEl: '.swiper-button-next-2',
        prevEl: '.swiper-button-prev-2',
      },

      // ONE pagination element across all breakpoints
      pagination: {
        el: '.events-pagination',
        type: 'custom',
        clickable: true,   // we'll delegate clicks below
        renderCustom: function (swiper, current, total) {
          const pages = pageWindow(current, total, 3); // always show 3 numbers (or fewer if total<3)
          return pages.map(p => pageButton(p, current)).join('');
        }
      },

      breakpoints: {
        0: {
          slidesPerView: 1,
          grid: { rows: 3, fill: 'row' },  // mobile "page" is 3 items tall
        },
        768: {
          slidesPerView: 1.25,
          grid: { rows: 1 },
        },
        1280: {
          slidesPerView: 3,
          slidesPerGroup: 3,               // desktop "page" = 3 slides
          grid: { rows: 1 },
        }
      },

      on: {
        init(sw) { updateUI(sw); },
        afterInit(sw) { updateUI(sw); },
        slideChange(sw) { updateUI(sw); },
        resize(sw) { updateUI(sw); },
      }
    });

    // ---------- Helpers ----------

    // fixed-size window (scales to any total). center current; clamp to edges.
    function pageWindow(current, total, size = 3) {
      if (total <= size) return Array.from({ length: total }, (_, i) => i + 1);
      let start = current - Math.floor(size / 2);
      if (start < 1) start = 1;
      const maxStart = Math.max(1, total - size + 1); // ensures last window shows [n-2,n-1,n]
      if (start > maxStart) start = maxStart;
      return Array.from({ length: size }, (_, i) => start + i);
    }

    // pagination bullet HTML (keeps swiper classes for your styling)
    function pageButton(page, current) {
      const padded = page.toString().padStart(2, '0');
      const isActive = page === current;
      return `<button class="swiper-pagination-bullet ${isActive ? 'swiper-pagination-bullet-active' : ''}"
                      type="button"
                      data-page="${page}"
                      ${isActive ? 'aria-current="page"' : ''}>${padded}</button>`;
    }

    // arrow visibility + hide entire nav/pagination when only one page
    function updateUI(sw) {
      const prev = document.querySelector('.swiper-button-prev-2');
      const next = document.querySelector('.swiper-button-next-2');
      const pagEl = document.querySelector('.events-pagination');

      const totalPages = sw.snapGrid.length;         // true number of pages
      const currentPage = sw.snapIndex + 1;
      const multiPage = totalPages > 1;

      // Hide/show entire controls if there's less than a page
      if (pagEl) {
        pagEl.style.display = multiPage ? '' : 'none';
        pagEl.setAttribute('aria-hidden', multiPage ? 'false' : 'true');
      }
      if (prev) {
        prev.style.display = multiPage ? '' : 'none';
        prev.setAttribute('aria-hidden', multiPage ? 'false' : 'true');
      }
      if (next) {
        next.style.display = multiPage ? '' : 'none';
        next.setAttribute('aria-hidden', multiPage ? 'false' : 'true');
      }

      // Disable swipe if single page (nice UX)
      sw.allowTouchMove = multiPage;

      // If we *are* multi-page, also toggle arrows at the edges
      if (multiPage && prev && next) {
        prev.style.visibility = currentPage === 1 ? 'hidden' : 'visible';
        next.style.visibility = currentPage === totalPages ? 'hidden' : 'visible';
      }
    }

    // robust mapping: page -> slide index
    // special-case last page (may be a short group): jump to final slide.
    function targetSlideIndexForPage(sw, page) {
      const lastPage = sw.snapGrid.length;
      if (page >= lastPage) return sw.slides.length - 1; // last page = last slide

      const snapIdx = Math.min(page - 1, lastPage - 1);
      const snap = sw.snapGrid[snapIdx];

      // resolve slidesPerView (handles 'auto')
      const perView = typeof sw.params.slidesPerView === 'number'
        ? sw.params.slidesPerView
        : Math.max(1, Math.round(sw.slidesPerViewDynamic()));
      const lastStartIdx = Math.max(0, sw.slides.length - perView);

      // find first slide whose grid pos is >= snap (with epsilon)
      const EPS = 1e-3;
      let idx = -1;
      for (let i = 0; i < sw.slidesGrid.length; i++) {
        if (sw.slidesGrid[i] + EPS >= snap) { idx = i; break; }
      }
      if (idx === -1) idx = lastStartIdx;
      if (idx > lastStartIdx) idx = lastStartIdx;
      return idx;
    }

    // click-to-navigate for custom pagination (all breakpoints)
    const pagEl = document.querySelector('.events-pagination');
    if (pagEl) {
      pagEl.addEventListener('click', (e) => {
        const btn = e.target.closest('.swiper-pagination-bullet');
        if (!btn) return;
        const page = Number(btn.dataset.page);
        if (!page) return;

        const slideIndex = targetSlideIndexForPage(swiper, page);
        swiper.slideTo(slideIndex);
      });
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
      speed: 1200,
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
        delay: 3000,
        disableOnInteraction: true,
      },
    });
  }
});
