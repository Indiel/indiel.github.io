'use strict';

(function () {

    var sections = document.querySelectorAll('section');

    var heights = [];
    var offsets = [];

    var isAnimating  = false;

    var count = 0;
    var oldCount = count;

    var sectionNumber = function() {
        for (let i = 0; i < offsets.length; i++) {
            if (window.pageYOffset + 100 >= offsets[offsets.length - 1]) {
                count = offsets.length - 1;
                return count;
            } else if (window.pageYOffset + 100 >= offsets[i] && window.pageYOffset + 100 < offsets[i + 1]) {
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
    
    }, 5000);

    var buttonsNode = document.querySelectorAll('.progress-bar__item');
    var buttons = [];
    Array.from(buttonsNode).forEach((elem, i) => {
        buttons[i] = elem;
    });
    console.log(buttons);

    window.addEventListener('scroll', () => {
        sectionNumber();
        console.log(count);

        if (window.pageYOffset + 100 >= offsets[offsets.length]) {
            for (let j = (buttons[oldCount].classList.length - 1); j >= 1; j--) {
                buttons[oldCount].classList.remove(buttons[oldCount].classList[j]);
            }
            buttons[count].classList.add('line-bottom');
        } else if (count > oldCount) {
            buttons[oldCount].classList.add('none-active-line-bottom');
            for (let j = (buttons[count].classList.length - 1); j >= 1; j--) {
                buttons[count].classList.remove(buttons[count].classList[j]);
            }
            buttons[count].classList.add('line-bottom');
        } else if (count < oldCount) {
            for (let j = (buttons[count].classList.length - 1); j >= 1; j--) {
                buttons[count].classList.remove(buttons[count].classList[j]);
            }
            for (let j = (buttons[oldCount].classList.length - 1); j >= 1; j--) {
                buttons[oldCount].classList.remove(buttons[oldCount].classList[j]);
            }              
            buttons[count].classList.add('line-top');         
        }

        oldCount = count;
    })

    window.addEventListener('wheel', (evt) => {
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
    });

})();