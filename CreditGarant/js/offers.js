'use strict';

(function() {

    var offerButtonGraph = document.querySelectorAll('.offer__button--graph');

    Array.from(offerButtonGraph).forEach((elem) => {
        elem.addEventListener('click', () => {
            elem.classList.toggle('change-color-green');
            elem.parentElement.parentElement.children[1].children[1].classList.toggle('change-z-index');

            elem.parentElement.children[1].classList.remove('change-color-green');
            elem.parentElement.parentElement.children[1].children[2].classList.remove('change-z-index');
        });
    });

    var offerButtonCalculation = document.querySelectorAll('.offer__button--calculation');

    Array.from(offerButtonCalculation).forEach((elem) => {
        elem.addEventListener('click', () => {
            elem.classList.toggle('change-color-green');
            elem.parentElement.parentElement.children[1].children[2].classList.toggle('change-z-index');

            elem.parentElement.children[0].classList.remove('change-color-green');
            elem.parentElement.parentElement.children[1].children[1].classList.remove('change-z-index');
        });
    });

})();