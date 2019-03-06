<?php
/*
 * Template name: Blog
 */
?>
<?php get_header(); ?>

    <main class="main">

        <div class="wrapper-light">
            <div class="container news__container">
                <section class="news">

                <?php
                    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    query_posts("paged=$page");
                ?>
                <?php 
                    $posts = array(
                        // 'posts_per_page' => 8,
                        'paged' => $page
                    );
                    $postslist = new WP_Query( $posts );

                    if ($postslist->have_posts()) { 
                        while ($postslist->have_posts()) { 
                            $postslist->the_post(); ?>

                        <article class="blog__news-item news__news-item">
                            <h4 class="blog__news-title news__news-title"><?php the_title(); ?></h4>
                            <time class="blog__news-time news__news-time" datetime=""><?php the_time("d.m.Y"); ?></time>
                            <?php the_excerpt(); ?>
                            <a class="blog__more-info-news news4__more-info-news" href="<?php the_permalink(); ?>">Подробнее</a>
                        </article>

                        <?php }
                        the_posts_pagination(
                            array(
                                'show_all'     => false, // показаны все страницы участвующие в пагинации
                                'end_size'     => 1,     // количество страниц на концах
                                'mid_size'     => 1,     // количество страниц вокруг текущей
                                'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
                                'prev_text'    => __('«'),
                                'next_text'    => __('»'),
                                'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
                                'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
                                'screen_reader_text' => __( 'Posts navigation' ),
                            )
                        );
                    } else { ?>
                        <p>Нет постов по вашему запросу.</p>
                    <?php }
                ?>

                </section>

                <?php get_sidebar() ?>

                <!-- <section class="navigation">
                    <div class="search">
                        <input class="navigation__search search__input" type="text" name="search" placeholder="Поиск">
                    </div>
                    <div class="searchform">
                        <h3 class="searchform__title">Последние новости</h3>
                        <ul class="searchform__last-news">
                            <li class="last-news__item">
                                <a href="#" class="last-news__link">
                                    <h4 class="blog__news-title last-news__news-title">Заголовок</h4>
                                    <time class="blog__news-time last-news__news-time" datetime="2018-26-09">26.09.2018</time>
                                </a>
                            </li>
                            <li class="last-news__item">
                                <a href="#" class="last-news__link">
                                    <h4 class="blog__news-title last-news__news-title">Заголовок</h4>
                                    <time class="blog__news-time last-news__news-time" datetime="2018-26-09">26.09.2018</time>
                                </a>
                            </li>
                            <li class="last-news__item">
                                <a href="#" class="last-news__link">
                                    <h4 class="blog__news-title last-news__news-title">Заголовок</h4>
                                    <time class="blog__news-time last-news__news-time" datetime="2018-26-09">26.09.2018</time>
                                </a>
                            </li>
                        </ul>

                        <h3 class="searchform__title">Архив</h3>
                        <ul class="searchform__archive">
                            <li class="archive__item">
                                <a href="#" class="archive__link">
                                    Август 2018
                                </a>
                            </li>
                            <li class="archive__item">
                                <a href="#" class="archive__link">
                                    Сентябрь 2018
                                </a>
                            </li>
                            <li class="archive__item">
                                <a href="#" class="archive__link">
                                    Октябрь 2018
                                </a>
                            </li>
                        </ul>

                        <h3 class="searchform__title">Категории</h3>
                        <ul class="searchform__categories">
                            <li class="categories__item">
                                <a href="#" class="categories__link">
                                    Микроавтобусы
                                </a>
                            </li>
                            <li class="categories__item">
                                <a href="#" class="categories__link">
                                    Переезд
                                </a>
                            </li>
                            <li class="categories__item">
                                <a href="#" class="categories__link">
                                    Перевозки
                                </a>
                            </li>
                            <li class="categories__item">
                                <a href="#" class="categories__link">
                                    Пассажирские перевозки
                                </a>
                            </li>
                            <li class="categories__item">
                                <a href="#" class="categories__link">
                                    Без рубрики
                                </a>
                            </li>
                        </ul>
                    </div>
                </section> -->
            </div>
        </div>

<?php get_footer(); ?>