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
    var first = document.querySelector('.anchor1');

    var video = document.querySelector('.main-page__video');
    var stripe1 = document.querySelector('.stripe1');
    var stripe2 = document.querySelector('.stripe2');

    var anchorSpacer = document.querySelector('.anchor-spacer');
    var second = document.querySelector('.anchor2');
    var secondTop = second.offsetTop;
    var third = document.querySelector('.anchor3');
    var thirdTop = third.offsetTop;

    anchorSpacer.addEventListener('wheel', (evt) => {
        console.log(evt);
        console.log(evt.wheelDelta);

        if (evt.wheelDelta <= 0) {
            evt.preventDefault();
            evt.stopPropagation();

            // $(stripes).animate({
            //     display: block
            // }, 500, 'swing');

            $(video).animate({
                // opacity: 0,
                top: 63,
                height: 370
            }, 1000, 'swing');

            setTimeout(() => {
                $(stripe1).animate({
                    opacity: 1
                }, 100, 'swing');
    
                $(stripe2).animate({
                    opacity: 1
                }, 100, 'swing');
    
                $(stripe1).animate({
                    // opacity: 1,
                    top: 0
                }, 1500, 'swing');
    
                $(stripe2).animate({
                    // opacity: 1,
                    top: 0
                }, 2000, 'swing');

                setTimeout(() => {
                    $(video).animate({
                        opacity: 0
                    }, 1000, 'swing');
                }, 2000);
            }, 1000);

            // setTimeout(() => {
            //     $(video).animate({
            //         // opacity: 0,
            //         top: 63,
            //         height: 370
            //     }, 1000, 'swing');
            // }, 1000);

            $(second).animate({
                opacity: 0
            }, 3000, 'swing');

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: secondTop
                }, 1000, 'swing');
            }, 2000);

            // setTimeout(() => {
            //     $(second).animate({
            //         opacity: 1
            //     }, 2000, 'swing');
            // }, 5000);
        }

        setTimeout(() => {
            $(first).animate({
                opacity: 1
            }, 1000, 'swing');
    
            $(second).animate({
                opacity: 1
            }, 1000, 'swing');
        }, 2000);
    });

    
    second.addEventListener('wheel', (evt) => {
        console.log(evt);
        console.log(evt.wheelDelta);

        if (evt.wheelDelta <= 0) {
            evt.preventDefault();
            evt.stopPropagation();

            $('html, body').animate({
                scrollTop: thirdTop
            }, 2000, 'swing');
        }
    });
})();