<?php
add_filter('show_admin_bar', '__return_false');

// Создаем экшн в котором подключаем стили подключенные внутри функции 
add_action( 'wp_enqueue_scripts', 'creditgarant_styles' );

// Заносим CSS стили в функцию 
function creditgarant_styles() {

    // Регистрирую стили
    wp_register_style( 'fonts', 'https://fonts.googleapis.com/css?family=Oswald:300,400,500,700&amp;subset=cyrillic', array());
    wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array());
    wp_register_style( 'jquery-ui', get_template_directory_uri() . '/css/jquery-ui.css', array());
    wp_register_style( 'chartist-min', get_template_directory_uri() . '/css/chartist.min.css', array('jquery-ui'));
    wp_register_style( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array('jquery-ui'));
    wp_register_style( 'style', get_template_directory_uri() . '/css/style.css', array());
    wp_register_style( 'media', get_template_directory_uri() . '/css/media.css', array('style'));

    // Подключаю стили
    wp_enqueue_style( 'main-style', get_stylesheet_uri());

    if ( is_page_template( 'index.php' ) ) {
        wp_enqueue_style( 'page-template', get_template_directory_uri() . '/css/page-template.css' );
    }
    wp_enqueue_style( 'fonts');
    wp_enqueue_style( 'normalize');
    wp_enqueue_style( 'jquery-ui');
    wp_enqueue_style( 'chartist-min');
    wp_enqueue_style( 'slick');
    wp_enqueue_style( 'style');
    wp_enqueue_style( 'media');

}

// Создаем экшн в котором подключаем скрипты подключенные внутри функции
add_action( 'wp_footer', 'creditgarant_scripts' );

// Заносим JS скрипты в функцию 
function creditgarant_scripts() {

    // Регистируем файл с JS скриптом
    wp_register_script( 'jquery-1.12.4', get_template_directory_uri() . '/js/jquery-1.12.4.js', array());
    wp_register_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui.js', array());
    
    wp_register_script( 'chartist-min',  get_template_directory_uri() . '/js/chartist.min.js', array('jquery-1.12.4','jquery-ui'));
    wp_register_script( 'graph',  get_template_directory_uri() . '/js/graph.js', array('jquery-1.12.4','jquery-ui'));
    wp_register_script( 'offers',  get_template_directory_uri() . '/js/offers.js', array('jquery-1.12.4','jquery-ui'));
    wp_register_script( 'menu',  get_template_directory_uri() . '/js/menu.js', array('jquery-1.12.4','jquery-ui'));
    wp_register_script( 'slick',  get_template_directory_uri() . '/js/slick.js', array('jquery-1.12.4','jquery-ui'));
    wp_register_script( 'sliders',  get_template_directory_uri() . '/js/sliders.js', array('jquery-1.12.4','jquery-ui'));
    
    wp_register_script( 'pin',  get_template_directory_uri() . '/js/pin.js', array('jquery-1.12.4','jquery-ui'));
    wp_register_script( 'accordion-faq',  get_template_directory_uri() . '/js/accordion-faq.js', array('jquery-1.12.4','jquery-ui'));
    
    // Подключаем файл с JS скриптом
    wp_enqueue_script( 'jquery-1.12.4');
    wp_enqueue_script( 'jquery-ui');

    // wp_enqueue_script( 'chartist-min');
    // wp_enqueue_script( 'graph');
    // wp_enqueue_script( 'offers');

    wp_enqueue_script( 'menu');

    // wp_enqueue_script( 'slick');
    // wp_enqueue_script( 'sliders');

    // if ( is_page_template( 'index.php' ) ) {
    //     wp_enqueue_script( 'chartist-min');
    //     wp_enqueue_script( 'graph');
    //     wp_enqueue_script( 'offers');
    //     wp_enqueue_script( 'slick');
    //     wp_enqueue_script( 'sliders');
    // }
    
    wp_enqueue_script( 'accordion-faq');

    wp_enqueue_script( 'chartist-min');
    wp_enqueue_script( 'graph');
    wp_enqueue_script( 'offers');
    wp_enqueue_script( 'slick');
    wp_enqueue_script( 'sliders');
    
    wp_enqueue_script( 'pin');
    // wp_enqueue_script( 'accordion-faq');
}



// Создаем экшн, в котором подключаем меню 
add_action( 'after_setup_theme', 'creditgarant_nav_menu' );

// Создаем функцию, в которой регистируем меню
function creditgarant_nav_menu() {
    register_nav_menu( 'main', 'Главное меню' );
    
    add_theme_support( 'post-thumbnails', array( 'post' ) ); 
}



// Создаем экшн, в котором подключаем сайдбар 
add_action( 'widgets_init', 'creditgarant_sidebar' );

// Создаем функцию, в которой регистируем сайдбар
function creditgarant_sidebar(){
	register_sidebar( array(
		'name'          => 'Search sidebar',
		'id'            => "search_sidebar",
		'description'   => 'Поиск по блогу',
		'class'         => '',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h3 class="widgettitle searchform__title">',
		'after_title'   => "</h3>\n",
	) );
}



// Создаем экшн, в котором подключаем пагинацию 
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );

// удаляет H2 из шаблона пагинации
function my_navigation_template( $template, $class ){
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

?>