'use strict';

(function () {

    var menuButton = document.querySelector('.menu-button');

    var mainNav = document.querySelector('.main-nav__wrapper');

    menuButton.addEventListener('click', () => {
        menuButton.classList.toggle('is-active');
        mainNav.classList.toggle('main-nav__wrapper--active');
    });

    // var btn = true;
    // $('.menu_btn').click(function () {
    //     $(this).closest('.menu').toggleClass('active');
    //     if ($('#fullpage').length > 0) {
    //         if ($('.menu').hasClass('active')) {
    //             $.fn.fullpage.setMouseWheelScrolling(false);
    //             $.fn.fullpage.setAllowScrolling(false);
    //         } else {
    //             $.fn.fullpage.setMouseWheelScrolling(true);
    //             $.fn.fullpage.setAllowScrolling(true);
    //         }
    //     }
    //     var popup = setTimeout(function () {
    //         $('.menu_list').slideDown(1500);
    //         btn = false;
    //     }, 800)
    //     if (!btn) {
    //         $('.menu_list').slideUp();
    //         clearTimeout(popup)
    //         btn = true;
    //     }

    // })
    // $('.menu_list a').click(function () {
    //     $(this).closest('.menu').toggleClass('active');
    //     if ($('#fullpage').length > 0) {
    //         if ($('.menu').hasClass('active')) {
    //             $.fn.fullpage.setMouseWheelScrolling(false);
    //             $.fn.fullpage.setAllowScrolling(false);
    //         } else {
    //             $.fn.fullpage.setMouseWheelScrolling(true);
    //             $.fn.fullpage.setAllowScrolling(true);
    //         }
    //     }
    //     var popup = setTimeout(function () {
    //         $('.menu_list').slideDown(1500);
    //         btn = false;
    //     }, 800)
    //     if (!btn) {
    //         $('.menu_list').slideUp();
    //         clearTimeout(popup)
    //         btn = true;
    //     }
    // })


    // var socialItem = document.querySelectorAll('.social__item');
    // var blackelement = document.querySelector('.container__brief');
    // var top;
    // window.addEventListener('scroll', () => {
    //     top = window.pageYOffset + 200;
    //     console.log(top);
    //     if (top >= blackelement.offsetTop && top <= (blackelement.offsetTop + blackelement.clientHeight)) {
    //         Array.from(socialItem).forEach((elem) => {
    //             if (top >= elem.offsetTop) {
    //                 elem.classList.add('social__item--white');
    //             }
    //         });
    //     } else {
    //         Array.from(socialItem).forEach((elem) => {
    //             // if (top <= elem.offsetTop && top >= (elem.offsetTop + elem.clientHeight)) {
    //             //     elem.classList.remove('social__item--white');
    //             // }
    //             elem.classList.remove('social__item--white');
    //         });
    //     }
    // });

})();

