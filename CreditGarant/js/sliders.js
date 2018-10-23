'use strict';

(function () {

    function Slider (prevButton, nextButton, list, items) {
        this.prevButton = prevButton;
        this.nextButton = nextButton;

        this.list = list;
        this.items = items;

        this.shift = 0;
        this.elemNumber = 1; 

        this.nextButton.addEventListener('click', () => {
            this.shift -= this.list.clientWidth;
            this.elemNumber += 1;
            if (this.items.length < this.elemNumber) {
                this.elemNumber = 1;
                this.shift = 0;
            }
            this.list.style.left = this.shift + 'px';
        });

        this.prevButton.addEventListener('click', () => {
            this.shift += this.list.clientWidth;
            this.elemNumber -= 1;
            if (this.elemNumber <= 0) {
                this.elemNumber = this.items.length;
                this.shift = -this.list.clientWidth * (this.items.length - 1);
            }
            this.list.style.left = this.shift + 'px';
        });
    };
      
    var offer = new Slider (
        document.querySelector('.offer__button-prev'),
        document.querySelector('.offer__button-next'),
        document.querySelector('.offers'),
        document.querySelectorAll('.offers__item')
    );

    var top = new Slider (
        document.querySelector('.top__button-prev'),
        document.querySelector('.top__button-next'),
        document.querySelector('.top__company-list'),
        document.querySelectorAll('.top__company-item')
    );

    var blog = new Slider (
        document.querySelector('.blog__button-prev'),
        document.querySelector('.blog__button-next'),
        document.querySelector('.blog__news-list'),
        document.querySelectorAll('.blog__news-item')
    );

})();