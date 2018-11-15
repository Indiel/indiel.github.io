// function initPreloader() {
//     setTimeout(function() {
//         $('#preloader').fadeOut('slow', function() {});
//     }, 2000);
// } 

// function initParallax() {
// 	var scene = document.querySelector('.parallax-bg');
// 	var parallaxInstance = new Parallax(scene, {    
// 		relativeInput: true,
// 	});
// }
// initParallax();

// $(document).ready(function(){
//     // initPreloader();
//     sliderRemove();
// });

// function sliderRemove(){
//     if ($(window).width() > 768){
//         const slider = $(".slider-page");
//         slider.slick({
//             dots: true,
//             infinite: false,
//             speed: 300,
//             slidesToShow: 1,
//             slidesToScroll: 1,
//             fade: true,
//             verticalSwiping: true
//         });

//         $('.slick-active').addClass('slider-line-bottom');

        
//         $('.arrow').on('click', function(){
//             $('.slider-page').slick('slickNext');
//         });

//         $('#main').on('click', function(){
//             $('.slider-page').slick('slickGoTo', 0);
//         });
//         $('#services').on('click', function(){
//             $('.slider-page').slick('slickGoTo', 1);
//         });
//         $('#contacts').on('click', function(){
//             $('.slider-page').slick('slickGoTo', 2);
//         });
//     }
// }

// $(window).resize(function(){
//     sliderRemove(); 
// })

// function anchors() {
//     window.addEventListener('wheel', function(e) {
//         // if (e.target.classList.contains('text-block')){
//         //     e.stopPropagation;
//         //     return false;
//         // }
//         if (e.deltaY < 0) {
//             console.log('up');
//             var topFirst = $('#container-main').offset().top + 100;
//             $('body,html').animate({scrollTop: topFirst}, 100);
            

//             // $('.slider-page').slick('slickPrev');

//             // $('.slick-active').addClass('slider-line-top');
//         }
//         if (e.deltaY > 0) {
//             console.log('down');
//             var topSecond = $('#container-services').offset().top + 100;
//             $('body,html').animate({scrollTop: topSecond}, 100);

//             // $('.slider-page').slick('slickNext');

//             // $('.slick-active').addClass('slider-line-bottom');

//             // $('.slick-active').prev('li').addClass('none-active-slider-line-bottom');
//         }
//     });
// }

// anchors();

// $(document).ready(function(){
//     $("body").on("wheel", function (evt) {
//         //отменяем стандартную обработку нажатия по ссылке
//         evt.preventDefault();
//         //забираем идентификатор блока с атрибута href
//         var id  = $(this).attr('id'),
//         //узнаем высоту от начала страницы до блока на который ссылается якорь
//         top = $(id).offset().top;
//         //анимируем переход на расстояние - top за 1500 мс
//         $('body,html').animate({scrollTop: top}, 1500);
//     });
// });    


// var slide = document.querySelectorAll('.anchor');

// document.addEventListener('wheel', () => {
//     Array.from(slide).forEach((elem) => {
//         elem.scrollIntoView();
//     });
// });


// Array.from(slide).forEach((elem) => {
//     elem.addEventListener('mousewheel', () => {
//         elem.scrollIntoView(true);
//     });
// });

// var anchors = [];
// var currentAnchor = -1;
// var isAnimating  = false;

// $(function(){
    
//     function updateAnchors() {
//         anchors = [];
//         $('.anchor').each(function(i, element){
//             anchors.push( $(element).offset().top );
//         });
//     }
    
//     console.log($('.anchor')[0]);
//     var first = $('.anchor')[0];
//     $('.anchor').on('mousewheel', function(e){
//         // e.preventDefault();
//         // e.stopPropagation();
//         if( isAnimating ) {
//             return false;
//         }
//         isAnimating  = true;
//         // Increase or reset current anchor
//         if( e.originalEvent.wheelDelta >= 0 ) {
//             console.log('up');
//             currentAnchor--;
//         }else{
//             console.log('down');
//             currentAnchor++;
//         }
//         // if( currentAnchor > (anchors.length - 1) || currentAnchor < 0 ) {
//         //     currentAnchor = 0;
//         // }
//         if(currentAnchor < 0 ) {
//             currentAnchor = 0;
//         }
//         if( currentAnchor > (anchors.length - 1)) {
//             currentAnchor = anchors.length - 1;
//             console.log('currentAnchor > (anchors.length - 1)');
//         } else {
//             e.preventDefault();
//             e.stopPropagation();
//         }
//         isAnimating  = true;
//         $('html, body').animate({
//             scrollTop: parseInt( anchors[currentAnchor] - 100)
//         }, 500, 'swing', function(){
//             isAnimating  = false;
//         });
//     });

