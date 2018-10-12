'use strict';

(function () {

    var openMenuButton = document.querySelector('.open-menu-button');

    var menuButtonTextOpen = document.querySelector('.menu-button__text-open');
    var menuButtonTextClose = document.querySelector('.menu-button__text-close');


    var mainNav = document.querySelector('.main-nav');
    var logoWrapper = document.querySelector('.main-nav__logo-wrapper');
    var logo = document.querySelector('.logo');
    var logoSign = document.querySelector('.logo-sign');
    var mainNavWrapper = document.querySelector('.main-nav__wrapper');

    var langLinkCurrent = document.querySelector('.lang-list__link--current');

    openMenuButton.addEventListener('click', () => {
        mainNav.classList.toggle('main-nav--active');
        logoWrapper.classList.toggle('main-nav__logo-wrapper--active');
        logo.classList.toggle('visually-hidden');
        logoSign.classList.toggle('visually-hidden');
        mainNavWrapper.classList.toggle('visually-hidden');

        langLinkCurrent.classList.toggle('visually-hidden');

        openMenuButton.classList.toggle('close-menu-button');
        menuButtonTextOpen.classList.toggle('visually-hidden');
        menuButtonTextClose.classList.toggle('visually-hidden');
    });

})();

