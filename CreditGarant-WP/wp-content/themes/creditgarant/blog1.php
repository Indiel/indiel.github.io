<?php 
                        $posts = get_posts( array(
                            'numberposts' => -1,
                            'post_type'   => 'any'
                        ));
                        if (have_posts()) { 
                            while (have_posts()) { 
                                the_post(); ?>

                            <article class="blog__news-item news__news-item">
                                <h4 class="blog__news-title news__news-title"><?php the_title(); ?></h4>
                                <time class="blog__news-time news__news-time" datetime=""><?php the_date("d.m.Y"); ?></time>
                                <?php the_excerpt(); ?>
                                <a class="blog__more-info-news news4__more-info-news" href="<?php the_permalink(); ?>">Подробнее</a>
                            </article>

                            <?php }
                        } else { ?>
                            <p>Нет постов по вашему запросу.</p>
                        <?php }
                    ?>

<?php
                        
                        global $post;
                        $myposts = get_posts('numberposts=4');
                        foreach( $myposts as $post ){
                            setup_postdata( $post );
                            ?>

                            <article class="blog__news-item news__news-item">
                                <h4 class="blog__news-title news__news-title"><?php the_title(); ?></h4>
                                <time class="blog__news-time news__news-time" datetime=""><?php the_date("d.m.Y"); ?></time>
                                <?php the_excerpt(); ?>
                                <a class="blog__more-info-news news4__more-info-news" href="<?php the_permalink(); ?>">Подробнее</a>
                            </article>

                            <?php 
                        }
                        wp_reset_postdata();
                    ?>

