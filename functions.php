<?php

/**
 * Подключение блоков для редактора Gutenberg (создано с помощью плагина ACF)
 * Для добавления новых блоков - редатировать файл и папки по пути parts/blocks
 */
require_once 'parts/blocks/init.php';

/**
 * Стандартные функции при запуске проекта
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'main-style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/main.js', [ 'jquery' ],
		filemtime( get_stylesheet_directory() . '/main.js' ) );
} );
add_action( 'wp_head', function () {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
} );
add_filter( 'excerpt_length', function () {
	return 20;
} );
add_filter( 'excerpt_more', function ( $more ) {
	return '...';
} );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );

// Добавляем атрибуты rel к ссылке
function add_nofollow_to_custom_logo( $html ) {
	$html = str_replace( '<a ', '<a rel="noindex nofollow" ', $html );

	return $html;
}

add_filter( 'get_custom_logo', 'add_nofollow_to_custom_logo' );


/**
 * Обертка "Кота" для адимнки
 */
add_action( 'admin_head', function () {
	wp_enqueue_script( 'cat-script', get_template_directory_uri() . '/cat.js' );
} );

add_filter( 'login_headerurl', function () {
	return 'https://01cat.ru';
} );

add_action( 'login_header', function () { ?>
    <style>
        #login h1 a {
            background: url("logo.png") center top no-repeat !important;
            width: 111px !important;
            height: 180px !important;
        }
    </style>
<?php } );
add_filter( 'admin_footer_text', function () {
	return '<b>Сделано:</b>
			<a href="https://01cat.ru/" target="_blank">Двоичный кот</a>
			<br>
			<b>Техническая поддержка:</b> тел. <a href="tel:+79145416354">+7 (914) 541-63-54</a>, email: <a href="mailto:hello@01cat.ru">hello@01cat.ru</a>';
} );

/**
 * Создание страниц с опциями (контактные данные или дополнительные настройки сайта)
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( [
		'page_title' => 'Контактные данные',
		'menu_title' => 'Контактные данные',
		'menu_slug'  => 'theme-general-contacts',
		'capability' => 'edit_posts',
		'icon_url'   => 'dashicons-location-alt',
		'redirect'   => false,
		'position'   => '40',
	] );
}

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( [
		'page_title' => 'Дополнительные настройки сайта',
		'menu_title' => 'Дополнительные настройки сайта',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'icon_url'   => 'dashicons-admin-generic',
		'redirect'   => false,
		'position'   => '41',
	] );
}

/**
 * Регистрация меню в админке
 */
register_nav_menus( [
	'header-menu' => 'Меню в хедере',
] );
register_nav_menus( [
	'footer-menu' => 'Меню в футере',
] );

/**
 * Запрет деактивации плагинов (используется в основном для ACF плагинов)
 */
$important_plugins = [
	'advanced-custom-fields-pro/acf.php',
	'acf-theme-code-pro/acf_theme_code_pro.php',
];

add_filter( 'plugin_action_links', 'disable_plugin_deactivation', 10, 2 );
function disable_plugin_deactivation( $actions, $plugin_file ) {
	global $important_plugins;

	// Удаляет действие "Деактивировать" у важных для сайта плагинов
	if ( in_array( $plugin_file, $important_plugins ) ) {
		unset( $actions['deactivate'] );
		unset( $actions['edit'] );
		$actions['info'] = '<b class="musthave_js">Обязателен для сайта</b>';
	}

	return $actions;
}

/**
 * Удаляем групповые действия: деактивировать и удалить
 */
add_filter( 'admin_print_footer_scripts-plugins.php', 'disable_plugin_deactivation_hide_checkbox' );
function disable_plugin_deactivation_hide_checkbox( $actions ) {
	?>
    <script>
        jQuery(function ($) {
            $('.musthave_js').closest('tr').find('input[type="checkbox"]').remove();
        });
    </script>
	<?php
}

/**
 * Отключение уведомлений о доступных обновлениях для плагинов
 */
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );

