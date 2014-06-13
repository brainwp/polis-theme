<?php if( function_exists("register_field_group") ) {
	register_field_group(array (
		'id' => 'acf_publicacoes',
		'title' => 'Publicações',
		'fields' => array (
			array (
				'key' => 'field_539b14c906cd8',
				'label' => 'Autor da Publicação',
				'name' => 'publicacoes_autor',
				'type' => 'text',
				'instructions' => 'Adicione o autor da publicação',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'null',
							'operator' => '==',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'Autor',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_539b1c1b69a19',
				'label' => 'Ano de Publicação',
				'name' => 'publicacoes_ano',
				'type' => 'text',
				'instructions' => 'Adicione o ano de publicação',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'null',
							'operator' => '==',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'Ano de Publicação',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 4,
			),
			array (
				'key' => 'field_539b1c5b69a1a',
				'label' => 'Número de Páginas',
				'name' => 'publicacoes_paginas',
				'type' => 'text',
				'instructions' => 'Adicione a quantidade de páginas dessa publicação',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'null',
							'operator' => '==',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'Número de Páginas',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_539b2376cb730',
				'label' => 'Arquivo para Donwload',
				'name' => 'publicacoes_download',
				'type' => 'file',
				'instructions' => 'Adicione o arquivo da publicação em PDF para download.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'null',
							'operator' => '==',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'object',
				'library' => 'uploadedTo',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'publicacoes',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
?>