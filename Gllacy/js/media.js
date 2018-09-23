"use strict";

(function () {

    var smallSiteNav = document.querySelector('.small-site-nav');
    var sitaNav = document.querySelector('.site-nav');

    var smallUserNav = document.querySelector('.small-user-nav');
    var userNav = document.querySelector('.user-nav');

    var spanAfter = document.querySelector('.after');
    var spanBefore = document.querySelector('.before');

    smallSiteNav.addEventListener('click', () => {
        userNav.classList.remove('show-small-nav');
        sitaNav.classList.toggle('show-small-nav');
    });

    smallUserNav.addEventListener('click', () => {
        sitaNav.classList.remove('show-small-nav');
        userNav.classList.toggle('show-small-nav');
        spanAfter.classList.toggle('rotate-after');
        spanBefore.classList.toggle('rotate-before');
    });

    window.addEventListener('resize', () => {
        if (document.documentElement.clientWidth > 900) {
            sitaNav.classList.remove('show-small-nav');
        }
        if (document.documentElement.clientWidth > 550) {
            userNav.classList.remove('show-small-nav');
        }
    });

    var filtersForm = document.querySelector('.filters-form');
    var buttonFilters = document.querySelector('.button-filters');
    
    buttonFilters.addEventListener('click', () => {
        filtersForm.classList.toggle('show-button');
    });

})();