function disable_plugin_updates( $value ) {
	global $important_plugins;

	if ( is_object( $value ) && isset( $value->response ) ) {
		foreach ( $value->response as $plugin_file => $plugin_data ) {
			if ( in_array( $plugin_file, $important_plugins ) ) {
				unset( $value->response[ $plugin_file ] );
			}
		}
	}

	return $value;
}

/**
 * Удаление дубликатов фото, неиспользуемых на сайте (для экономии места)
 */
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );

function delete_intermediate_image_sizes( $sizes ) {
	return array_diff( $sizes, [
		'large',
		'medium_large',
		'medium',
		'post-thumbnail',
		'1536x1536',
		'2048x2048',
	] );
}

/**
 * Проверка и подстановка ALT и TITLE в изображение (из админки - Медиафайлы)
 *
 * @param  integer  $imageID  - ID изображения
 * @param  string  $alternateALT  - alt, который будет использоваться, если не задан в админке
 * @param  string  $alternateTITLE  - title, который будет использоваться, если не задан в админке
 */
function checkAltTitle( int $imageID, string $alternateALT, string $alternateTITLE ): array {
	if ( get_post_meta( $imageID, '_wp_attachment_image_alt', true ) ):
		$nameALT = get_post_meta( $imageID, '_wp_attachment_image_alt', true );
	else:
		$nameALT = $alternateALT;
	endif;

	if ( get_post_field( 'post_title', $imageID ) ):
		$nameTITLE = get_post_field( 'post_title', $imageID );
	else:
		$nameTITLE = $alternateTITLE;
	endif;

	return [ 'alt' => $nameALT, 'title' => $nameTITLE ];
}

/**
 * Валидация форм Contact Form 7
 */
add_filter( 'wpcf7_validate', 'my_form_validate', 10, 2 );
function my_form_validate( $result, $tags ) {
	// Получим данные об отправляемой форме
	$form = WPCF7_Submission::get_instance();

	// Получаем данные полей
	$callbackName    = $form->get_posted_data( 'callback-name' );
	$callbackPhone   = $form->get_posted_data( 'callback-phone' );
	$callbackComment = $form->get_posted_data( 'callback-email' );
	$callbackFile    = $form->get_posted_data( 'callback-file' );
	$callbackLink    = $form->get_posted_data( 'callback-link' );

	// Проверяем результат
	if ( empty( $callbackName ) ) {
		$result->invalidate( 'callback-name', 'Это поле обязательно' );
	}

	if ( empty( $callbackPhone ) ) {
		$result->invalidate( 'callback-phone', 'Это поле обязательно' );
	}

	if ( empty( $callbackComment ) ) {
		$result->invalidate( 'callback-email', 'Это поле обязательно' );
	}

	if ( empty( $callbackFile ) && empty( $callbackLink ) ) {
		$result->invalidate( 'callback-link', 'Загрузите резюме или вставьте ссылку' );
	}
	// Если ссылка введена — проверим, действительно ли это URL
	if ( ! empty( $callbackLink ) && ! filter_var( $callbackLink, FILTER_VALIDATE_URL ) ) {
		$result->invalidate( 'callback-link', 'Пожалуйста, введите корректную ссылку на резюме' );
	}

	return $result;
}

/** Определяет, находится ли пользователь в указанной категории
 *
 * @param  integer  $id  - ID категории, присутствие на которой нужно узнать
 */
function is_cur_cat( int $id ): bool {
	$object = get_queried_object();

	return isset( $object->taxonomy ) && $object->term_id == $id;
}

/** Определяет, находится ли пользователь в указанной странице
 *
 * @param  integer  $id  - ID страницы, присутствие на которой нужно узнать
 */
function is_cur( int $id ): bool {
	$object = get_queried_object();

	return isset( $object->post_type ) && $object->ID == $id;
}

/** Определяет, находится ли пользователь в указанной категории или в любой дочерней ей категории
 *
 * @param  integer  $top_level_category_id  - ID категории верхнего уровня, присутствие на которой или на дочерних категориях которой нужно определить
 */