<?php
$btpgid=get_queried_object_id();
$btmetanm=get_post_meta( $btpgid, 'WP_Catid','true' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array( 'posts_per_page' => 4, 'category_name' => $btmetanm,
'paged' => $paged,'post_type' => 'post' );
    $postslist = new WP_Query( $args );

    if ( $postslist->have_posts() ) :
        while ( $postslist->have_posts() ) : $postslist->the_post(); 
        ?>

        <article class="blog__news-item news__news-item">
            <h4 class="blog__news-title news__news-title"><?php the_title(); ?></h4>
            <time class="blog__news-time news__news-time" datetime=""><?php the_date("d.m.Y"); ?></time>
            <?php the_excerpt(); ?>
            <a class="blog__more-info-news news4__more-info-news" href="<?php the_permalink(); ?>">Подробнее</a>
        </article>

        <?php
        endwhile;  

        next_posts_link( 'Older Entries', $postslist->max_num_pages );
        previous_posts_link( 'Next Entries &raquo;' ); 
        the_posts_pagination();
        wp_reset_postdata();
    endif;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="<?php bloginfo('template_url') ?>/css/normalize.css" rel="stylesheet">

    <!-- <link href="css/chartist.min.css" rel="stylesheet"> -->
    <!-- <script src="js/chartist.min.js"></script> -->

    <link href="css/jquery-ui.css" rel="stylesheet">
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery-ui.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"> -->

    <link href="<?php bloginfo('template_url') ?>/css/style.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url') ?>/css/media.css" rel="stylesheet">

    <title>FAQ</title>

    <?php wp_head(); ?>
</head>
<body>
    <header class="header">
        <a href="<?php echo home_url(); ?>" class="header__logo">
            <img src="<?php bloginfo('template_url') ?>/img/logo.png" alt="Логотип CreditGarant" class="header__logo-img" width="236" height="60">
        </a>
        <button class="main-nav__button hamburger hamburger--slider" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
            <span class="visually-hidden">Меню</span>
        </button>
        <nav class="main-nav">
            <ul class="main-nav__list">
                <li class="main-nav__item">
                    <a href="<?php echo home_url(); ?>">Главная</a>
                </li>
                <li class="main-nav__item">
                    <a href="#">Список компаний</a>
                </li>
                <!-- <li class="main-nav__item">
                    <a href="#">Как это работает</a>
                </li> -->
                <li class="main-nav__item">
                    <a>Блог</a>
                </li>
                <li class="main-nav__item">
                    <a href="../FAQ.html">FAQ</a>
                </li>
                <li class="main-nav__item">
                    <a href="#">Контакты</a>
                </li>
                <!-- <li class="main-nav__item search">
                    <input class="main-nav__search search__input" type="text" name="search" placeholder="Поиск">
                </li>
                <li class="main-nav__item registration">
                    <button class="main-nav__registration button" type="button">Регистрация</button>
                </li> -->
            </ul>

            <!-- <div class="search">
                <input class="main-nav__search search__input" type="text" name="search" placeholder="Поиск">
            </div> -->
            <div class="registration">
                <button class="main-nav__registration button" type="button">Регистрация</button>
            </div>
        </nav>
    </header>


    <main class="main">

        <div class="wrapper-light">
            <div class="container">
                <section class="faq">
                    <h2 class="faq__title">Как это работает?</h2>

                    <h3 class="faq__category">Категория</h3>
                    <div class="faq__questions accordion">
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">CashYou — це онлайн сервіс з мікрокредитування, побудованій завдяки найсучаснішим технологіям, який дозволяє отримати кредит на Вашу персональну банківську картку в зручний для Вас час. Час приймання заявок — 24/7, час роботи сервісу — кожен день з 09:00 до 20:00.</div>

                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На рішення системи впливає Ваш кредитний рейтинг, історія попередніх кредитних операцій, сума, термін, а також Ваш фінансовий стан.</div>
    
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">Термін кредиту може складати від 1-го до 30-ти календарних днів. Максимальна сума кредиту — до 12 000 гривень. Сума та термін кредиту залежать від того, наскільки довго Ви користуєтесь системою CashYou та Вашого статусу у «Бонусній програмі». Ви можете змінити ці показники власноруч у Вашому «Особистому кабінеті».</div>
                        
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">Це тризначний код на зворотній стороні Вашої банківської картки. Використовується виключно для перевірки справжності картки, за будь-яких операціях в інтернеті. Ми не зберігаємо цей код у себе, він використовується тільки через перевірену платіжну систему.</div>
            
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На третій день після дати виплати кредиту, зазначеної в договорі Вам буде нараховуватися штрафна вiдсоткова ставка за кожен день прострочення, до моменту погашення або пролонгації.</div>
                
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">CashYou — це онлайн сервіс з мікрокредитування, побудованій завдяки найсучаснішим технологіям, який дозволяє отримати кредит на Вашу персональну банківську картку в зручний для Вас час. Час приймання заявок — 24/7, час роботи сервісу — кожен день з 09:00 до 20:00.</div>

                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На рішення системи впливає Ваш кредитний рейтинг, історія попередніх кредитних операцій, сума, термін, а також Ваш фінансовий стан.</div>
    
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">Термін кредиту може складати від 1-го до 30-ти календарних днів. Максимальна сума кредиту — до 12 000 гривень. Сума та термін кредиту залежать від того, наскільки довго Ви користуєтесь системою CashYou та Вашого статусу у «Бонусній програмі». Ви можете змінити ці показники власноруч у Вашому «Особистому кабінеті».</div>
                        
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">Це тризначний код на зворотній стороні Вашої банківської картки. Використовується виключно для перевірки справжності картки, за будь-яких операціях в інтернеті. Ми не зберігаємо цей код у себе, він використовується тільки через перевірену платіжну систему.</div>
            
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На третій день після дати виплати кредиту, зазначеної в договорі Вам буде нараховуватися штрафна вiдсоткова ставка за кожен день прострочення, до моменту погашення або пролонгації.</div>
            
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">CashYou — це онлайн сервіс з мікрокредитування, побудованій завдяки найсучаснішим технологіям, який дозволяє отримати кредит на Вашу персональну банківську картку в зручний для Вас час. Час приймання заявок — 24/7, час роботи сервісу — кожен день з 09:00 до 20:00.</div>

                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На рішення системи впливає Ваш кредитний рейтинг, історія попередніх кредитних операцій, сума, термін, а також Ваш фінансовий стан.</div>
    
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">Термін кредиту може складати від 1-го до 30-ти календарних днів. Максимальна сума кредиту — до 12 000 гривень. Сума та термін кредиту залежать від того, наскільки довго Ви користуєтесь системою CashYou та Вашого статусу у «Бонусній програмі». Ви можете змінити ці показники власноруч у Вашому «Особистому кабінеті».</div>
                        
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">Це тризначний код на зворотній стороні Вашої банківської картки. Використовується виключно для перевірки справжності картки, за будь-яких операціях в інтернеті. Ми не зберігаємо цей код у себе, він використовується тільки через перевірену платіжну систему.</div>
            
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На третій день після дати виплати кредиту, зазначеної в договорі Вам буде нараховуватися штрафна вiдсоткова ставка за кожен день прострочення, до моменту погашення або пролонгації.</div>
                    </div>

                    <h3 class="faq__category">Категория</h3>
                    <div class="faq__questions accordion">
                    
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">CashYou — це онлайн сервіс з мікрокредитування, побудованій завдяки найсучаснішим технологіям, який дозволяє отримати кредит на Вашу персональну банківську картку в зручний для Вас час. Час приймання заявок — 24/7, час роботи сервісу — кожен день з 09:00 до 20:00.</div>

                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На рішення системи впливає Ваш кредитний рейтинг, історія попередніх кредитних операцій, сума, термін, а також Ваш фінансовий стан.</div>
    
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">Термін кредиту може складати від 1-го до 30-ти календарних днів. Максимальна сума кредиту — до 12 000 гривень. Сума та термін кредиту залежать від того, наскільки довго Ви користуєтесь системою CashYou та Вашого статусу у «Бонусній програмі». Ви можете змінити ці показники власноруч у Вашому «Особистому кабінеті».</div>
                        
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На третій день після дати виплати кредиту, зазначеної в договорі Вам буде нараховуватися штрафна вiдсоткова ставка за кожен день прострочення, до моменту погашення або пролонгації.</div>
                
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">CashYou — це онлайн сервіс з мікрокредитування, побудованій завдяки найсучаснішим технологіям, який дозволяє отримати кредит на Вашу персональну банківську картку в зручний для Вас час. Час приймання заявок — 24/7, час роботи сервісу — кожен день з 09:00 до 20:00.</div>

                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">На рішення системи впливає Ваш кредитний рейтинг, історія попередніх кредитних операцій, сума, термін, а також Ваш фінансовий стан.</div>
    
                        <h4 class="faq__question">
                            Текст вопроса
                            <button type="button" class="faq__close-button"></button>
                        </h4>
                        <div class="faq__answer">Термін кредиту може складати від 1-го до 30-ти календарних днів. Максимальна сума кредиту — до 12 000 гривень. Сума та термін кредиту залежать від того, наскільки довго Ви користуєтесь системою CashYou та Вашого статусу у «Бонусній програмі». Ви можете змінити ці показники власноруч у Вашому «Особистому кабінеті».</div>
                        
                    </div>

                </section>
            </div>
        </div>


        <div class="container">
            <footer class="footer">
                <div class="footer__top">
                    <ul class="footer__social social-button-list">
                        <li class="social-button-item">
                            <a class="social-button" href="#">
                                <span class="visually-hidden">Фейсбук</span>
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="8px" height="14px">
                                    <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                                    d="M7.698,-0.006 L5.778,-0.009 C3.622,-0.009 2.228,1.346 2.228,3.442 L2.228,5.033 L0.298,5.033 C0.131,5.033 -0.003,5.161 -0.003,5.319 L-0.003,7.623 C-0.003,7.782 0.132,7.909 0.298,7.909 L2.228,7.909 L2.228,13.726 C2.228,13.884 2.363,14.011 2.530,14.011 L5.048,14.011 C5.215,14.011 5.350,13.884 5.350,13.726 L5.350,7.909 L7.606,7.909 C7.773,7.909 7.908,7.782 7.908,7.623 L7.909,5.319 C7.909,5.243 7.877,5.171 7.820,5.117 C7.764,5.063 7.687,5.033 7.607,5.033 L5.350,5.033 L5.350,3.684 C5.350,3.036 5.513,2.707 6.404,2.707 L7.697,2.707 C7.864,2.707 7.999,2.578 7.999,2.421 L7.999,0.280 C7.999,0.122 7.864,-0.006 7.698,-0.006 Z"/>
                                </svg>
                            </a>
                        </li>
                        <li class="social-button-item">
                            <a class="social-button" href="#">
                                <span class="visually-hidden">Инстаграм</span>
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="16px" height="16px">
                                    <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                                    d="M11.585,16.004 L4.409,16.004 C1.972,16.004 -0.011,14.022 -0.011,11.585 L-0.011,4.408 C-0.011,1.971 1.972,-0.011 4.409,-0.011 L11.585,-0.011 C14.022,-0.011 16.005,1.971 16.005,4.408 L16.005,11.585 C16.005,14.022 14.022,16.004 11.585,16.004 ZM14.583,11.585 L14.583,4.408 C14.583,2.754 13.238,1.409 11.585,1.409 L4.409,1.409 C2.755,1.409 1.410,2.754 1.410,4.408 L1.410,11.585 C1.410,13.238 2.755,14.583 4.409,14.583 L11.585,14.583 C13.238,14.583 14.584,13.238 14.584,11.585 L14.583,11.585 ZM12.297,4.749 C12.023,4.749 11.754,4.637 11.561,4.444 C11.366,4.249 11.255,3.981 11.255,3.707 C11.255,3.431 11.366,3.163 11.561,2.970 C11.754,2.776 12.023,2.664 12.297,2.664 C12.571,2.664 12.840,2.776 13.034,2.970 C13.228,3.163 13.339,3.431 13.339,3.707 C13.339,3.981 13.228,4.249 13.034,4.444 C12.839,4.637 12.571,4.749 12.297,4.749 ZM7.997,12.124 C5.721,12.124 3.870,10.272 3.870,7.996 C3.870,5.720 5.721,3.870 7.997,3.870 C10.272,3.870 12.124,5.720 12.124,7.996 C12.124,10.272 10.272,12.124 7.997,12.124 ZM7.997,5.290 C6.505,5.290 5.291,6.504 5.291,7.996 C5.291,9.488 6.505,10.701 7.997,10.701 C9.489,10.701 10.703,9.488 10.703,7.996 C10.703,6.504 9.489,5.290 7.997,5.290 Z"/>
                                </svg>
                            </a>
                        </li>
                        <li class="social-button-item">
                            <a class="social-button" href="#">
                                <span class="visually-hidden">Твиттер</span>
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="15px" height="13px">
                                    <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                                    d="M14.582,0.244 C13.987,0.620 13.328,0.893 12.627,1.040 C12.066,0.401 11.267,0.004 10.382,0.004 C8.682,0.004 7.304,1.474 7.304,3.285 C7.304,3.542 7.332,3.793 7.384,4.032 C4.827,3.896 2.560,2.589 1.042,0.603 C0.777,1.088 0.626,1.651 0.626,2.253 C0.626,3.392 1.170,4.397 1.994,4.984 C1.490,4.967 1.016,4.819 0.601,4.573 L0.601,4.614 C0.601,6.204 1.662,7.529 3.068,7.833 C2.811,7.907 2.539,7.948 2.258,7.948 C2.059,7.948 1.867,7.926 1.679,7.888 C2.070,9.191 3.206,10.141 4.552,10.168 C3.500,11.048 2.172,11.572 0.731,11.572 C0.483,11.572 0.238,11.556 -0.003,11.527 C1.359,12.458 2.976,13.001 4.714,13.001 C10.373,13.001 13.468,8.000 13.468,3.663 L13.458,3.238 C14.061,2.777 14.584,2.199 14.996,1.541 C14.444,1.802 13.852,1.979 13.229,2.059 C13.865,1.652 14.352,1.008 14.582,0.244 Z"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <p class="visually-hidden">Телефоны: </p>
                    <ul class="footer__tel-list">
                        <li class="footer__tel-item"><a href="tel:+380631234567">+380 63 123 45 67</a></li>
                        <li class="footer__tel-item"><a href="tel:+380631234567">+380 63 123 45 67</a></li>
                        <li class="footer__tel-item"><a href="tel:+380631234567">+380 63 123 45 67</a></li>
                    </ul>
                    <button class="footer__callback button">Обратный звонок</button>
                </div>
                <div class="footer__copyright">
                    <span>© Credit garant 2018</span>
                    <span>Created by <span class="viral">VIRAL</span></span>
                </div>
            </footer>
        </div>
    </main>
    
    <!-- <script src="js/graph.js"></script> -->
    <!-- <script src="js/offers.js"></script> -->
    <script src="js/menu.js"></script>
    
    <!-- <script type="text/javascript" src="js/slick.js"></script> -->
    <!-- <script src="js/sliders.js"></script> -->

    <?php wp_footer(); ?>
</body>
</html>