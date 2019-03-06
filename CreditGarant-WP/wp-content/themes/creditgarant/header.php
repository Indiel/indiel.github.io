<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,700&amp;subset=cyrillic" rel="stylesheet"> -->
    <!-- <link href="/css/normalize.css" rel="stylesheet"> -->

    <!-- <link href="/css/chartist.min.css" rel="stylesheet"> -->
    <!-- <script src="/js/chartist.min.js"></script> -->

    <!-- <link href="/css/jquery-ui.css" rel="stylesheet"> -->
    <!-- <script src="/js/jquery-1.12.4.js"></script> -->
    <!-- <script src=/js/jquery-ui.js"></script> -->

    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"> -->

    <!-- <link href="/css/style.css" rel="stylesheet"> -->
    <!-- <link href="/css/media.css" rel="stylesheet"> -->

    <title><?php echo wp_get_document_title(); ?></title>

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
            <?php 
            wp_nav_menu( array(
                'theme_location'=>'main',
                'container'=>null,
                'menu_class'=>'main-nav__list'
            ));
            ?>
            <!-- <ul class="main-nav__list">
                <li class="main-nav__item">
                    <a>Главная</a>
                </li>
                <li class="main-nav__item">
                    <a href="#">Список компаний</a>
                </li>
                <li class="main-nav__item">
                    <a href="/blog.php">Блог</a>
                </li>
                <li class="main-nav__item">
                    <a href="/FAQ.php">FAQ</a>
                </li>
                <li class="main-nav__item">
                    <a href="#">Контакты</a>
                </li>
            </ul> -->

            <!-- <div class="search">
                <input class="main-nav__search search__input" type="text" name="search" placeholder="Поиск">
            </div> -->
            <div class="registration">
                <button class="main-nav__registration button" type="button">Регистрация</button>
            </div>
        </nav>
    </header>