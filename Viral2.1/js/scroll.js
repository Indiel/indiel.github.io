'use strict';

(function () {

    var sections = document.querySelectorAll('section');
    // var html = document.querySelectorAll('body');

    var heights = [];
    var offsets = [];
    var anchors = [];
    // var count = 0;
    var isAnimating  = false;

    setTimeout(function() {
        Array.from(sections).forEach((elem, i) => {
            heights[i] = elem;
            offsets[i] = elem.offsetTop;
            anchors[i] = $(elem).offset().top;
        });
        console.log(heights);
        console.log(offsets);
        console.log(anchors);
    }, 5000);
    

    window.addEventListener('wheel', (evt) => {
        // evt.preventDefault();
        // evt.stopPropagation();

        if (isAnimating) {
            return false;
        }

        for (var i = 0; i < offsets.length; i++) {
            if (window.pageYOffset + 100 >= offsets[offsets.length - 1]) {
                return;
            } else if (window.pageYOffset + 100 === offsets[i]) {
                evt.preventDefault();
                evt.stopPropagation();

                if (evt.wheelDelta < 0) {
                    isAnimating  = true;
                    $('html, body').animate({
                        scrollTop: offsets[i + 1] - 100
                    }, 500, 'swing', function(){
                        isAnimating  = false;
                    });
                    return;
                } else {
                    isAnimating  = true;
                    $('html, body').animate({
                        scrollTop: offsets[i - 1] - 100
                    }, 500, 'swing', function(){
                        isAnimating  = false;
                    });
                    return;
                }
            } else if (window.pageYOffset + 100 > offsets[i] && window.pageYOffset + 100 < offsets[i + 1]) {
                evt.preventDefault();
                evt.stopPropagation();

                if (evt.wheelDelta < 0) {
                    isAnimating  = true;
                    $('html, body').animate({
                        scrollTop: offsets[i + 1] - 100
                    }, 500, 'swing', function(){
                        isAnimating  = false;
                    });
                    return;
                } else {
                    isAnimating  = true;
                    $('html, body').animate({
                        scrollTop: offsets[i] - 100
                    }, 500, 'swing', function(){
                        isAnimating  = false;
                    });
                    return;
                }
            }
        }

        // offsets.forEach((elem, i) => {
        //     if (window.pageYOffset >= elem && window.pageYOffset < elem)
        // });
        
        // if (evt.wheelDelta < 0) {
        //     if (count < (heights.length - 1)) {
        //         count++;
        //         isAnimating  = true;
        //         $('html, body').animate({
        //             scrollTop: $(heights[count]).offset().top - 100
        //         }, 500, 'swing', function(){
        //             isAnimating  = false;
        //         });
        //     }
        // } else {
        //     if (count > 0) {
        //         count--;
        //         isAnimating  = true;
        //         $('html, body').animate({
        //             scrollTop: $(heights[count]).offset().top - 100
        //         }, 500, 'swing', function(){
        //             isAnimating  = false;
        //         });
        //     }
        // }
    });

})();