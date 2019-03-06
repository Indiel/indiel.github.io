<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'creditgarant');

/** Имя пользователя MySQL */
define('DB_USER', 'creditgarant');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '3919960506iva20');

/** Имя сервера MySQL */
define('DB_HOST', 'creditgarant');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')%<Hx&O~4+HiZ.yMIUx,{6sU;:W.G>JGEFl_42)(+aSw1xCd6DG)!J-7hK>:e(Uv');
define('SECURE_AUTH_KEY',  '`.P1_gR>4&Wa>5Frm7yU?ysxIS1fK4q=.WAIbxUu~aTBJy+.H^47G+7;o}[,ZICz');
define('LOGGED_IN_KEY',    '6+.62>!MGiYc>b7lJ3HK]@7wIa8#_79??|)lrA+6VV!zC%^9!%|$:^mXIJzT;-WT');
define('NONCE_KEY',        'o|1`HQuJCA._sF`KmI!KTA7,+nF&mmrXw/8`l9^}3E?%H;R.yfz4?#-r(IA,?yf,');
define('AUTH_SALT',        'NK FnAI2S1NSE(^IP5Tu;(0jH~:!Kj!$,?;|B+|pP{pKAlp0YA.ZkAkNQ!TA2ft&');
define('SECURE_AUTH_SALT', 't:bX]=a:!]1%3]VQ9EjLaD>ai]f6Xt0YrI;%* StqxPDnSd=xMp>W|TG%4aQL4r5');
define('LOGGED_IN_SALT',   'FF~7W%m|ID3`#$(S;^>`7P5)Pm<E]M~0u}bO}JnO w)&h4Ao%o ^4&,T$ aH(8l ');
define('NONCE_SALT',       'NZ5BxMb )[pQjw&(e!/ie(J )~*7WC!]g%oTv7{BKurAJE1k{Jb.]~w-zP`/!y_B');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
