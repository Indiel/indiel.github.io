"use strict";

(function () {

    var smallSiteNav = document.querySelector('.small-site-nav');
    var sitaNav = document.querySelector('.site-nav');

    var smallUserNav = document.querySelector('.small-user-nav');
    var userNav = document.querySelector('.user-nav');

    smallSiteNav.addEventListener('click', () => {
        userNav.classList.remove('show-small-nav');
        sitaNav.classList.toggle('show-small-nav');
    });

    smallUserNav.addEventListener('click', () => {
        sitaNav.classList.remove('show-small-nav');
        userNav.classList.toggle('show-small-nav');
    });

})();