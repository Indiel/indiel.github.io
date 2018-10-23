'use strict';

(function () {

    var hamburger = document.querySelector(".hamburger");
    var mainNav = document.querySelector(".main-nav");

    if (document.documentElement.clientWidth <= 576) {
        mainNav.classList.add('visually-hidden');

        hamburger.addEventListener("click", function() {
            hamburger.classList.toggle("is-active");
            mainNav.classList.toggle("visually-hidden");
    
            // mainNavWrapper.classList.toggle('main-nav__wrapper--active');
    
            // document.querySelector("body").classList.toggle("none-scroll");
    
            // Array.from(navListLink).forEach((elem) => {
            //     elem.addEventListener("click", function () {
            //         hamburger.classList.remove("is-active");
            //         mainNavWrapper.classList.remove('main-nav__wrapper--active');
            //         // langList.classList.add('visually-hidden');
            //         document.querySelector("body").classList.remove("none-scroll");
            //     });
            // });
        });
    
        window.addEventListener('resize', () => {
            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        });
    }

})();