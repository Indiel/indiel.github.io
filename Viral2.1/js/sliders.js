function sliderRemove() {

    var clients = $(".clients__list");
    var certificates = $(".certificates__list");
    var workingPage = $(".working-page__list");

    if ($(window).width() > 650 && $(window).width() < 900) {

        clients.slick({
            dots: false,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 1
        });

        certificates.slick({
            dots: false,
            speed: 300,
            // slidesToShow: 1,
            slidesToScroll: 1,
            // centerMode: true,
            // variableWidth: true,
            // infinite: true,
            slidesToShow: 4
        });

    } else if ($(window).width() >= 500 && $(window).width() <= 650) {

        clients.slick({
            dots: false,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        certificates.slick({
            dots: false,
            speed: 300,
            // slidesToShow: 1,
            slidesToScroll: 1,
            // centerMode: true,
            // variableWidth: true,
            // infinite: true,
            slidesToShow: 2
        });
    } else if ($(window).width() < 500) {

        clients.slick({
            dots: false,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        certificates.slick({
            dots: false,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        workingPage.slick({
            dots: false,
            speed: 300,
            // slidesToShow: 1,
            slidesToScroll: 1,
            // centerMode: true,
            // variableWidth: true,
            // infinite: true,
            slidesToShow: 1
        });
    }

}

$(document).ready(function(){
    sliderRemove();
});



// 'use strict';

// (function () {

//     function Slider (prevButton, nextButton, list, items) {
//         this.prevButton = prevButton;
//         this.nextButton = nextButton;

//         this.list = list;
//         this.items = items;

//         this.shift = 0;
//         this.elemNumber = 1; 

//         this.nextButton.addEventListener('click', () => {
//             this.shift -= this.list.clientWidth;
//             this.elemNumber += 1;
//             if (this.items.length < this.elemNumber) {
//                 this.elemNumber = 1;
//                 this.shift = 0;
//             }
//             this.list.style.left = this.shift + 'px';
//         });

//         this.prevButton.addEventListener('click', () => {
//             this.shift += this.list.clientWidth;
//             this.elemNumber -= 1;
//             if (this.elemNumber <= 0) {
//                 this.elemNumber = this.items.length;
//                 this.shift = -this.list.clientWidth * (this.items.length - 1);
//             }
//             this.list.style.left = this.shift + 'px';
//         });
//     };



//     // var mainPin = document.querySelector('.map__pin--main');
//     // var adForm = document.querySelector('.ad-form');
  
//     // var addressInput = document.querySelector('#address');
//     // addressInput.value = (mainPin.offsetLeft + 32) + ', ' + (mainPin.offsetTop + 32);
  
//     // mainPin.addEventListener('mousedown', function (evt) {
//     //     evt.preventDefault();
    
//     //     var startCoords = {
//     //         x: evt.clientX,
//     //         y: evt.clientY
//     //     };
        
//     //     // активация сайта
//     //     var onMainPinActiveteSite = function () {
//     //         document.querySelector('.map').classList.remove('map--faded');
    
//     //         window.backend.download(onLoad, window.backend.onError);
    
//     //         for (var j = 0; j < fieldsets.length; j++) {
//     //             fieldsets[j].disabled = false;
//     //         }
//     //         for (var l = 0; l < mapFilters.length; l++) {
//     //             mapFilters[l].disabled = false;
//     //         }
//     //         addressInput.value = (mainPin.offsetLeft + 32) + ', ' + (mainPin.offsetTop + 85);
//     //         adForm.classList.remove('ad-form--disabled');
//     //         mainPin.removeEventListener('mouseup', onMainPinActiveteSite);
    
//     //         window.onformRoomChange();
//     //     };
    
//     //     var onMouseMove = function (moveEvt) {
//     //         moveEvt.preventDefault();
    
//     //         var shift = {
//     //             x: startCoords.x - moveEvt.clientX,
//     //             y: startCoords.y - moveEvt.clientY
//     //         };
    
//     //         startCoords = {
//     //             x: moveEvt.clientX,
//     //             y: moveEvt.clientY
//     //         };
    
//     //         var pinCoords = {
//     //         x: mainPin.offsetLeft - shift.x,
//     //         y: mainPin.offsetTop - shift.y
//     //         };
    
//     //         if (pinCoords.y >= (130 - 65) && pinCoords.y <= 630) {
//     //         mainPin.style.left = pinCoords.x + 'px';
//     //         mainPin.style.top = pinCoords.y + 'px';
//     //         addressInput.value = (pinCoords.x + 32) + ', ' + (pinCoords.y + 85);
//     //         }
//     //     };
    
//     //     var onMouseUp = function (upEvt) {
//     //         upEvt.preventDefault();
    
//     //         mapPins.removeEventListener('mousemove', onMouseMove);
//     //         mapPins.removeEventListener('mouseup', onMouseUp);
//     //     };
    
//     //     if (document.querySelector('.map').classList.contains('map--faded')) {
//     //         onMainPinActiveteSite();
//     //     }
    
//     //     mapPins.addEventListener('mousemove', onMouseMove);
//     //     mapPins.addEventListener('mouseup', onMouseUp);
//     // });
      


//     var offer = new Slider (
//         document.querySelector('.offer__button-prev'),
//         document.querySelector('.offer__button-next'),
//         document.querySelector('.offers'),
//         document.querySelectorAll('.offers__item')
//     );

//     var top = new Slider (
//         document.querySelector('.top__button-prev'),
//         document.querySelector('.top__button-next'),
//         document.querySelector('.top__company-list'),
//         document.querySelectorAll('.top__company-item')
//     );

//     var blog = new Slider (
//         document.querySelector('.blog__button-prev'),
//         document.querySelector('.blog__button-next'),
//         document.querySelector('.blog__news-list'),
//         document.querySelectorAll('.blog__news-item')
//     );

// })();