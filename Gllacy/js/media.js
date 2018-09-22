"use strict";

(function () {

    var smallSiteNav = document.querySelector('.small-site-nav');
    var sitaNav = document.querySelector('.site-nav');

    var smallUserNav = document.querySelector('.small-user-nav');
    var userNav = document.querySelector('.user-nav');

    // var smallCatalogNav = document.querySelector('.site-nav a[href="catalog.html"]');
    // var catalogNav = document.querySelector('.site-nav-catalog');

    smallSiteNav.addEventListener('click', () => {
        userNav.classList.remove('show-small-nav');
        sitaNav.classList.toggle('show-small-nav');
    });

    smallUserNav.addEventListener('click', () => {
        sitaNav.classList.remove('show-small-nav');
        userNav.classList.toggle('show-small-nav');
    });

    // smallCatalogNav.addEventListener('click', evt => {
    //     if (document.documentElement.clientWidth <= 900) {
    //         evt.preventDefault();
    //         catalogNav.classList.toggle('show-small-nav');
    //     }
    // });

    // if (document.documentElement.clientWidth > 900) {
    //     catalogNav.classList.remove('show-small-nav');
    //     sitaNav.classList.remove('show-small-nav');
    // }

})();