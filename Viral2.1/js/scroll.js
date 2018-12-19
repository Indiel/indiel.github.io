window.scrolling = function () {
$(document).ready(function (){
    var ypos = 0;
    var yposCurrent;

    var sections = document.querySelectorAll('.anchor');
    // var sections = document.querySelectorAll('section');

    var heights = [];
    var offsets = [];

    var isAnimating  = false;

    var currentBlockIndex = 0; // current block index
    var previousBlockIndex = currentBlockIndex; // previous block index

    // getting block index
    var sectionNumber = function() {
        
        for (let i = 0; i < offsets.length; i++) {
            if (window.pageYOffset + 100 >= offsets[offsets.length - 1]) {
                currentBlockIndex = offsets.length - 1;
            } else if (window.pageYOffset + 100 >= offsets[i] && window.pageYOffset + 100 < offsets[i + 1]) {
                currentBlockIndex = i;
            }
        }
    };

    var buttonsNode = document.querySelectorAll('.progress-bar__item');
    var buttons = [];
    Array.from(buttonsNode).forEach((elem, i) => {
        buttons[i] = elem;
    });

    setTimeout(function() {
        Array.from(sections).forEach((elem, i) => {
            heights[i] = elem;
            offsets[i] = elem.offsetTop;
        });
        
        sectionNumber();
        buttons[currentBlockIndex].classList.add('line-bottom');
    
    }, 1500);

    window.addEventListener('scroll', () => {
        yposCurrent = window.pageYOffset;
        var delta = yposCurrent - ypos;
        if(delta < 0) delta*=-1;
        // console.log(delta);
        if(delta < 25) {
            return;
        } else {
            ypos = yposCurrent;
        }
        sectionNumber();
        // console.log('пиздык');

        if (window.pageYOffset + 100 >= offsets[offsets.length]) {
            for (let j = (buttons[previousBlockIndex].classList.length - 1); j >= 1; j--) {
                buttons[previousBlockIndex].classList.remove(buttons[previousBlockIndex].classList[j]);
            }
            buttons[currentBlockIndex].classList.add('line-bottom');
        } else if (currentBlockIndex > previousBlockIndex) {
            buttons[previousBlockIndex].classList.add('none-active-line-bottom');
            for (let j = (buttons[currentBlockIndex].classList.length - 1); j >= 1; j--) {
                buttons[currentBlockIndex].classList.remove(buttons[currentBlockIndex].classList[j]);
            }
            buttons[currentBlockIndex].classList.add('line-bottom');
        } else if (currentBlockIndex < previousBlockIndex) {
            for (let j = (buttons[currentBlockIndex].classList.length - 1); j >= 1; j--) {
                buttons[currentBlockIndex].classList.remove(buttons[currentBlockIndex].classList[j]);
            }
            for (let j = (buttons[previousBlockIndex].classList.length - 1); j >= 1; j--) {
                buttons[previousBlockIndex].classList.remove(buttons[previousBlockIndex].classList[j]);
            }              
            buttons[currentBlockIndex].classList.add('line-top');         
        }

        previousBlockIndex = currentBlockIndex;
    });

    // window.addEventListener('wheel', (evt) => {
    //     if (isAnimating) {
    //         return false;
    //     }

    //     for (var i = 0; i < offsets.length; i++) {
    //         if (window.pageYOffset + 100 >= offsets[offsets.length - 1]) {
    //             return;
    //         } else if (window.pageYOffset + 100 === offsets[i]) {
    //             evt.preventDefault();
    //             evt.stopPropagation();

    //             if (evt.wheelDelta < 0) {
    //                 isAnimating  = true;
    //                 $('html, body').animate({
    //                     scrollTop: offsets[i + 1] - 100
    //                 }, 500, 'swing', function(){
    //                     isAnimating  = false;
    //                 });
    //                 return;
    //             } else {
    //                 isAnimating  = true;
    //                 $('html, body').animate({
    //                     scrollTop: offsets[i - 1] - 100
    //                 }, 500, 'swing', function(){
    //                     isAnimating  = false;
    //                 });
    //                 return;
    //             }
    //         } else if (window.pageYOffset + 100 > offsets[i] && window.pageYOffset + 100 < offsets[i + 1]) {
    //             evt.preventDefault();
    //             evt.stopPropagation();

    //             if (evt.wheelDelta < 0) {
    //                 isAnimating  = true;
    //                 $('html, body').animate({
    //                     scrollTop: offsets[i + 1] - 100
    //                 }, 500, 'swing', function(){
    //                     isAnimating  = false;
    //                 });
    //                 return;
    //             } else {
    //                 isAnimating  = true;
    //                 $('html, body').animate({
    //                     scrollTop: offsets[i] - 100
    //                 }, 500, 'swing', function(){
    //                     isAnimating  = false;
    //                 });
    //                 return;
    //             }
    //         }
    //     }
    // });
});
};

/*(function () {

    var sections = document.querySelectorAll('section');

    var heights = [];
    var offsets = [];

    var isAnimating  = false;

    var count = 0; // current block index
    var oldCount = count; // previous block index

    // getting block index
    var sectionNumber = function() {
        for (let i = 0; i < offsets.length; i++) {
            if (window.pageYOffset + 100 >= offsets[offsets.length - 1]) {
                count = offsets.length - 1;
            } else if (window.pageYOffset + 100 >= offsets[i] && window.pageYOffset + 100 < offsets[i + 1]) {
                count = i;
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

   /* window.addEventListener('wheel', (evt) => {
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

})();*/