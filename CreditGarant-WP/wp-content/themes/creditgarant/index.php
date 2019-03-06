<?php
/*
 * Template name: Main
 */
?>
<?php get_header(); ?>

    <main class="main">
        <div class="container">
            <h1 class="main__slogan">Рассчитаем для Вас<br> самые выгодные условия займа</h1>
            <p class="main__description">За 30 секунд с вероятностью выдачи 94+% по лучшим условиям</p>

            <a class="button button-green main__button" href="#">Получить кредит</a>
            <a class="button button-green main__button" href="<?php echo get_page_link( get_page_by_title( 'Кредитный рейтинг' ) ); ?>">Проверить кредитный рейтинг</a>
        </div>

        <div class="container offers-container">
            <div class="offers-slider-container">
                <ul class="offers slider-offers">
                    <li class="offers__item offer">
                        <div class="offers__item-container">
                            <div class="offer__top">
                                <p class="offer__img">
                                    <img src="<?php bloginfo('template_url') ?>/img/company-logo1.png" alt="Логотип компании">
                                </p>
                                <div class="offer__wrapper-compare">
                                    <div class="offer__rating">
                                        <img class="offer__stars-img" src="<?php bloginfo('template_url') ?>/img/stars-2.png"" alt="Рейтинг">
                                    </div>
                                    <button class="offer__compare button" type="button">Сравнить</button>
                                </div>
                            </div>
                            <div class="offer__middle">
                                <table class="offer__info middle__1">
                                    <tr>
                                        <td class="offer__description">Максимальная сумма</td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Максиимальный срок</td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент кредита</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Одобрение кредита</td>
                                        <td class="offer__value">36</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                </table>
                                <div class="offer__graph middle__2">
                                    <div class="small-graph"></div>
                                </div>
                                <table class="offer__calculation middle__3">
                                    <tr>
                                        <td class="offer__description offer__description--calculation">
                                            Cумма
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description offer__description--calculation">
                                            Cрок
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Сумма погашения</td>
                                        <td class="offer__value">200</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="offer__bottom">
                                <button class="offer__button--graph button" type="button">График</button>
                                <button class="offer__button--calculation button" type="button">Расчет</button>
                                <button class="offer__button--request button" type="button">Подать заявку</button>
                            </div>
                        </div>
                    </li>
                    <li class="offers__item offer">
                        <div class="offers__item-container">
                            <div class="offer__top">
                                <p class="offer__img">
                                    <img src="<?php bloginfo('template_url') ?>/img/company-logo2.png" alt="Логотип компании">
                                </p>
                                <div class="offer__wrapper-compare">
                                    <div class="offer__rating">
                                        <img class="offer__stars-img" src="<?php bloginfo('template_url') ?>/img/stars-2.png"" alt="Рейтинг">
                                    </div>
                                    <button class="offer__compare button" type="button">Сравнить</button>
                                </div>
                            </div>
                            <div class="offer__middle">
                                <table class="offer__info middle__1">
                                    <tr>
                                        <td class="offer__description">Максимальная сумма</td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Максиимальный срок</td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент кредита</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Одобрение кредита</td>
                                        <td class="offer__value">36</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                </table>
                                <div class="offer__graph middle__2">
                                    <div class="small-graph"></div>
                                </div>
                                <table class="offer__calculation middle__3">
                                    <tr>
                                        <td class="offer__description">
                                            Cумма
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">
                                            Cрок
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Сумма погашения</td>
                                        <td class="offer__value">200</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="offer__bottom">
                                <button class="offer__button--graph button" type="button">График</button>
                                <button class="offer__button--calculation button" type="button">Расчет</button>
                                <button class="offer__button--request button" type="button">Подать заявку</button>
                            </div>
                        </div>
                    </li>
                    <li class="offers__item offer">
                        <div class="offers__item-container">
                            <div class="offer__top">
                                <p class="offer__img">
                                    <img src="<?php bloginfo('template_url') ?>/img/company-logo1.png" alt="Логотип компании">
                                </p>
                                <div class="offer__wrapper-compare">
                                    <div class="offer__rating">
                                        <img class="offer__stars-img" src="<?php bloginfo('template_url') ?>/img/stars-2.png"" alt="Рейтинг">
                                    </div>
                                    <button class="offer__compare button" type="button">Сравнить</button>
                                </div>
                            </div>
                            <div class="offer__middle">
                                <table class="offer__info middle__1">
                                    <tr>
                                        <td class="offer__description">Максимальная сумма</td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Максиимальный срок</td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент кредита</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Одобрение кредита</td>
                                        <td class="offer__value">36</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                </table>
                                <div class="offer__graph middle__2">
                                    <div class="small-graph"></div>
                                </div>
                                <table class="offer__calculation middle__3">
                                    <tr>
                                        <td class="offer__description">
                                            Cумма
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">
                                            Cрок
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Сумма погашения</td>
                                        <td class="offer__value">200</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="offer__bottom">
                                <button class="offer__button--graph button" type="button">График</button>
                                <button class="offer__button--calculation button" type="button">Расчет</button>
                                <button class="offer__button--request button" type="button">Подать заявку</button>
                            </div>
                        </div>
                    </li>
                    <li class="offers__item offer">
                        <div class="offers__item-container">
                            <div class="offer__top">
                                <p class="offer__img">
                                    <img src="<?php bloginfo('template_url') ?>/img/company-logo2.png" alt="Логотип компании">
                                </p>
                                <div class="offer__wrapper-compare">
                                    <div class="offer__rating">
                                        <img class="offer__stars-img" src="<?php bloginfo('template_url') ?>/img/stars-2.png"" alt="Рейтинг">
                                    </div>
                                    <button class="offer__compare button" type="button">Сравнить</button>
                                </div>
                            </div>
                            <div class="offer__middle">
                                <table class="offer__info middle__1">
                                    <tr>
                                        <td class="offer__description">Максимальная сумма</td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Максиимальный срок</td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент кредита</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Одобрение кредита</td>
                                        <td class="offer__value">36</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                </table>
                                <div class="offer__graph middle__2">
                                    <div class="small-graph"></div>
                                </div>
                                <table class="offer__calculation middle__3">
                                    <tr>
                                        <td class="offer__description">
                                            Cумма
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">
                                            Cрок
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Сумма погашения</td>
                                        <td class="offer__value">200</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="offer__bottom">
                                <button class="offer__button--graph button" type="button">График</button>
                                <button class="offer__button--calculation button" type="button">Расчет</button>
                                <button class="offer__button--request button" type="button">Подать заявку</button>
                            </div>
                        </div>
                    </li>
                    <li class="offers__item offer">
                        <div class="offers__item-container">
                            <div class="offer__top">
                                <p class="offer__img">
                                    <img src="<?php bloginfo('template_url') ?>/img/company-logo2.png" alt="Логотип компании">
                                </p>
                                <div class="offer__wrapper-compare">
                                    <div class="offer__rating">
                                        <img class="offer__stars-img" src="<?php bloginfo('template_url') ?>/img/stars-2.png"" alt="Рейтинг">
                                    </div>
                                    <button class="offer__compare button" type="button">Сравнить</button>
                                </div>
                            </div>
                            <div class="offer__middle">
                                <table class="offer__info middle__1">
                                    <tr>
                                        <td class="offer__description">Максимальная сумма</td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Максиимальный срок</td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент кредита</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Одобрение кредита</td>
                                        <td class="offer__value">36</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                </table>
                                <div class="offer__graph middle__2">
                                    <div class="small-graph"></div>
                                </div>
                                <table class="offer__calculation middle__3">
                                    <tr>
                                        <td class="offer__description">
                                            Cумма
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">
                                            Cрок
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Сумма погашения</td>
                                        <td class="offer__value">200</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="offer__bottom">
                                <button class="offer__button--graph button" type="button">График</button>
                                <button class="offer__button--calculation button" type="button">Расчет</button>
                                <button class="offer__button--request button" type="button">Подать заявку</button>
                            </div>
                        </div>
                    </li>
                    <li class="offers__item offer">
                        <div class="offers__item-container">
                            <div class="offer__top">
                                <p class="offer__img">
                                    <img src="<?php bloginfo('template_url') ?>/img/company-logo1.png" alt="Логотип компании">
                                </p>
                                <div class="offer__wrapper-compare">
                                    <div class="offer__rating">
                                        <img class="offer__stars-img" src="<?php bloginfo('template_url') ?>/img/stars-2.png"" alt="Рейтинг">
                                    </div>
                                    <button class="offer__compare button" type="button">Сравнить</button>
                                </div>
                            </div>
                            <div class="offer__middle">
                                <table class="offer__info middle__1">
                                    <tr>
                                        <td class="offer__description">Максимальная сумма</td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Максиимальный срок</td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент кредита</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Одобрение кредита</td>
                                        <td class="offer__value">36</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                </table>
                                <div class="offer__graph middle__2">
                                    <div class="small-graph"></div>
                                </div>
                                <table class="offer__calculation middle__3">
                                    <tr>
                                        <td class="offer__description">
                                            Cумма
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">
                                            Cрок
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Сумма погашения</td>
                                        <td class="offer__value">200</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="offer__bottom">
                                <button class="offer__button--graph button" type="button">График</button>
                                <button class="offer__button--calculation button" type="button">Расчет</button>
                                <button class="offer__button--request button" type="button">Подать заявку</button>
                            </div>
                        </div>
                    </li>
                    <li class="offers__item offer">
                        <div class="offers__item-container">
                            <div class="offer__top">
                                <p class="offer__img">
                                    <img src="<?php bloginfo('template_url') ?>/img/company-logo2.png" alt="Логотип компании">
                                </p>
                                <div class="offer__wrapper-compare">
                                    <div class="offer__rating">
                                        <img class="offer__stars-img" src="<?php bloginfo('template_url') ?>/img/stars-2.png"" alt="Рейтинг">
                                    </div>
                                    <button class="offer__compare button" type="button">Сравнить</button>
                                </div>
                            </div>
                            <div class="offer__middle">
                                <table class="offer__info middle__1">
                                    <tr>
                                        <td class="offer__description">Максимальная сумма</td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Максиимальный срок</td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент кредита</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Одобрение кредита</td>
                                        <td class="offer__value">36</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                </table>
                                <div class="offer__graph middle__2">
                                    <div class="small-graph"></div>
                                </div>
                                <table class="offer__calculation middle__3">
                                    <tr>
                                        <td class="offer__description">
                                            Cумма
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">
                                            Cрок
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Сумма погашения</td>
                                        <td class="offer__value">200</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="offer__bottom">
                                <button class="offer__button--graph button" type="button">График</button>
                                <button class="offer__button--calculation button" type="button">Расчет</button>
                                <button class="offer__button--request button" type="button">Подать заявку</button>
                            </div>
                        </div>
                    </li>
                    <li class="offers__item offer">
                        <div class="offers__item-container">
                            <div class="offer__top">
                                <p class="offer__img">
                                    <img src="<?php bloginfo('template_url') ?>/img/company-logo1.png" alt="Логотип компании">
                                </p>
                                <div class="offer__wrapper-compare">
                                    <div class="offer__rating">
                                        <img class="offer__stars-img" src="<?php bloginfo('template_url') ?>/img/stars-2.png"" alt="Рейтинг">
                                    </div>
                                    <button class="offer__compare button" type="button">Сравнить</button>
                                </div>
                            </div>
                            <div class="offer__middle">
                                <table class="offer__info middle__1">
                                    <tr>
                                        <td class="offer__description">Максимальная сумма</td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Максиимальный срок</td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент кредита</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Одобрение кредита</td>
                                        <td class="offer__value">36</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                </table>
                                <div class="offer__graph middle__2">
                                    <div class="small-graph"></div>
                                </div>
                                <table class="offer__calculation middle__3">
                                    <tr>
                                        <td class="offer__description">
                                            Cумма
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">3000</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">
                                            Cрок
                                            <div class="slider-range-min"></div>
                                        </td>
                                        <td class="offer__value">31</td>
                                        <td class="offer__units">дней</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Процент</td>
                                        <td class="offer__value">1</td>
                                        <td class="offer__units">%</td>
                                    </tr>
                                    <tr>
                                        <td class="offer__description">Сумма погашения</td>
                                        <td class="offer__value">200</td>
                                        <td class="offer__units">грн</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="offer__bottom">
                                <button class="offer__button--graph button" type="button">График</button>
                                <button class="offer__button--calculation button" type="button">Расчет</button>
                                <button class="offer__button--request button" type="button">Подать заявку</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- <button class="button-leaf button-prev offer__button-prev" type="button"><span class="visually-hidden">Предыдущий</span></button>
            <button class="button-leaf button-next offer__button-next" type="button"><span class="visually-hidden">Следующий</span></button> -->
        </div>

        <div class="container">
            <section class="graph">
                <h2 class="graph__title">Крутой график на темном фоне</h2>
                <h3 class="graph__small-title">Сравнительный график показателей компаний</h3>

                <div class="graph__big-graph big-graph"></div>

                <svg height="0" xmlns="http://www.w3.org/2000/svg">
                    <filter id="glow">
                        <feGaussianBlur stdDeviation="5" result="coloredBlur"/>
                        <feMerge>
                            <feMergeNode in="coloredBlur"/>
                            <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>
                </svg>

                <p>Выберите до 4х компаний для сравнения</p>
                <ul class="graph__company-list">
                    <li class="graph__company-item graph__company-item--choice company-item--choice1"><button type="button">Moneyveo</button></li>
                    <li class="graph__company-item graph__company-item--choice company-item--choice2"><button type="button">Cashyou</button></li>
                    <li class="graph__company-item graph__company-item--choice company-item--choice3"><button type="button">Company name</button></li>
                    <li class="graph__company-item graph__company-item--choice company-item--choice4"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                    <li class="graph__company-item"><button type="button">Company name</button></li>
                </ul>
            </section>
        </div>

        <div class="wrapper-light">
            <div class="container">
                <section class="seo">
                    <h2 class="seo__title">Большой заголовок для Сео Текста</h2>
                    <h3 class="seo__small-title">Заголовок поменьше</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                 
                    <div class="seo__text-hidden">
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. labore et dolore magnam aliquam quaerat voluptatem.</p>
                    </div>
                    <button class="seo__button-hidden" type="button">Подробнее</button> 
                </section>
            </div>
        </div>

        <div class="wrapper-white">
            <div class="container">
                <section class="top">
                    <h2 class="top__title">Топ компаний</h2>
                    <h3 class="top__small-title">Лучшие компании</h3>

                    <a href="#" class="top__more-companies">больше компаний ></a>
                    <div class="top-slider-container">
                        <ul class="top__company-list slider">
                            <li class="top__company-item"><a href="#"><img src="<?php bloginfo('template_url') ?>/img/cashyou.png" alt=""></a></li>
                            <li class="top__company-item"><a href="#"><img src="<?php bloginfo('template_url') ?>/img/credit-plus.png" alt=""></a></li>
                            <li class="top__company-item"><a href="#"><img src="<?php bloginfo('template_url') ?>/img/creditup_logo.png" alt=""></a></li>
                            <li class="top__company-item"><a href="#"><img src="<?php bloginfo('template_url') ?>/img/moneyveo.png" alt=""></a></li>
                        </ul>
                    </div>

                    <!-- <button class="button-leaf button-prev top__button-prev" type="button"><span class="visually-hidden">Предыдущий</span></button>
                    <button class="button-leaf button-next top__button-next" type="button"><span class="visually-hidden">Следующий</span></button> -->
                </section>
            </div>
        </div>

        <div class="wrapper-light">
            <div class="container">
                <section class="blog">
                    <h2 class="blog__title">Блог</h2>
                    <h3 class="blog__small-title">Заголовок поменьше</h3>

                    <a href="<?php echo get_page_link( get_page_by_title( 'Блог' ) ); ?>" class="blog__more-news">больше новостей ></a>
                    <div class="blog-slider-container">
                        <div class="blog__news-list slider blog__slider">

                        <?php
                            // параметры по умолчанию
                            $posts = get_posts( array(
                                'numberposts' => 3,
                                'post_type'   => 'post'
                            ) );

                            foreach( $posts as $post ){
                                setup_postdata($post);
                                
                                ?>

                                <article class="blog__news-item">
                                    <h4 class="blog__news-title"><?php the_title(); ?></h4>
                                    <time class="blog__news-time" datetime=""><?php the_time("d.m.Y"); ?></time>
                                    <?php the_excerpt(); ?>
                                    <a class="blog__more-info-news" href="<?php the_permalink(); ?>">Подробнее</a>
                                </article>

                                <?php 
                            }

                            wp_reset_postdata(); // сброс
                        ?>

                            <!-- <article class="blog__news-item">
                                <h4 class="blog__news-title">Заголовок</h4>
                                <time class="blog__news-time" datetime="2018-26-09">26.09.2018</time>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariat</p>
                                <a class="blog__more-info-news" href="#">Подробнее</a>
                            </article>
                            <article class="blog__news-item">
                                <h4 class="blog__news-title">Заголовок</h4>
                                <time class="blog__news-time" datetime="2018-26-09">26.09.2018</time>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariat</p>
                                <a class="blog__more-info-news" href="#">Подробнее</a>
                            </article>
                            <article class="blog__news-item">
                                <h4 class="blog__news-title">Заголовок</h4>
                                <time class="blog__news-time" datetime="2018-26-09">26.09.2018</time>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariat</p>
                                <a class="blog__more-info-news" href="#">Подробнее</a>
                            </article> -->
                        </div>
                    </div>

                    <!-- <button class="button-leaf button-prev blog__button-prev" type="button"><span class="visually-hidden">Предыдущий</span></button>
                    <button class="button-leaf button-next blog__button-next" type="button"><span class="visually-hidden">Следующий</span></button> -->
                </section>
            </div>
        </div>

        <?php get_footer(); ?>
        