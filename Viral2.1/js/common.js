function initPreloader() {
    $(window).load(function() {
        setTimeout(function() {
          $('#preloader').fadeOut('slow', function() {});
        }, 2000);
    });
};

function initParallax() {
	var scene = document.getElementById('background-parallax');
	var parallaxInstance = new Parallax(scene, {
        relativeInput: true,
        frictionX: 0.3,
        frictionY: 0.3,
	});
};

$(document).ready(function(){
    initParallax();
    initPreloader();
})



// (function () {
//     console.log(document.scrollTop);
    
//     var DEBOUNCE_INTERVAL = 6000;

//     var lastTimeout;
//     var debounce = function (fun) {
//         if (lastTimeout) {
//             window.clearTimeout(lastTimeout);
//         }
//         lastTimeout = window.setTimeout(fun, DEBOUNCE_INTERVAL);
//     };

//     var first = document.querySelector('.anchor1');

//     var video = document.querySelector('.main-page__video');
//     var stripe1 = document.querySelector('.stripe1');
//     var stripe2 = document.querySelector('.stripe2');

//     var anchorSpacer = document.querySelector('.anchor-spacer');
//     var second = document.querySelector('.anchor2');
//     var secondTop = second.offsetTop;

//     var servicesItem1 = document.querySelector('.services-list__item:nth-child(1)');
//     var servicesItem2 = document.querySelector('.services-list__item:nth-child(2)');
//     var servicesItem3 = document.querySelector('.services-list__item:nth-child(3)');

//     var third = document.querySelector('.container__about-company');
//     var thirdTop = third.offsetParent.offsetTop;

//     anchorSpacer.addEventListener('wheel', (evt) => {
//         evt.preventDefault();
//         evt.stopPropagation();

//         if (evt.wheelDelta <= 0) {
//             // evt.preventDefault();
//             // evt.stopPropagation();

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
//     });

    
//     second.addEventListener('wheel', (evt) => {
//         evt.preventDefault();
//         evt.stopPropagation();

//         if (evt.wheelDelta <= 0) {
//             $('html, body').animate({
//                 scrollTop: thirdTop
//             }, 500, 'swing');
//         }

//         if (evt.wheelDelta > 0) {
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
//     });

//     third.addEventListener('wheel', (evt) => {
//         if (evt.wheelDelta > 0) {
//             evt.preventDefault();
//             evt.stopPropagation();

