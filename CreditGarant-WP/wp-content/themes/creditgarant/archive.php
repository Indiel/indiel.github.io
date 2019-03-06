<?php get_header(); ?>

    <main class="main">

        <div class="wrapper-light">
            <div class="container news__container">
                <section class="news">

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <article class="blog__news-item news__news-item">
                            <h4 class="blog__news-title news__news-title"><?php the_title(); ?></h4>
                            <time class="blog__news-time news__news-time" datetime=""><?php the_time("d.m.Y"); ?></time>
                            <?php the_excerpt(); ?>
                            <a class="blog__more-info-news news4__more-info-news" href="<?php the_permalink(); ?>">Подробнее</a>
                        </article>

                        
						<?php endwhile; ?>
						<?php
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
                        ); ?>
						<?php endif; ?>

                </section>

                <?php get_sidebar() ?>
			</div>
        </div>

<?php get_footer(); ?>