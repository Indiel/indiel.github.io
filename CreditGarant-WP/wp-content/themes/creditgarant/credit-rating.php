<?php
/*
 * Template name: Credit raiting
 */
?>
<?php get_header(); ?>

    <main class="main">
        <div class="container">
            <h1 class="main__h1">Ваш кредитный рейтинг</h1>
            
            <section class="online-order" id="order">
                <h2 class="online-order__title">Онлайн заказ отчета</h2>

                <form class="online-order__form" action="#" method="post">
                    <div class="online-order__list">
                        <p class="online-order__item">
                            <label class="visually-hidden" for="user-surname">Фамилия</label>
                            <input id="user-surname" class="input" type="text" name="surname" placeholder="Введите фамилию">
                        </p>
                        <p class="online-order__item">
                            <label class="visually-hidden" for="user-name">Имя</label>
                            <input id="user-name" class="input" type="text" name="name" placeholder="Введите имя">
                        </p>
                        <p class="online-order__item">
                            <label class="visually-hidden" for="user-passport">Серия и № паспорта</label>
                            <input id="user-passport" class="input" type="text" name="passport" placeholder="Серия и № паспорта">
                        </p>
                        <p class="online-order__item">
                            <label class="visually-hidden" for="user-email">E-mail</label>
                            <input id="user-email" class="input" type="email" name="email" placeholder="Ваш E-mail">
                        </p>
                    </div>
                    <p class="online-order__description">КРЕДИТНЫЙ РЕЙТИНГ МЫ ОТПРАВИМ НА ВАШУ ПОЧТУ В ТЕЧЕНИЕ 5 МИНУТ</p>
                    <p class="online-order__agreement">
                        <label class="agreement">
                            <input class="visually-hidden" type="checkbox" name="agreement">
                            <span class="checkbox-indicator"></span>
                            Я согласен с условиями <a class="agreement__link" href="#">Договора-оферты</a>
                        </label>
                    </p>
                    <div class="online-order__buttons">
                        <p class="buttons__item online-order__report">
                            <button class="button button-green online-order__button-order-report" type="submit">Получить разовый отчет</button>
                            <a href="#" class="online-order__link">Пример отчета</a>
                        </p>
                        <p class="buttons__item online-order__subscription">
                            <button class="button button-green online-order__button-order-subscription" type="submit">Подписка на 3 месяца</button>
                            <a href="#" class="online-order__link">Как работает подписка</a>
                        </p>
                    </div>
                </form>
            </section>
        </div>

        <div class="wrapper-light">
            <div class="container">
                <section class="advantages">
                    <h2 class="advantages__title">ЧТО ВАМ ДАСТ ЗНАНИЕ СВОЕГО КРЕДИТНОГО РЕЙТИНГА?</h2>

                    <div class="advantages-slider-container">
                        <ul class="advantages__list">
                            <li class="advantages__item">
                                <h4 class="advantages__item-title">Своевременное выявление мошеннических действий</h4>
                                <p>Взять, к примеру, оформление кредита по ксерокопии паспорта – за 2014 год случаи получения кредита таким незаконным способом увеличились на 23%.</p>
                            </li>
                            <li class="advantages__item">
                                <h4 class="advantages__item-title">Отсутствие проблем с картами, которые Вы не активировали</h4>
                                <p>Банки часто оформляют своим клиентам кредитные карты, которые даже без активизации могут числиться как действующий займ и отражаться в кредитном рейтинге.</p>
                            </li>
                            <li class="advantages__item">
                                <h4 class="advantages__item-title">Понимание причины, по которой банки отказывают Вам в предоставлении кредита</h4>
                                <p>В вашем рейтинге могут числиться просрочки или кредиты, о которых Вы просто забыли или вообще не знали.</p>
                            </li>
                            <li class="advantages__item">
                                <h4 class="advantages__item-title">Выявление ошибок, которые допустили сами банки</h4>
                                <p>Статистика говорит о том, что каждый третий кредитный рейтинг содержит ошибку, допущенную самим банком. Мы поможем исправить эти ошибки.</p>
                            </li>
                        </ul>
                    </div>

                    <button class="button button-green advantages__button-order-report" href="#order">Заказать отчет</button>
                </section>
            </div>
        </div>

<?php get_footer(); ?>