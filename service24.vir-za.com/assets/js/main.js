/**
* Portfolio interactions
*/
(function () {
  "use strict";

  const header = document.querySelector("#header");
  const headerToggleBtn = document.querySelector(".header-toggle");

  function headerToggle() {
    if (!header || !headerToggleBtn) return;
    header.classList.toggle("header-show");
    headerToggleBtn.classList.toggle("bi-list");
    headerToggleBtn.classList.toggle("bi-x");
  }

  if (headerToggleBtn) {
    headerToggleBtn.addEventListener("click", headerToggle);
  }

  document.querySelectorAll("#navmenu a").forEach((navLink) => {
    navLink.addEventListener("click", () => {
      if (header && header.classList.contains("header-show")) {
        headerToggle();
      }
    });
  });

  document.querySelectorAll(".navmenu .toggle-dropdown").forEach((dropdownToggle) => {
    dropdownToggle.addEventListener("click", function (event) {
      event.preventDefault();
      this.parentNode.classList.toggle("active");
      this.parentNode.nextElementSibling.classList.toggle("dropdown-active");
      event.stopImmediatePropagation();
    });
  });

  const scrollTop = document.querySelector(".scroll-top");

  function toggleScrollTop() {
    if (!scrollTop) return;
    window.scrollY > 100 ? scrollTop.classList.add("active") : scrollTop.classList.remove("active");
  }

  if (scrollTop) {
    scrollTop.addEventListener("click", (event) => {
      event.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  }

  window.addEventListener("load", toggleScrollTop);
  document.addEventListener("scroll", toggleScrollTop);

  function aosInit() {
    if (!window.AOS) return;
    AOS.init({
      duration: 600,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
  }

  window.addEventListener("load", aosInit);

  const typedElement = document.querySelector(".typed");
  if (typedElement && window.Typed) {
    const typedStrings = typedElement.getAttribute("data-typed-items").split(",").map((item) => item.trim());
    new Typed(".typed", {
      strings: typedStrings,
      loop: true,
      typeSpeed: 65,
      backSpeed: 35,
      backDelay: 1700
    });
  }

  if (window.PureCounter) {
    new PureCounter();
  }

  if (window.GLightbox) {
    GLightbox({
      selector: ".glightbox"
    });
  }

  document.querySelectorAll(".isotope-layout").forEach((isotopeItem) => {
    if (!window.Isotope || !window.imagesLoaded) return;

    const container = isotopeItem.querySelector(".isotope-container");
    if (!container) return;

    const layout = isotopeItem.getAttribute("data-layout") || "masonry";
    const filter = isotopeItem.getAttribute("data-default-filter") || "*";
    const sort = isotopeItem.getAttribute("data-sort") || "original-order";
    let initIsotope = null;

    imagesLoaded(container, () => {
      initIsotope = new Isotope(container, {
        itemSelector: ".isotope-item",
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll(".isotope-filters li").forEach((filterButton) => {
      filterButton.setAttribute("tabindex", "0");
      filterButton.setAttribute("role", "button");

      const applyFilter = () => {
        const activeFilter = isotopeItem.querySelector(".isotope-filters .filter-active");
        if (activeFilter) activeFilter.classList.remove("filter-active");
        filterButton.classList.add("filter-active");

        if (initIsotope) {
          initIsotope.arrange({
            filter: filterButton.getAttribute("data-filter")
          });
        }

        aosInit();
      };

      filterButton.addEventListener("click", applyFilter);
      filterButton.addEventListener("keydown", (event) => {
        if (event.key === "Enter" || event.key === " ") {
          event.preventDefault();
          applyFilter();
        }
      });
    });
  });

  function initSwiper() {
    if (!window.Swiper) return;

    document.querySelectorAll(".init-swiper").forEach((swiperElement) => {
      const configElement = swiperElement.querySelector(".swiper-config");
      if (!configElement) return;

      const config = JSON.parse(configElement.innerHTML.trim());
      new Swiper(swiperElement, config);
    });
  }

  window.addEventListener("load", initSwiper);

  window.addEventListener("load", () => {
    if (!window.location.hash) return;
    const section = document.querySelector(window.location.hash);
    if (!section) return;

    setTimeout(() => {
      const scrollMarginTop = getComputedStyle(section).scrollMarginTop;
      window.scrollTo({
        top: section.offsetTop - parseInt(scrollMarginTop, 10),
        behavior: "smooth"
      });
    }, 100);
  });

  const navmenuLinks = document.querySelectorAll('.navmenu a[href^="#"]');

  function navmenuScrollspy() {
    navmenuLinks.forEach((navmenuLink) => {
      const section = document.querySelector(navmenuLink.hash);
      if (!section) return;

      const position = window.scrollY + 220;
      if (position >= section.offsetTop && position <= section.offsetTop + section.offsetHeight) {
        document.querySelectorAll(".navmenu a.active").forEach((link) => link.classList.remove("active"));
        navmenuLink.classList.add("active");
      } else {
        navmenuLink.classList.remove("active");
      }
    });
  }

  window.addEventListener("load", navmenuScrollspy);
  document.addEventListener("scroll", navmenuScrollspy);
})();
