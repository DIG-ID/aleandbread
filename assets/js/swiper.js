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

  // Events Swiper (mobile, tablet, desktop)
  if (document.querySelector('.events-unified-swiper')) {
    // ---------- Shared helpers ----------

    // Fixed-size window (scales to any total). Center current; clamp to edges.
    function pageWindow(current, total, size = 3) {
      if (total <= size) return Array.from({ length: total }, (_, i) => i + 1);
      let start = current - Math.floor(size / 2);
      if (start < 1) start = 1;
      const maxStart = Math.max(1, total - size + 1);
      if (start > maxStart) start = maxStart;
      return Array.from({ length: size }, (_, i) => start + i);
    }

    // Pagination bullet HTML (keeps Swiper classes for styling)
    function pageButton(page, current) {
      const padded = page.toString().padStart(2, "0");
      const isActive = page === current;
      return `<button class="swiper-pagination-bullet ${isActive ? "swiper-pagination-bullet-active" : ""}"
                      type="button"
                      data-page="${page}"
                      ${isActive ? 'aria-current="page"' : ""}>${padded}</button>`;
    }

    // Arrow/pagination visibility + single-page handling (scoped)
    function updateUI(sw, els) {
      const { prev, next, pagEl } = els;

      const totalPages = sw.snapGrid.length; // true number of pages
      const currentPage = sw.snapIndex + 1;
      const multiPage = totalPages > 1;

      pagEl?.classList.toggle("is-hidden", !multiPage);
      prev?.classList.toggle("is-hidden", !multiPage);
      next?.classList.toggle("is-hidden", !multiPage);

      sw.allowTouchMove = multiPage;

      if (multiPage && prev && next) {
        prev.style.visibility = currentPage === 1 ? "hidden" : "visible";
        next.style.visibility = currentPage === totalPages ? "hidden" : "visible";
      } else {
        if (prev) prev.style.visibility = "hidden";
        if (next) next.style.visibility = "hidden";
      }
    }

    // Robust mapping: page -> slide index
    function targetSlideIndexForPage(sw, page) {
      const lastPage = sw.snapGrid.length;
      if (page >= lastPage) return sw.slides.length - 1;

      const snapIdx = Math.min(page - 1, lastPage - 1);
      const snap = sw.snapGrid[snapIdx];

      const perView =
        typeof sw.params.slidesPerView === "number"
          ? sw.params.slidesPerView
          : Math.max(1, Math.round(sw.slidesPerViewDynamic()));

      const lastStartIdx = Math.max(0, sw.slides.length - perView);

      const EPS = 1e-3;
      let idx = -1;
      for (let i = 0; i < sw.slidesGrid.length; i++) {
        if (sw.slidesGrid[i] + EPS >= snap) {
          idx = i;
          break;
        }
      }

      if (idx === -1) idx = lastStartIdx;
      if (idx > lastStartIdx) idx = lastStartIdx;
      return idx;
    }

    // ---------- Factory: init one swiper inside a scope ----------
    function initEventsUnifiedSwiper(scopeEl) {
      const swiperEl = scopeEl.querySelector(".events-unified-swiper");
      if (!swiperEl) return null;

      const els = {
        prev: scopeEl.querySelector(".swiper-button-prev-2"),
        next: scopeEl.querySelector(".swiper-button-next-2"),
        pagEl: scopeEl.querySelector(".events-pagination"),
      };

      const swiper = new Swiper(swiperEl, {
        loop: false,
        spaceBetween: 20,

        navigation: {
          nextEl: els.next,
          prevEl: els.prev,
        },

        pagination: {
          el: els.pagEl,
          type: "custom",
          clickable: true,
          renderCustom: function (sw, current, total) {
            const pages = pageWindow(current, total, 3);
            return pages.map((p) => pageButton(p, current)).join("");
          },
        },

        breakpoints: {
          0: {
            slidesPerView: 1,
            grid: { rows: 3, fill: "row" },
          },
          768: {
            slidesPerView: 1.25,
            grid: { rows: 1 },
          },
          1280: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            grid: { rows: 1 },
          },
        },

        on: {
          init(sw) { updateUI(sw, els); },
          afterInit(sw) { updateUI(sw, els); },
          slideChange(sw) { updateUI(sw, els); },
          resize(sw) { updateUI(sw, els); },
        },
      });

      // Click-to-navigate for custom pagination (scoped)
      if (els.pagEl) {
        els.pagEl.addEventListener("click", (e) => {
          const btn = e.target.closest(".swiper-pagination-bullet");
          if (!btn) return;

          const page = Number(btn.dataset.page);
          if (!page) return;

          const slideIndex = targetSlideIndexForPage(swiper, page);
          swiper.slideTo(slideIndex);
        });
      }

      return swiper;
    }

    // ---------- Init all instances ----------
    document.querySelectorAll(".events-swiper-scope").forEach(initEventsUnifiedSwiper);
  }

});
