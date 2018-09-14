"use strict";

window.basket = function () {

    var arrSelectedProducts = [];
    var addButtons = document.querySelectorAll('.product-item-add');

    // вешаем событие на кнопку добавления в корзину
    Array.from(addButtons).forEach(element => {
        element.addEventListener('click', evt => {
            evt.preventDefault();

            var elemArticle = Number(evt.target.parentElement.children[0].textContent);

            if (element.classList.contains('product-item-add-plus')) {
                arrSelectedProducts.push(window.data[elemArticle - 1]);
                createFragment(window.data[elemArticle - 1]);

                element.classList.remove('product-item-add-plus');
            } else {
                for (let j = 0; j < arrSelectedProducts.length; j++) {
                    if (arrSelectedProducts[j].article === elemArticle) {

                        element.classList.add('product-item-add-plus');
                        Array.from(table.querySelectorAll('tr')).forEach(element => {
                            if (arrSelectedProducts[j].article === Number(element.querySelector('.article').textContent)) {
                                table.removeChild(element);

                                totalValue -= Number(element.querySelector('.product-value').textContent);
                                basketResult.textContent = totalValue;
                            }
                        });
                        arrSelectedProducts.splice(j, 1);
                        
                        break;
                    }
                }
            }

            showBasket();
        });
    });

    // валидация
    var onProductAmountChange = (evt, element) => {;

        var introduced = evt.target.value.replace(/[^\d.,]/g, ''); // удаляем все, кроме цифр, точки и запятой
        introduced = introduced.replace(',', '.'); // заменяем зпятую на точку
        introduced = introduced.replace(/^([^\.]*\.)|\./g, '$1'); // позволяем вводить только одну точку, остальные удаляем

        var position = introduced.indexOf('.');
        if (introduced > 100) {
            introduced = introduced.slice(0, -1);
        } 
        if (position !== -1) { // если точка есть
            if((introduced.length - position) > 2) { // проверяем, сколько знаков после точки, если больше 1-го то
                introduced = introduced.slice(0, -1); // удаляем лишнее
            }
        } 

        evt.target.value = introduced;

        element.value = Math.round(evt.target.value * element.cost);
        evt.target.parentElement.parentElement.querySelector('.product-value').textContent = element.value;

        totalValue = 0;
        Array.from(table.querySelectorAll('.product-value')).forEach( elem => {
            totalValue += Math.round(Number(elem.textContent));
        });
        basketResult.textContent = totalValue;
    };

    var totalValue = 0;
    var basketResult = document.querySelector('.result span');

    var basketTrTemplate = document.querySelector('.basket-tr-template').content;
    var table = document.querySelector('.modal-basket table');

    // создаем элементы в корзине
    var createFragment = (element) => {

        var basketTrFragment = basketTrTemplate.cloneNode(true);
    
        basketTrFragment.querySelector('.article').textContent = element.article;
        basketTrFragment.querySelector('img').setAttribute('src', element.img);
        basketTrFragment.querySelector('img').setAttribute('alt', element.name);
        basketTrFragment.querySelector('.product-name').textContent = element.name;
        basketTrFragment.querySelector('.product-price').textContent = element.cost;
        basketTrFragment.querySelector('.product-value').textContent = element.cost * Number(basketTrFragment.querySelector('.product-amount').value);

        element.value = Number(basketTrFragment.querySelector('.product-value').textContent);
        totalValue += element.value;

        table.appendChild(basketTrFragment);
        basketResult.textContent = totalValue;

        var product = table.lastElementChild;
        var productAmount = product.querySelector('.product-amount');

        productAmount.addEventListener('keyup', (evt) => {
            onProductAmountChange(evt, element);
        });
    };

    // реализация кнопки удаления из списка в таблице выбранных товаров
    table.addEventListener('click', evt => {
        evt.preventDefault();

        if (evt.target.tagName === 'BUTTON') {

            var elemArticle = Number(evt.target.parentElement.children[0].textContent);

            for (let i = 0; i < arrSelectedProducts.length; i++) {
                if (arrSelectedProducts[i].article === elemArticle) {
                    arrSelectedProducts.splice(i, 1);

                    addButtons[elemArticle - 1].classList.add('product-item-add-plus');
                    evt.target.parentElement.parentElement.parentElement.removeChild(evt.target.parentElement.parentElement);

                    totalValue -= Number(evt.target.parentElement.parentElement.querySelector('.product-value').textContent);
                    basketResult.textContent = totalValue;

                    showBasket();

                    break;
                }
            }
        }

    });

    // проверка склонения
    var getDeclension = (arrLength) => {
        var strAmount;
        if (arrLength % 100 >= 11 && arrLength % 100 <= 19) {
            strAmount = ' товаров';
        } else {
            switch (arrLength % 10) {
                case 1: strAmount = ' товар';
                    break;
                case 2:
                case 3:
                case 4: strAmount = ' товара';
                    break;
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 0: strAmount = ' товаров';
                    break;
            }
        }
        return strAmount;
    };

    var madalBasket = document.querySelector('.modal-basket');
    var liBasket = document.querySelector('.user-nav .basket');

    // надпись на корзине
    var showBasket = () => {
        if (arrSelectedProducts.length !== 0) {
            madalBasket.classList.remove('hide-basket');
            liBasket.querySelector('.amount-products').textContent = arrSelectedProducts.length + getDeclension(arrSelectedProducts.length);
        } else {
            madalBasket.classList.add('hide-basket');
            liBasket.querySelector('.amount-products').textContent = 'Пусто';
        }
    };

    showBasket();

};