//     updateAnchors();
// });

(function () {
    var DEBOUNCE_INTERVAL = 6000;

    var lastTimeout;
    var debounce = function (fun) {
        if (lastTimeout) {
            window.clearTimeout(lastTimeout);
        }
        lastTimeout = window.setTimeout(fun, DEBOUNCE_INTERVAL);
    };

    var first = document.querySelector('.anchor1');

    var video = document.querySelector('.main-page__video');
    var stripe1 = document.querySelector('.stripe1');
    var stripe2 = document.querySelector('.stripe2');

    var anchorSpacer = document.querySelector('.anchor-spacer');
    var second = document.querySelector('.anchor2');
    var secondTop = second.offsetTop;

    var servicesItem1 = document.querySelector('.services-list__item:nth-child(1)');
    var servicesItem2 = document.querySelector('.services-list__item:nth-child(2)');
    var servicesItem3 = document.querySelector('.services-list__item:nth-child(3)');

    var third = document.querySelector('.container__about-company');
    var thirdTop = third.offsetParent.offsetTop;

    
    //     anchorSpacer.addEventListener('wheel', (evt) => {
    //         debounce ( () => {
    //         if (evt.wheelDelta <= 0) {
    //             evt.preventDefault();
    //             evt.stopPropagation();

    //             $(stripe1).animate({
    //                 opacity: 1
    //             }, 100, 'swing');

    //             $(stripe2).animate({
    //                 opacity: 1
    //             }, 100, 'swing');

    //             $(stripe1).animate({
    //                 top: 0
    //             }, 800, 'swing');

    //             $(stripe2).animate({
    //                 top: 0
    //             }, 1200, 'swing');

    //             setTimeout(() => {
    //                 $(video).animate({
    //                     top: 63,
    //                     height: 370
    //                 }, 800, 'swing');

    //                 setTimeout(() => {
    //                     $(video).animate({
    //                         opacity: 0
    //                     }, 4000, 'swing');
    //                 }, 800);
    //             }, 1200);

    //             $(servicesItem1).animate({
    //                 opacity: 0
    //             }, 100, 'swing'); 

    //             $(servicesItem2).animate({
    //                 opacity: 0
    //             }, 100, 'swing'); 

    //             $(servicesItem3).animate({
    //                 opacity: 0
    //             }, 100, 'swing'); 

    //             setTimeout(() => {
    //                 $(servicesItem1).animate({
    //                     opacity: 1
    //                 }, 1000, 'swing'); 
        
    //                 setTimeout(() => {
    //                     $(servicesItem2).animate({
    //                         opacity: 1
    //                     }, 1000, 'swing');
    //                 }, 500);
        
    //                 setTimeout(() => {
    //                     $(servicesItem3).animate({
    //                         opacity: 1
    //                     }, 1000, 'swing');
    //                 }, 1000);
    //             }, 3000);

    //             setTimeout(() => {
    //                 $('html, body').animate({
    //                     scrollTop: secondTop
    //                 }, 500, 'swing');
    //             }, 2000);
    //         }
    //         });
    //     });
    

    // debounce (
    //     second.addEventListener('wheel', (evt) => {
    //         if (evt.wheelDelta <= 0) {
    //             evt.preventDefault();
    //             evt.stopPropagation();

    //             $('html, body').animate({
    //                 scrollTop: thirdTop
    //             }, 500, 'swing');
    //         }

    //         if (evt.wheelDelta > 0) {
    //             evt.preventDefault();
    //             evt.stopPropagation();

    //             $(stripe1).animate({
    //                 top: 0,
    //                 opacity: 1
    //             }, 100, 'swing');

    //             $(stripe2).animate({
    //                 top: 0,
    //                 opacity: 1
    //             }, 100, 'swing');

    //             $(video).animate({
    //                 opacity: 1
    //             }, 3000, 'swing');

    //             setTimeout(() => {
    //                 $(servicesItem3).animate({
    //                     opacity: 0
    //                 }, 1000, 'swing'); 
    //             }, 500);

    //             setTimeout(() => {
    //                 $(servicesItem2).animate({
    //                     opacity: 0
    //                 }, 1000, 'swing'); 
    //             }, 1000);

    //             setTimeout(() => {
    //                 $(servicesItem1).animate({
    //                     opacity: 0
    //                 }, 1000, 'swing');
    //             }, 1500);

    //             setTimeout(() => {
    //                 $(video).animate({
    //                     top: 0,
    //                     height: 500
    //                 }, 800, 'swing');
    //             }, 2000);

    //             setTimeout(() => {
    //                 $(stripe2).animate({
    //                     top: 500
    //                 }, 800, 'swing');

    //                 $(stripe1).animate({
    //                     top: 500
    //                 }, 1200, 'swing');
    //             }, 4000);
                

    //             setTimeout(() => {
    //                 $('html, body').animate({
    //                     scrollTop: 0
    //                 }, 500, 'swing');
    //             }, 2500);
    //         }
    //     })
    // );

    anchorSpacer.addEventListener('wheel', (evt) => {
        evt.preventDefault();
        evt.stopPropagation();

        if (evt.wheelDelta <= 0) {
            // evt.preventDefault();
            // evt.stopPropagation();

            $(stripe1).animate({
                opacity: 1
            }, 100, 'swing');

            $(stripe2).animate({
                opacity: 1
            }, 100, 'swing');

            $(stripe1).animate({
                top: 0
            }, 800, 'swing');

            $(stripe2).animate({
                top: 0
            }, 1200, 'swing');

            setTimeout(() => {
                $(video).animate({
                    top: 63,
                    height: 370
                }, 800, 'swing');

                setTimeout(() => {
                    $(video).animate({
                        opacity: 0
                    }, 4000, 'swing');
                }, 800);
            }, 1200);

            $(servicesItem1).animate({
                opacity: 0
            }, 100, 'swing'); 

            $(servicesItem2).animate({
                opacity: 0
            }, 100, 'swing'); 

            $(servicesItem3).animate({
                opacity: 0
            }, 100, 'swing'); 

            setTimeout(() => {
                $(servicesItem1).animate({
                    opacity: 1
                }, 1000, 'swing'); 
    
                setTimeout(() => {
                    $(servicesItem2).animate({
                        opacity: 1
                    }, 1000, 'swing');
                }, 500);
    
                setTimeout(() => {
                    $(servicesItem3).animate({
                        opacity: 1
                    }, 1000, 'swing');
                }, 1000);
            }, 3000);

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: secondTop
                }, 500, 'swing');
            }, 2000);
        }
    });

    
    second.addEventListener('wheel', (evt) => {
        evt.preventDefault();
        evt.stopPropagation();

        if (evt.wheelDelta <= 0) {
            $('html, body').animate({
                scrollTop: thirdTop
            }, 500, 'swing');
        }

        if (evt.wheelDelta > 0) {
            $(stripe1).animate({
                top: 0,
                opacity: 1
            }, 100, 'swing');

            $(stripe2).animate({
                top: 0,
                opacity: 1
            }, 100, 'swing');

            $(video).animate({
                opacity: 1
            }, 3000, 'swing');

            setTimeout(() => {
                $(servicesItem3).animate({
                    opacity: 0
                }, 1000, 'swing'); 
            }, 500);

            setTimeout(() => {
                $(servicesItem2).animate({
                    opacity: 0
                }, 1000, 'swing'); 
            }, 1000);

            setTimeout(() => {
                $(servicesItem1).animate({
                    opacity: 0
                }, 1000, 'swing');
            }, 1500);

            setTimeout(() => {
                $(video).animate({
                    top: 0,
                    height: 500
                }, 800, 'swing');
            }, 2000);

            setTimeout(() => {
                $(stripe2).animate({
                    top: 500
                }, 800, 'swing');

                $(stripe1).animate({
                    top: 500
                }, 1200, 'swing');
            }, 4000);
            

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: 0
                }, 500, 'swing');
            }, 2500);
        }
    });

    third.addEventListener('wheel', (evt) => {
        if (evt.wheelDelta > 0) {
            evt.preventDefault();
            evt.stopPropagation();

            $('html, body').animate({
                scrollTop: secondTop
            }, 500, 'swing');
        }
    });
})();