'use strict';

(function () {

    var menuButton = document.querySelector('.menu-button');

    var mainNav = document.querySelector('.main-nav__wrapper');
    var mainButton = document.querySelector('.main-nav__start-project-button');
    var mainLang = document.querySelector('.lang-list__link');
    var navItem = document.querySelectorAll('.nav-list__item');
    var socialList = document.querySelector('.fixed__social-list');

    menuButton.addEventListener('click', () => {
        var timeMenu;
        var timeItem;
        
        if (mainNav.classList.length === 2) {
            timeMenu = 400;
            timeItem = 0;
        } else {
            timeMenu = 0;
            timeItem = 300;
        }

        setTimeout(() => {
            menuButton.classList.toggle('is-active');
            mainNav.classList.toggle('main-nav__wrapper--active');
            mainButton.classList.toggle('main-nav__start-project-button--active');
            mainLang.classList.toggle('lang-list__link--active');
            socialList.classList.toggle('fixed__social-list--active');
        }, timeMenu);

        Array.from(navItem).forEach((elem) => {
            setTimeout(() => {
                elem.classList.toggle('nav-list__item--active');
            }, timeItem);
            timeItem += 100;
        });

    });


    // var menuClicked = true;
    // var intervalid = null;

    // mainNav.style.width = "0px";
    // mainNav.style.height = "0px";
    // var offsetTop = mainNav.offsetTop;
    // var offsetLeft = mainNav.offsetLeft;
    // mainNav.style.top = "50px";
    // mainNav.style.left = "40px";

    // menuButton.addEventListener('click', (evt) => {
    //     // menuButton.classList.toggle('is-active');

    //     if (menuClicked) {
    //         if(intervalid === null)
    //         intervalid = setInterval(increase, 2);
    //         menuClicked = false;
    //     } else {
    //         if(intervalid === null)
    //         intervalid = setInterval(decrease, 2);
    //         menuClicked = true;
    //     }
    // });

    // function increase() {
    //     menuButton.classList.add('is-active');

    //     var width = mainNav.style.width;
    //     var widthNumber = parseInt(width.substring(0, width.length - 2), 10);

    //     var height = mainNav.style.height;
    //     var heightNumber = parseInt(height.substring(0, height.length - 2), 10);

    //     var topNumber = mainNav.offsetTop;
    //     var leftNumber = mainNav.offsetLeft;

    //     if (widthNumber < document.querySelector('html').clientWidth) {
    //         if (leftNumber > -10 && topNumber > 0) {
    //             widthNumber += 8;
    //             leftNumber -= 4;
    //             topNumber -= 4;

    //             mainNav.style.width = widthNumber + 'px';
    //             mainNav.style.height = widthNumber + 'px';
    //             mainNav.style.left = leftNumber + 'px';
    //             mainNav.style.top = topNumber + 'px';
    //         } else if (leftNumber > -10) {
    //             widthNumber += 8;
    //             leftNumber -= 4;

    //             mainNav.style.width = widthNumber + 'px';
    //             mainNav.style.height = widthNumber + 'px';
    //             mainNav.style.left = leftNumber + 'px';
    //         } else if (topNumber > 0) {
    //             widthNumber += 8;
    //             topNumber -= 4;

    //             mainNav.style.width = widthNumber + 'px';
    //             mainNav.style.height = widthNumber + 'px';
    //             mainNav.style.top = topNumber + 'px';
    //         } else {
    //             widthNumber += 4;
    //             mainNav.style.width = widthNumber + 'px';

    //             if (heightNumber < document.querySelector('html').clientHeight) {
    //                 heightNumber +=4;
    //                 mainNav.style.height = widthNumber + 'px';
    //             }
    //         }

    //         console.log(mainNav.style.top);
    //         console.log(mainNav.style.left);
    //     } else {
    //         window.clearInterval(intervalid);
    //         intervalid = null;
    //     }
    // }
    // function decrease() {
    //     menuButton.classList.remove('is-active');

    //     var width = mainNav.style.width;
    //     var widthNumber = parseInt(width.substring(0, width.length - 2), 10);
    //     // var top = mainNav.style.top;
    //     // var topNumber = parseInt(top.substring(0, top.length - 2), 10);
    //     var topNumber = mainNav.offsetTop;
    //     var leftNumber = mainNav.offsetLeft;

    //     if (widthNumber > 0) {
    //         if (leftNumber <= offsetLeft && topNumber <= offsetTop) {
    //             widthNumber -= 8;
    //             leftNumber += 4;
    //             topNumber += 4;

    //             mainNav.style.width = widthNumber + 'px';
    //             mainNav.style.height = widthNumber + 'px';
    //             mainNav.style.left = leftNumber + 'px';
    //             mainNav.style.top = topNumber + 'px';
    //         } else if (leftNumber <= offsetLeft) {
    //             widthNumber -= 8;
    //             leftNumber += 4;

    //             mainNav.style.width = widthNumber + 'px';
    //             mainNav.style.height = widthNumber + 'px';
    //             mainNav.style.left = leftNumber + 'px';
    //         } else if (topNumber <= offsetTop) {
    //             widthNumber -= 8;
    //             topNumber += 4;

    //             mainNav.style.width = widthNumber + 'px';
    //             mainNav.style.height = widthNumber + 'px';
    //             mainNav.style.top = topNumber + 'px';
    //         } else {
    //             widthNumber -= 4;

    //             mainNav.style.width = widthNumber + 'px';
    //             mainNav.style.height = widthNumber + 'px';
    //         }

    //         console.log(mainNav.style.top);
    //         console.log(mainNav.style.left);
    //     } else {
    //         window.clearInterval(intervalid);
    //         intervalid = null;
    //     }
    // }

})();

