'use strict';

(function () {

    var menuButton = document.querySelector('.menu-button');

    var mainNav = document.querySelector('.main-nav__wrapper');

    menuButton.addEventListener('click', () => {
        menuButton.classList.toggle('is-active');
        mainNav.classList.toggle('visually-hidden');
    });

    // if (document.documentElement.clientWidth > 576) {
    //     openMenuButton.addEventListener('click', () => {
    //         // mainNav.classList.add('main-nav--active');
    //         // logoWrapper.classList.add('main-nav__logo-wrapper--active');
    //         // logo.classList.remove('visually-hidden');
    //         // logoSign.classList.add('visually-hidden');
    //         // mainNavWrapper.classList.remove('visually-hidden');
    
    //         // langLinkCurrent.classList.remove('visually-hidden');
    
    //         mainNav.classList.toggle('main-nav--active');
    //         logoWrapper.classList.toggle('main-nav__logo-wrapper--active');
    //         logo.classList.toggle('visually-hidden');
    //         logoSign.classList.toggle('visually-hidden');
    //         mainNavWrapper.classList.toggle('visually-hidden');
    
    //         // langLinkCurrent.classList.toggle('visually-hidden');
    
    //         openMenuButton.classList.toggle('close-menu-button');
    //         menuButtonTextOpen.classList.toggle('visually-hidden');
    //         menuButtonTextClose.classList.toggle('visually-hidden');
    
    //         // openMenuButton.classList.add('visually-hidden');
    //         // closeMenuButton.classList.remove('visually-hidden');
    //     });
    //     // main.addEventListener('click', () => {
    //     //     mainNav.classList.toggle('main-nav--active');
    //     //     logoWrapper.classList.toggle('main-nav__logo-wrapper--active');
    //     //     logo.classList.toggle('visually-hidden');
    //     //     logoSign.classList.toggle('visually-hidden');
    //     //     mainNavWrapper.classList.toggle('visually-hidden');
    
    //     //     openMenuButton.classList.toggle('close-menu-button');
    //     //     menuButtonTextOpen.classList.toggle('visually-hidden');
    //     //     menuButtonTextClose.classList.toggle('visually-hidden');
    //     // });
    // } else {
    //     logoSign.classList.add('visually-hidden');
    //     logo.classList.remove('visually-hidden');

    //     menuButtonTextOpen.classList.add('visually-hidden');
    //     menuButtonTextClose.classList.add('visually-hidden');

    //     // langList.classList.add('visually-hidden')
    //     // langLinkCurrent.classList.remove('visually-hidden');

    //     mainNavWrapper.classList.remove('visually-hidden');
        
    //     hamburger.addEventListener("click", function() {
    //         hamburger.classList.toggle("is-active");

    //         // mainNav.classList.toggle('main-nav--active');
    //         // logoWrapper.classList.toggle('main-nav__logo-wrapper--active');
    //         mainNavWrapper.classList.toggle('main-nav__wrapper--active');
    //         // mainNavWrapper.classList.toggle('visually-hidden');
            
    //         // langList.classList.toggle('visually-hidden');

    //         document.querySelector("body").classList.toggle("none-scroll");

    //         Array.from(navListLink).forEach((elem) => {
    //             elem.addEventListener("click", function () {
    //                 hamburger.classList.remove("is-active");
    //                 mainNavWrapper.classList.remove('main-nav__wrapper--active');
    //                 // langList.classList.add('visually-hidden');
    //                 document.querySelector("body").classList.remove("none-scroll");
    //             });
    //         });
    //     });

    //     window.addEventListener('resize', () => {
    //         let vh = window.innerHeight * 0.01;
    //         document.documentElement.style.setProperty('--vh', `${vh}px`);
    //     });
    // }


})();