function is_in_category_or_child( int $top_level_category_id ): bool {
	$current_category = get_queried_object();       // Получаем текущую категорию
	$category_id      = $current_category->term_id; // Получаем ID текущей категории

	// Функция для проверки, является ли данная категория дочерней категорией указанной категории верхнего уровня
	function is_child_of_top_level_category( $category_id, $top_level_category_id ) {
		$category_ancestors = get_ancestors( $category_id, 'category' ); // Получаем всех предков данной категории

		return in_array( $top_level_category_id,
			$category_ancestors );  // Проверяем, есть ли указанная категория верхнего уровня среди предков
	}

	// Проверяем, находимся ли мы в указанной категории или в её дочерней категории
	if ( $category_id == $top_level_category_id || is_child_of_top_level_category( $category_id,
			$top_level_category_id ) ) {
		return true;
	}

	return false;
}

/** Выводит чистый номер телефона
 *
 * @param  string  $phone  - Номер телефона
 */
function clearPhone( string $phone ): string {
	$to_replace = [
		' ',
		'-',
		'(',
		')',
		'+',
		'&nbsp;',
		chr( 0xC2 ) . chr( 0xA0 ),
	];

	return str_replace( $to_replace, '', $phone );
}

/**
 * Возвращает тип текущей страницы или записи
 *
 * @return string Тип страницы или записи
 */
function get_current_post_type() {
	$post_type = '';

	if ( is_singular() ) {
		// Если это отдельная страница или запись
		if ( is_front_page() ) {
			$post_type = 'home';
		} else {
			$post_type = get_post_type( get_queried_object_id() );
		}
	} elseif ( is_archive() ) {
		// Если это архив
		if ( is_category() || is_tag() || is_tax() ) {
			$post_type = 'taxonomy';
		} elseif ( is_date() ) {
			$post_type = 'date';
		} elseif ( is_author() ) {
			$post_type = 'author';
		} else {
			$post_type = 'archive';
		}
	} elseif ( is_home() ) {
		// Если это главная страница
		$post_type = 'home';
	} elseif ( is_search() ) {
		// Если это страница поиска
		$post_type = 'search';
	} else {
		// Другие типы страниц
		$post_type = 'other';
	}

	return $post_type;
}

function global_mining_register_post_type() {
	$args = [
		'label'            => esc_html__( 'Новости' ),
		'labels'           => [
			'name'          => 'Новости',
			'singular_name' => 'Новость',
			'add_new_item'  => 'Добавить новость',
			'menu_name'     => 'Новости',
		],
		'supports'         => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
		'public'           => true,
		'public_queryable' => true,
		'show_ui'          => true,
		'show_in_menu'     => true,
		'has_archive'      => true,
		'rewrite'          => [ 'slug' => 'news' ],
		'show_in_rest'     => true,
		'menu_position'    => 20,
		'menu_icon'        => 'dashicons-welcome-write-blog',
	];
	register_post_type( 'news', $args );

	$args = [
		'label'            => esc_html__( 'Вакансии' ),
		'labels'           => [
			'name'          => 'Вакансии',
			'singular_name' => 'Вакансия',
			'add_new_item'  => 'Добавить вакансию',
			'menu_name'     => 'Вакансии',
		],
		'supports'         => [ 'title', 'editor', 'thumbnail' ],
		'public'           => true,
		'public_queryable' => true,
		'show_ui'          => true,
		'show_in_menu'     => true,
		'has_archive'      => true,
		'rewrite'          => [ 'slug' => 'vacancies' ],
		'show_in_rest'     => true,
		'menu_position'    => 21,
		'menu_icon'        => 'dashicons-admin-site-alt',
	];
	register_post_type( 'vacancies', $args );
}

add_action( 'init', 'global_mining_register_post_type' );

/* количество постов новостей на странице */
function global_mining_post_size( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( 'news' ) ) {
		$query->set( 'posts_per_page', 6 );
	}
	if ( $query->is_post_type_archive( 'vacancies' ) ) {
		$query->set( 'posts_per_page', 6 );
	}
}

add_action( 'pre_get_posts', 'global_mining_post_size' );
