'use strict';

(function () {

    var offerButtonPrev = document.querySelector('.offer__button-prev');
    var offerButtonNext = document.querySelector('.offer__button-next');

    var offers = document.querySelector('.offers');
    var offersItem = document.querySelectorAll('.offers__item');

    var offersShift = 0;
    var offersElemNumber = 1;  
    offerButtonNext.addEventListener('click', () => {
        offersShift -= 270;
        offersElemNumber += 1;
        if (offersItem.length === offersElemNumber) {
            offersElemNumber = 1;
            offersShift = 0;
        }
        offers.style.left = offersShift + 'px';
    });
    offerButtonPrev.addEventListener('click', () => {
        offersShift += 270;
        offersElemNumber -= 1;
        if (offersElemNumber < 1) {
            offersElemNumber = offersItem.length - 1;
            offersShift = -270 * (offersItem.length - 1);
        }
        offers.style.left = offersShift + 'px';
    });

    // var next = function (shift, elemNumber, item) {
    //     shift -= 270;
    //     elemNumber += 1;
    //     if (item.length === elemNumber) {
    //         elemNumber = 1;
    //         shift = 0;
    //     }
    //     offers.style.left = shift + 'px'; 

    //     return shift, elemNumber;
    // }

    // var prev = function (shift, elemNumber, item) {
    //     shift += 270;
    //     elemNumber -= 1;
    //     if (elemNumber < 1) {
    //         elemNumber = item.length - 1;
    //         shift = -270 * (item.length - 1);
    //     }
    //     offers.style.left = shift + 'px';
    // }

    // var a = function () {
    //     var offersShift = 0;
    //     var offersElemNumber = 1;
    //     offerButtonNext.addEventListener('click', () => {
    //         next(offersShift, offersElemNumber, offersItem);
    //     });
    //     offerButtonPrev.addEventListener('click', () => {
    //         prev(offersShift, offersElemNumber, offersItem);
    //     });
    // }
    // a();

})();