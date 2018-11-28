'use strict';

(function () {

    var sections = document.querySelectorAll('section');
    // var html = document.querySelectorAll('body');

    var heights = [];
    var offsets = [];
    // var count = 0;
    var isAnimating  = false;

    var count = 0;
    var oldCount = count;

    var sectionNumber = function() {
        for (let i = 0; i < offsets.length; i++) {
            if (window.pageYOffset + 100 >= offsets[offsets.length - 1]) {
                count = offsets.length - 1;
                return count;
            } else if (window.pageYOffset + 100 >= offsets[i] && window.pageYOffset + 100 < offsets[i + 1]) {
            // } else if ((window.pageYOffset + 100 >= offsets[i] || window.pageYOffset + document.documentElement.clientHeight >= offsets[i]) && (window.pageYOffset + 100 < offsets[i + 1] || window.pageYOffset + document.documentElement.clientHeight < offsets[i + 1])) {
                count = i;
                return count;
            }
        }
    };

    setTimeout(function() {
        Array.from(sections).forEach((elem, i) => {
            heights[i] = elem;
            offsets[i] = elem.offsetTop;
        });
        
        sectionNumber();
        buttons[count].classList.add('line-bottom');
    
    }, 2000);


    var buttonsNode = document.querySelectorAll('.progress-bar__item');
    var buttons = [];
    Array.from(buttonsNode).forEach((elem, i) => {
        buttons[i] = elem;
    });
    console.log(buttons);
  
    var removeClasses = function(elem) {
        // for (let j = 1; j < buttons[elem].classList.length; j++) {
        //     buttons[elem].classList.remove(buttons[elem].classList[j]);
        //     // buttons[elem - 1].classList.remove(buttons[elem - 1].classList[j]);
        //     buttons[elem + 1].classList.remove(buttons[elem + 1].classList[j]);
        // }
        buttons.forEach((elem) => {
            // buttons[i] = elem;
            for (let j = 1; j < elem.classList.length; j++) {
                elem.classList.remove(elem.classList[j]);
            }
        });
    };


    // var oldPageYOffset = window.pageYOffset;

    window.addEventListener('scroll', () => {
        sectionNumber();
        console.log(count);

        if (window.pageYOffset + 100 >= offsets[offsets.length]) {
            for (let j = (buttons[oldCount].classList.length - 1); j >= 1; j--) {
                buttons[oldCount].classList.remove(buttons[oldCount].classList[j]);
            }
            buttons[count].classList.add('line-bottom');
        } else
        // if (window.pageYOffset > oldPageYOffset) {
        if (count > oldCount) {
            // removeClasses();
            buttons[oldCount].classList.add('none-active-line-bottom');
            for (let j = (buttons[count].classList.length - 1); j >= 1; j--) {
                buttons[count].classList.remove(buttons[count].classList[j]);
            }

            buttons[count].classList.add('line-bottom');
            // buttons[oldCount].classList.add('none-active-line-bottom');
        // } else if (window.pageYOffset < oldPageYOffset) {
        } else if (count < oldCount) {
            // removeClasses();
            for (let j = (buttons[count].classList.length - 1); j >= 1; j--) {
                buttons[count].classList.remove(buttons[count].classList[j]);
            }
            for (let j = (buttons[oldCount].classList.length - 1); j >= 1; j--) {
                buttons[oldCount].classList.remove(buttons[oldCount].classList[j]);
            }              
            buttons[count].classList.add('line-top');         
        }
        
        // oldPageYOffset = window.pageYOffset;
        oldCount = count;
    })

    window.addEventListener('wheel', (evt) => {
        // evt.preventDefault();
        // evt.stopPropagation();
        // buttons.forEach((elem) => {
        //     for (let j = 1; j < elem.classList.length; j++) {
        //         elem.classList.remove(elem.classList[j]);
        //     }
        // });

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

                    // removeClasses(i);
                    // // for (let j = 1; j < buttons[i].classList.length; j++) {
                    // //     buttons[i].classList.remove(buttons[i].classList[j]);
                    // // }
                    // // buttons[i].classList.remove('line-top');
                    // // buttons[i].classList.remove(buttons[i].classList[1]);
                    // buttons[i + 1].classList.add('line-bottom');
                    // // console.log(buttons[i + 1].classList[1]);
                    // buttons[i].classList.add('none-active-line-bottom');

                    isAnimating  = true;
                    $('html, body').animate({
                        scrollTop: offsets[i + 1] - 100
                    }, 500, 'swing', function(){
                        isAnimating  = false;
                    });
                    return;
                } else {
                    // removeClasses(i);
                    // // for (let j = 1; j < buttons[i].classList.length; j++) {
                    // //     buttons[i + 1].classList.remove(buttons[i + 1].classList[j]);
                    // // }
                    // // buttons[i + 1].classList.remove(buttons[i + 1].classList[1]);
                    // // buttons[i + 1].classList.remove('line-bottom');                    
                    // buttons[i].classList.add('line-top');

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
                    // removeClasses(i);
                    // // for (let j = 1; j < buttons[i].classList.length; j++) {
                    // //     buttons[i].classList.remove(buttons[i].classList[j]);
                    // // }
                    // // buttons[i].classList.remove('line-top');
                    // // buttons[i + 1].classList.remove('line-top');
                    // // buttons[i].classList.remove(buttons[i].classList[1]);

                    // buttons[i + 1].classList.add('line-bottom');
                    // buttons[i].classList.add('none-active-line-bottom');

                    isAnimating  = true;
                    $('html, body').animate({
                        scrollTop: offsets[i + 1] - 100
                    }, 500, 'swing', function(){
                        isAnimating  = false;
                    });
                    return;
                } else {
                    // removeClasses(i);
                    // // for (let j = 1; j < buttons[i].classList.length; j++) {
                    // //     buttons[i + 1].classList.remove(buttons[i + 1].classList[j]);
                    // // }
                    // // buttons[i + 1].classList.remove(buttons[i + 1].classList[1]);

                    // // buttons[i + 1].classList.remove('line-bottom');                    
                    // buttons[i].classList.add('line-top');                    

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
    });

})();