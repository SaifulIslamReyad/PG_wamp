document.addEventListener("DOMContentLoaded", function () {
  ////// Preloader
  window.addEventListener("load", function () {
    console.log("hello world");
    const preloader = document.getElementById("preloader");
    if (preloader) {
      setTimeout(() => {
        preloader.style.visibility = "hidden";
        preloader.style.opacity = "0";
      }, 350);
    }
  });

  ////// Sticky Menu
  const header = document.getElementById("header");
  function myFunction() {
    if (window.scrollY >= 50) {
      header.classList.add("is-sticky");
    } else {
      header.classList.remove("is-sticky");
    }
  }

  ////// Back to Top
  const showOnPx = 100;
  const backToTopButton = document.querySelector(".back-to-top");
  const goToTop = () => {
    document.body.scrollIntoView({
      behavior: "smooth",
    });
  };

  document.addEventListener("scroll", () => {
    const scrollPosition = window.pageYOffset;
    if (backToTopButton) {
      if (scrollPosition >= showOnPx) {
        backToTopButton.classList.remove("hidden");
      } else {
        backToTopButton.classList.add("hidden");
      }
    }

    // sticky header
    if (header) {
      myFunction();
    }
  });

  if (backToTopButton) {
    backToTopButton.addEventListener("click", goToTop);
  }

  ////// Tabs
  const tabItemList = document.querySelectorAll(".tab__item");
  const tabContentList = document.querySelectorAll(".tab__content");

  tabItemList.forEach((item, index) => {
    item.addEventListener("click", function () {
      tabItemList.forEach((tabItem) => {
        tabItem.classList.remove("active");
      });
      tabContentList.forEach((contentItem) => {
        contentItem.classList.remove("active");
      });
      item.classList.add("active");
      tabContentList[index].classList.add("active");
    });
  });

  ////// Mobile Menu
  const mobileBtn = document.querySelector(".header__mobile-btn");
  const navMenu = document.querySelector(".navbar");

  if (mobileBtn && navMenu) {
    mobileBtn.addEventListener("click", () => {
      mobileBtn.classList.toggle("is-active");
      navMenu.classList.toggle("is-active");
    });
  }
});
