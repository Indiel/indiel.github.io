'use strict';

(function () {

    var openMenuButton = document.querySelector('.open-menu-button');
    var closeMenuButton = document.querySelector('.close-menu-button');

    var mainNav = document.querySelector('.main-nav');
    var logoWrapper = document.querySelector('.main-nav__logo-wrapper');
    var logo = document.querySelector('.logo');
    var logoSign = document.querySelector('.logo-sign');
    var mainNavWrapper = document.querySelector('.main-nav__wrapper');

    var langLinkCurrent = document.querySelector('.lang-list__link--current');

    openMenuButton.addEventListener('click', () => {
        mainNav.classList.add('main-nav--active');
        logoWrapper.classList.add('main-nav__logo-wrapper--active');
        logo.classList.remove('visually-hidden');
        logoSign.classList.add('visually-hidden');
        mainNavWrapper.classList.remove('visually-hidden');

        langLinkCurrent.classList.remove('visually-hidden');

        openMenuButton.classList.add('visually-hidden');
    });

    closeMenuButton.addEventListener('click', () => {
        mainNav.classList.remove('main-nav--active');
        logoWrapper.classList.remove('main-nav__logo-wrapper--active');
        logo.classList.add('visually-hidden');
        logoSign.classList.remove('visually-hidden');
        mainNavWrapper.classList.add('visually-hidden');

        langLinkCurrent.classList.add('visually-hidden');

        openMenuButton.classList.remove('visually-hidden');
    });

})();