//             $('html, body').animate({
//                 scrollTop: secondTop
//             }, 500, 'swing');
//         }
//     });
// })();
/*
(function($) {

    // инициализация
    // var ctrl = new ScrollMagic.Controller({
    //     globalSceneOptions: {
    //         triggerHook: 'onLeave'
    //     }
    // });

    // Создаем сцену
    // $(".anchor1").each(function() {   container-main
    // $("#container-main").on('scrolldown', function() {  
        // console.log($("#container-main")[0]);
        // new ScrollMagic.Scene({
        //     triggerElement: $("#container-main")[0],
        //     duration: '50%',
        //     reverse : true
        // })
        // .setPin($("#container-main")[0])
        // // .addIndicators({
        // //     colorStart: "rgba(255,255,255,0.5)",
        // //     colorEnd: "rgba(255,255,255,0.5)", 
        // //     colorTrigger : "rgba(255,255,255,1)"
        // // })
        // .addTo(ctrl);
    // });

// console.log(document.querySelector('html').clientWidth);

    console.log(document.querySelector('html').clientHeight);
    var duration = Math.round(24400/document.querySelector('html').clientHeight);
    console.log(duration);

    $(document).ready(function () {
        var ctrl = new ScrollMagic.Controller({
            globalSceneOptions: {
                triggerHook: 'onLeave'
            }
        });

        // var section1Height = new TimelineMax();
        // section1Height
        // // .fromTo("#anchor-spacer", 1, {'margin-top': '100px'}, {'margin-top': '0px', ease: Linear.easeNone})
        // .fromTo("#anchor-spacer", 1, {height: '100vh'}, {height: '0', ease: Linear.easeNone});
        // // .fromTo("#anchor-spacer", 0, {height: '100vh', 'margin-top': '100px'}, {height: '0', 'margin-top': '0px', ease: Linear.easeNone}, '-0.3')
        // new ScrollMagic.Scene({
        //     triggerElement: "body",
        //     // triggerHook: "onLeave",
        //     duration: '200%'
        // })
        // .setPin("#anchor-spacer")
        // .setTween(section1Height)
        // .addTo(ctrl);

        var section1Action = new TimelineMax();
        section1Action
        // .to("#anchor-spacer", 1, {height: '0', delay: 10, ease: Linear.easeNone})
        // .from("#container-main", 1, {opacity: 1})

        // .fromTo("#stripe1", 1, {top: "500px"}, {top: "0px", ease: Linear.easeNone})
        // .fromTo("#stripe2", 1, {top: "500px"}, {top: "0px", ease: Linear.easeNone})
        
        .fromTo("#video", 1.2, {height: '500px', transition: '0.8s'}, {height: '370px', ease: Linear.easeNone})
        .fromTo(".stripes", 1.2, {top: "500px", transition: '0.8s'}, {top: "0px", ease: Linear.easeNone})
        .to("#anchor-spacer", 1, {height: '0', ease: Linear.easeNone})
        .fromTo("#container-main", 1.2, {opacity: 1, transition: '1s'}, {opacity: 0.5, ease: Linear.easeNone})

        // .fromTo("#services-item1", 1, {opacity: 0}, {opacity: 1, ease: Linear.easeNone})
        // .fromTo("#services-item2", 1, {opacity: 0}, {opacity: 1, ease: Linear.easeNone})
        // .fromTo("#services-item3", 1, {opacity: 0}, {opacity: 1, ease: Linear.easeNone})
        .fromTo("#container-services", 0.9, {opacity: 0, transition: '1.5s'}, {opacity: 1, ease: Linear.easeNone})


        .to("#container-main", 0.8, {opacity: 0, transition: '1s', delay: 2, ease: Linear.easeNone})
        .to("#container-main", 1.2, {opacity: 0, transition: '1s', delay: 1, ease: Linear.easeNone});
        
        new ScrollMagic.Scene({
            triggerElement: "body",
            // triggerHook: "onLeave",
            duration: duration + '%'
            // duration: '40%'
        })
        .setPin("body")
        .setTween(section1Action)
        .addTo(ctrl);

        // var section2Action = new TimelineMax();
        // section2Action
        // // .fromTo("#container-main", 1, {opacity: 1}, {opacity: 0, ease: Linear.easeNone})
        // // .to("#anchor-spacer", 1, {height: '0', delay: 10, ease: Linear.easeNone})
        // // .to("#anchor-spacer", 1, {'margin-top': '0px', ease: Linear.easeNone})
        // // .fromTo("#services-item1", 1, {opacity: 0}, {opacity: 1, ease: Linear.easeNone})
        // // .fromTo("#services-item2", 1, {opacity: 0}, {opacity: 1, ease: Linear.easeNone})
        // // .fromTo("#services-item3", 1, {opacity: 0}, {opacity: 1, ease: Linear.easeNone});
        // .fromTo("#container-services", 1.2, {opacity: 0, transition: '1.5s'}, {opacity: 1, ease: Linear.easeNone})

        // .to("#container-main", 1, {opacity: 0, transition: '0.2s', ease: Linear.easeNone})
        // .to("#container-main", 1, {opacity: 0, transition: '1s', delay: 2, ease: Linear.easeNone});

        // // .fromTo("#container-services", 1, {opacity: 0}, {opacity: 1, ease: Linear.easeNone});
        // new ScrollMagic.Scene({
        //     triggerElement: "body",
        //     // triggerHook: "onEnter",
        //     duration: duration + '%'
        // })
        // .setPin("body")
        // .setTween(section2Action)
        // .addTo(ctrl);
    });

})(jQuery);
*/