"use strict";

(function () {

    var productList = document.querySelector('.product-list');
    var productItemTemplate = document.querySelector('.template-product-item').content;
    var productListFragment = document.createDocumentFragment();

    // отрисовка элементов на странице
    var createElement = (data) => {
        data.forEach(element => {
            var productItemFragment = productItemTemplate.cloneNode(true);

            productItemFragment.querySelector('.article').textContent = element.article;
            productItemFragment.querySelector('h3 span').textContent = element.name;
            productItemFragment.querySelector('img').setAttribute('src', element.img);
            productItemFragment.querySelector('img').setAttribute('alt', element.name);
            productItemFragment.querySelector('.product-item-price span').textContent = element.cost + productItemFragment.querySelector('.product-item-price span').textContent;
    
            productListFragment.appendChild(productItemFragment);
        });
    
        productList.appendChild(productListFragment);

        window.basket();
    };
    
    // получаю json файл
    window.data;
    var xhr = new XMLHttpRequest();

    xhr.addEventListener('load', function () {
        window.data = JSON.parse(xhr.responseText);

        createElement(window.data);
    });

    xhr.open('GET', 'database.json');
    xhr.send();

})();