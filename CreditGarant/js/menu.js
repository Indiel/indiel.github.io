'use strict';

(function () {

    var hamburger = document.querySelector(".hamburger");
    var mainNav = document.querySelector(".main-nav");
    var mainNavList = document.querySelector(".main-nav__list");

    if (document.documentElement.clientWidth > 576 && document.documentElement.clientWidth <= 1200) {

        hamburger.addEventListener("click", function() {
            hamburger.classList.toggle("is-active");
            mainNavList.classList.toggle("main-nav__list--active");
        });
    }

    if (document.documentElement.clientWidth <= 576) {

        hamburger.addEventListener("click", function() {
            hamburger.classList.toggle("is-active");
            mainNav.classList.toggle("main-nav--active");
        });
    
        window.addEventListener('resize', () => {
            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        });
    }

})();