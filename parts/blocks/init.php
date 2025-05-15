<?php
	
	// регистрация Guthenberg блока
	function slider_register_blocks(): void {
		
		// Проверяем, что функция доступна.
		if ( function_exists( 'acf_register_block_type' ) ) {
			
			// Регистрируем блок рекомендаций.
			acf_register_block_type( [
				'name'            => 'slider',
				'title'           => __( 'Слайдер' ),
				'description'     => __( 'Swiper slider' ),
				'icon'            => 'format-gallery',
				'render_template' => '/parts/blocks/slider/slider.php',
				'enqueue_style'   => get_template_directory_uri() . '/parts/blocks/slider/slider.css',
				'enqueue_script'  => get_template_directory_uri() . '/parts/blocks/slider/slider.js',
				'category'        => 'formatting',
				'mode'            => 'edit'
			] );
		}
	}
	
	// регистрация Guthenberg блока
	function lid_register_blocks(): void {
		
		// Проверяем, что функция доступна.
		if ( function_exists( 'acf_register_block_type' ) ) {
			
			// Регистрируем блок рекомендаций.
			acf_register_block_type( [
				'name'            => 'gutenberg-lid',
				'title'           => __( 'Лид' ),
				'description'     => __( 'Первый абзац статьи' ),
				'icon'            => 'editor-paragraph',
				'render_template' => '/parts/blocks/lid/lid.php',
				'enqueue_style'   => get_template_directory_uri() . '/parts/blocks/lid/lid.css',
				'category'        => 'formatting',
				'mode'            => 'edit'
			] );
		}
	}
	
	// регистрация Guthenberg блока
	function separator_register_blocks(): void {
		
		// Проверяем, что функция доступна.
		if ( function_exists( 'acf_register_block_type' ) ) {
			
			// Регистрируем блок рекомендаций.
			acf_register_block_type( [
				'name'            => 'gutenberg-separator',
				'title'           => __( 'Разделитель абзацев' ),
				'description'     => __( 'Разделитель абзацев' ),
				'icon'            => 'image-flip-vertical',
				'render_template' => '/parts/blocks/separator/separator.php',
				'enqueue_style'   => get_template_directory_uri() . '/parts/blocks/separator/separator.css',
				'category'        => 'formatting',
				'mode'            => 'view'
			] );
		}
	}
	
	add_action( 'acf/init', 'slider_register_blocks' );
	add_action( 'acf/init', 'lid_register_blocks' );
	add_action( 'acf/init', 'separator_register_blocks' );
	
	if ( function_exists( 'acf_add_local_field_group' ) ):
		
		acf_add_local_field_group( [
			'key'                   => 'group_64c31e481c00d',
			'title'                 => 'Слайдер',
			'fields'                => [
				[
					'key'               => 'field_64c31e488f8fa',
					'label'             => 'Слайдер',
					'name'              => 'swiper-slider',
					'aria-label'        => '',
					'type'              => 'gallery',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => [
						'width' => '',
						'class' => '',
						'id'    => '',
					],
					'return_format'     => 'id',
					'library'           => 'all',
					'min'               => '',
					'max'               => '',
					'min_width'         => '',
					'min_height'        => '',
					'min_size'          => '',
					'max_width'         => '',
					'max_height'        => '',
					'max_size'          => '',
					'mime_types'        => '',
					'insert'            => 'append',
					'preview_size'      => 'medium',
				],
			],
			'location'              => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/slider',
					],
				],
			],
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
			'show_in_rest'          => 0,
		] );
	
		acf_add_local_field_group(array(
			'key' => 'group_654aeba48c16b',
			'title' => 'Лид',
			'fields' => array(
				array(
					'key' => 'field_654aeba456414',
					'label' => 'Лид',
					'name' => 'gutenberg-lid',
					'aria-label' => '',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'rows' => '',
					'placeholder' => '',
					'new_lines' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/gutenberg-lid',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'show_in_rest' => 0,
		));
	
		acf_add_local_field_group(array(
			'key' => 'group_654aeba48c239',
			'title' => 'Лид',
			'fields' => array(
				array(
					'key' => 'field_654aeba456j93',
					'label' => 'Разделитель абзацев',
					'name' => 'gutenberg-separator',
					'aria-label' => '',
					'type' => 'message',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'rows' => '',
					'placeholder' => '',
					'new_lines' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/gutenberg-separator',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'show_in_rest' => 0,
		));
	
	endif;
	

