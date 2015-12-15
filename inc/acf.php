<?php
require get_template_directory() . '/inc/advanced-custom-fields/acf.php';
add_action('acf/register_fields', 'my_register_fields');
function my_register_fields()
{
    include_once(get_template_directory() . '/inc/acf-repeater/repeater.php');
	//include_once(get_template_directory() . '/inc/acf-hidden/acf-hidden.php');
}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_hidden-user',
		'title' => 'hidden user',
		'fields' => array (
			array (
				'key' => 'field_5421759553174',
				'label' => 'hidden_user',
				'name' => 'hidden-user',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_user',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_area',
        'title' => 'Area',
        'fields' => array(
            array(
                'key' => 'field_area_acf',
                'label' => 'Area',
                'name' => 'area',
                'type' => 'select',
                'required' => 1,
                'choices' => '',
                'default_value' => 'Institucional',
                'allow_null' => 0,
                'multiple' => 0
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'ef_user',
                    'operator' => '==',
                    'value' => 'all',
                    'order_no' => 0,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));

    register_field_group(array(
        'id' => 'acf_cargo',
        'title' => 'Cargo',
        'fields' => array(
            array(
                'key' => 'field_539f30f6f38bd',
                'label' => 'Cargo',
                'name' => 'cargo',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => ''
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'ef_user',
                    'operator' => '==',
                    'value' => 'all',
                    'order_no' => 0,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));
    register_field_group(array(
        'id' => 'acf_e-privado-se-ativado-somente-membros-logados-poderao-ver',
        'title' => 'É privado? (Se ativado somente membros logados poderão ver)',
        'fields' => array(
            array(
                'key' => 'field_538dcab58cb92',
                'label' => 'Selecione:',
                'name' => 'isprivate',
                'type' => 'select',
                'choices' => array(
                    'nao' => 'Não',
                    'sim' => 'Sim'
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'ef_media',
                    'operator' => '!=',
                    'value' => 'all',
                    'order_no' => 1,
                    'group_no' => 0
                ),
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));
    register_field_group(array(
        'id' => 'acf_e-mail',
        'title' => 'E-mail',
        'fields' => array(
            array(
                'key' => 'field_539f3a8e3ca5f',
                'label' => 'E-mail (Publico)',
                'name' => 'email',
                'type' => 'email',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => ''
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'ef_user',
                    'operator' => '==',
                    'value' => 'all',
                    'order_no' => 0,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));
    register_field_group(array(
        'id' => 'acf_links-relacionados',
        'title' => 'Links Relacionados',
        'fields' => array(
            array(
                'key' => 'field_539f3f9eff50c',
                'label' => 'Links Relacionados',
                'name' => 'links_user',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_539f40a5ff50e',
                        'label' => 'Descrição do link',
                        'name' => 'texto_url',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => ''
                    ),
                    array(
                        'key' => 'field_539f48aea3917',
                        'label' => 'Endereco',
                        'name' => 'endereco_user_link',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => ''
                    )
                ),
                'row_min' => 1,
                'row_limit' => 99999,
                'layout' => 'table',
                'button_label' => 'Adicionar mais um campo'
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'ef_user',
                    'operator' => '==',
                    'value' => 'all',
                    'order_no' => 0,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));
    register_field_group(array(
        'id' => 'acf_telefone',
        'title' => 'Telefone',
        'fields' => array(
            array(
                'key' => 'field_539f389861172',
                'label' => 'Telefone',
                'name' => 'telefone',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'ef_user',
                    'operator' => '==',
                    'value' => 'all',
                    'order_no' => 0,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));
    register_field_group(array(
        'id' => 'acf_twitter',
        'title' => 'Twitter',
        'fields' => array(
            array(
                'key' => 'field_539f3a0eef24b',
                'label' => 'Twitter',
                'name' => 'twitter',
                'type' => 'text',
                'instructions' => 'Digite somente o nome de usuário, sem @',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => ''
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'ef_user',
                    'operator' => '==',
                    'value' => 'all',
                    'order_no' => 0,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));
}
if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_tipo-de-publicacao',
        'title' => 'Tipo de Publicação',
        'fields' => array(
            array(
                'key' => 'field_53b1c1d1453d3',
                'label' => 'Isso é',
                'name' => 'publicacoes_qual_tipo',
                'type' => 'radio',
                'required' => 1,
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '=='
                        )
                    ),
                    'allorany' => 'all'
                ),
                'choices' => array(
                    'biblioteca' => 'Biblioteca',
                    'arquivistica' => 'Docmentação Arquivística'
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'vertical'
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'publicacoes',
                    'order_no' => 0,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));
}
if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_publicacoes',
        'title' => 'Publicações',
        'fields' => array(
            array(
                'key' => 'field_538f2564122f9',
                'label' => 'Arquivo para Download',
                'name' => 'publicacoes_download',
                'type' => 'file',
                'instructions' => 'Adicione a Publicação para download',
                'save_format' => 'id',
                'library' => 'all'
            ),
            array(
                'key' => 'field_53ac790835733',
                'label' => 'Link Externo',
                'name' => 'publicacoes_link_externo',
                'type' => 'text',
                'instructions' => 'Adicione um externo link para algo relacionado a essa Publicação.',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '==',
                            'value' => ''
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_53bee486343d5',
                'label' => 'Link Interno',
                'name' => 'publicacao_link_interno',
                'type' => 'text',
                'instructions' => 'Adicione um link interno para algo relacionado a essa Publicação.',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_53ac797a35734',
                'label' => 'ISBN',
                'name' => 'publicacoes_isbn',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => ''
            ),
            array(
                'key' => 'field_53ac79c035735',
                'label' => 'ISSN',
                'name' => 'publicacoes_issn',
                'type' => 'text',
                'instructions' => 'Adicione o registro ISSN dessa Publicação (quando houver).',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => ''
            ),
            array(
                'key' => 'field_53ac7a0b35736',
                'label' => 'Fonte',
                'name' => 'publicacoes_fonte',
                'type' => 'text',
                'instructions' => 'Adicione a fonte da Publicação (quando houver).',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_53b1bd7f220c9',
                'label' => 'Formato',
                'name' => 'publicacoes_formato',
                'type' => 'radio',
                'instructions' => 'Marque aqui a extensão do arquivo anexo.',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '=='
                        )
                    ),
                    'allorany' => 'all'
                ),
                'choices' => array(
                    '.pdf' => '.pdf',
                    '.zip' => '.zip',
                    '.jpg' => '.jpg',
                    '.gif' => '.gif',
                    '.png' => '.png',
                    '.avi' => '.avi',
                    '.wma' => '.wma',
                    '.wmv' => '.wmv',
                    '.mp3' => '.mp3',
                    '.mp4' => '.mp4',
                    'outro' => 'outro'
                ),
                'other_choice' => 1,
                'save_other_choice' => 1,
                'default_value' => '.pdf',
                'layout' => 'horizontal'
            ),
            array(
                'key' => 'field_539b1c5b69a1a',
                'label' => 'Número de Páginas',
                'name' => 'publicacoes_paginas',
                'type' => 'text',
                'instructions' => 'Adicione a quantidade de páginas dessa publicação (quando houver). Exemplo: "XX p."',
                'default_value' => '',
                'placeholder' => 'Número de Páginas',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_539b1c1b69a19',
                'label' => 'Ano de Publicação',
                'name' => 'publicacoes_ano',
                'type' => 'text',
                'instructions' => 'Adicione o ano de publicação',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '=='
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => 'Ano de Publicação',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => 4
            ),
            array(
                'key' => 'field_53bbffe321138',
                'label' => 'Idioma',
                'name' => 'publicacoes_idioma',
                'type' => 'select',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '==',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'choices' => array(
                    'Português' => 'Português',
                    'Alemão' => 'Alemão',
                    'Espanhol' => 'Espanhol',
                    'Inglês' => 'Inglês',
                ),
                'default_value' => 'Português',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array(
                'key' => 'field_53bbfc6b2112e',
                'label' => 'Série',
                'name' => 'publicacoes_serie',
                'type' => 'text',
                'instructions' => 'Adicione o número da Série.',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'field_53b1c1d1453d3',
                            'operator' => '==',
                            'value' => 'arquivistica'
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_53bbfd842112f',
                'label' => 'SubSérie',
                'name' => 'publicacoes_subserie',
                'type' => 'text',
                'instructions' => 'Adicione o número da SubSérie.',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'field_53b1c1d1453d3',
                            'operator' => '==',
                            'value' => 'arquivistica'
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_53bbfdaf21131',
                'label' => 'Tombo (Número do Documento)',
                'name' => 'publicacoes_tombo',
                'type' => 'number',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_53bbfde521133',
                'label' => 'Data',
                'name' => 'publicacoes_data',
                'type' => 'date_picker',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '==',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'date_format' => 'yyyy-mm-dd',
                'display_format' => 'dd/mm/yyyy',
                'first_day' => 1,
            ),
            array(
                'key' => 'field_53bbfe9121135',
                'label' => 'Referência',
                'name' => 'publicacoes_referência',
                'type' => 'text',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '==',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_53bee0bc343d1',
                'label' => 'Situação do Documento',
                'name' => 'publicacoes_situacao_documento',
                'type' => 'radio',
                'instructions' => 'Marque em qual situação o documento se encontra.',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'field_53b1c1d1453d3',
                            'operator' => '==',
                            'value' => 'arquivistica'
                        )
                    ),
                    'allorany' => 'all'
                ),
                'choices' => array(
                    'emprestado' => 'Emprestado',
                    'doado' => 'Doado',
                    'acervo' => 'No acervo',
                ),
                'other_choice' => 1,
                'save_other_choice' => 1,
                'default_value' => 'acervo',
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_53bee136343d2',
                'label' => 'Unidade de Armazenamento',
                'name' => 'publicacoes_unidade_armazenamento',
                'type' => 'radio',
                'instructions' => 'Marque como o documento está arquivado',
                'choices' => array(
                    'caixa_arquivo' => 'Caixa Arquivo',
                    'pasta' => 'Pasta',
                    'nao-definido' => 'Não Definido'
                ),
                'other_choice' => 1,
                'save_other_choice' => 1,
                'default_value' => 'nao-definido',
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_53bee1b1343d3',
                'label' => 'Fase do Arquivo',
                'name' => 'publicacoes_fase',
                'type' => 'radio',
                'instructions' => 'Marque em que fase o documento se encontra.',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'field_53b1c1d1453d3',
                            'operator' => '==',
                            'value' => 'arquivistica'
                        )
                    ),
                    'allorany' => 'all'
                ),
                'choices' => array(
                    'corrente' => 'Corrente',
                    'intermediario' => 'Intermediário',
                    'permanente' => 'Permanente',
                ),
                'other_choice' => 1,
                'save_other_choice' => 1,
                'default_value' => 'permanente',
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_53bee205343d4',
                'label' => 'Classificação',
                'name' => 'publicacoes_classificacao',
                'type' => 'text',
                'instructions' => 'Adicione uma classificação a essa Publicação.',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'field_53b1c1d1453d3',
                            'operator' => '==',
                            'value' => 'biblioteca'
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_53beefc548d97',
                'label' => 'Localização',
                'name' => 'publicacoes_localizacao',
                'type' => 'text',
                'instructions' => 'Adicione o número da edição do documento.',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_53beefc548d77',
                'label' => 'Edição',
                'name' => 'publicacoes_edicao',
                'type' => 'text',
                'instructions' => 'Adicione o número da edição do documento.',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_53bef0ad48d78',
                'label' => 'Imprenta',
                'name' => 'publicacoes_imprenta',
                'type' => 'text',
                'instructions' => 'Adicione informações como localidade, editora, etc.',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'publicacoes',
                    'order_no' => 1,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array()
        ),
        'menu_order' => 1
    ));
    register_field_group(array(
        'id' => 'acf_campos-migracao',
        'title' => 'Campos Migração',
        'fields' => array(
            array(
                'key' => 'field_539b9c0acfc0f',
                'label' => 'Data de Publicação',
                'name' => 'mgr_data',
                'type' => 'text',
                'instructions' => 'Valor do campo nwd_date',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '=='
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_539b8c17ddbb2',
                'label' => 'Imagem',
                'name' => 'mgr_imagem',
                'type' => 'text',
                'instructions' => 'Valor do campo nwd_image',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '=='
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_539b8d6addbb3',
                'label' => 'Fonte',
                'name' => 'mgr_fonte',
                'type' => 'text',
                'instructions' => 'Valor do campo nwd_source',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '=='
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_539b92e8ddbb4',
                'label' => 'Link Externo',
                'name' => 'mgr_link_externo',
                'type' => 'text',
                'instructions' => 'Valor do campo nwd_external_link',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'null',
                            'operator' => '=='
                        )
                    ),
                    'allorany' => 'all'
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            ),
            array(
                'key' => 'field_539b9308ddbb5',
                'label' => 'Autor',
                'name' => 'mgr_autor',
                'type' => 'text',
                'instructions' => 'Valor do campo nwd_author',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => ''
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'noticias',
                    'order_no' => 0,
                    'group_no' => 0
                )
            )
        ),
        'options' => array(
            'position' => 'side',
            'layout' => 'default',
            'hide_on_screen' => array()
        ),
        'menu_order' => 0
    ));

}
//Avatar field
if (function_exists("register_field_group")) {
    register_field_group(array('id' => 'acf_avatar', 'title' => 'Avatar', 'fields' => array(array('key' => 'field_53a9927815518', 'label' => 'Avatar', 'name' => 'user_avatar', 'type' => 'image', 'save_format' => 'id', 'preview_size' => 'thumbnail', 'library' => 'all',),), 'location' => array(array(array('param' => 'ef_user', 'operator' => '==', 'value' => 'all', 'order_no' => 0, 'group_no' => 0,),),), 'options' => array('position' => 'normal', 'layout' => 'no_box', 'hide_on_screen' => array(),), 'menu_order' => 0,));
}

function select_user_area($field)
{
    //democracia e participacao
    $_id = get_term_by('slug', 'democracia-e-participacao', 'areas');
    $_id = $_id->term_id;
    $_areas['democracia'] = 'Democracia e Participação';
    $field['choices'] = array();

    $args = array(
        'child_of' => $_id,
        'taxonomy' => 'areas',
        'hide_empty' => 0,
    );

    $categories = get_categories($args);
    foreach ($categories as $category) {
        $_areas[$category->slug] = '   -- ' . $category->cat_name;
    }
    //inclusao-e-sustentabilidade
    $_id = get_term_by('slug', 'inclusao-e-sustentabilidade', 'areas');
    $_id = $_id->term_id;
    $_areas['inclusao'] = 'Inclusão e sustentabilidade';

    $args = array(
        'child_of' => $_id,
        'taxonomy' => 'areas',
        'hide_empty' => 0,
    );

    $categories = get_categories($args);
    foreach ($categories as $category) {
        $_areas[$category->slug] = '   -- ' . $category->name;
    }
    //reforma urbana
    $_id = get_term_by('slug', 'reforma-urbana', 'areas');
    $_id = $_id->term_id;
    $_areas['reforma'] = 'Reforma Urbana';

    $args = array(
        'child_of' => $_id,
        'taxonomy' => 'areas',
        'hide_empty' => 0,
    );

    $categories = get_categories($args);
    foreach ($categories as $category) {
        $_areas[$category->slug] = '   -- ' . $category->name;
    }
    //cidadania cultural
    $_id = get_term_by('slug', 'cidadania-cultural', 'areas');
    $_id = $_id->term_id;
    $_areas['cidadania'] = 'Cidadania Cultural';

    $args = array(
        'child_of' => $_id,
        'taxonomy' => 'areas',
        'hide_empty' => 0,

    );
    $categories = get_categories($args);
    foreach ($categories as $category) {
        $_areas[$category->slug] = '   -- ' . $category->name;
    }
    $_areas['Outro'] = 'Outro';
    $_areas['Institucional'] = 'Institucional';
    $field['choices'] = $_areas;
    return $field;
}

// v4.0.0 and above
add_filter('acf/load_field/name=area', 'select_user_area');


if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_migrando-publicacoes',
        'title' => 'Migrando Publicações',
        'fields' => array(
            array(
                'key' => 'field_53c10d5be1fc3',
                'label' => 'Arquivo para Download',
                'name' => 'mgr_pub_download',
                'type' => 'text',
                'instructions' => 'Nome do arquivo anexo a Publicação.
    cld_file',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_53c510498ce5e',
                'label' => 'Url',
                'name' => 'mgr_pub_url',
                'type' => 'text',
                'instructions' => 'Url dessa Publicação no site anterior (sem www.polis.org.br/)
                so_url',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'publicacoes',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'side',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
    ));
}
if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_projetos',
        'title' => 'Projetos',
        'fields' => array(
            array(
                'key' => 'field_53c5447b7015f',
                'label' => 'Projetos',
                'name' => 'projetos_repeater',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_53c5455070160',
                        'label' => 'Nome',
                        'name' => 'projetos_nome',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_53c545af70161',
                        'label' => 'Telefone',
                        'name' => 'projetos_telefone',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_53c5460270162',
                        'label' => 'Email',
                        'name' => 'projetos_email',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => 0,
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Adicionar mais',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'projetos',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 0,
    ));
}

if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_videos',
        'title' => 'Vídeos',
        'fields' => array(
            array(
                'key' => 'field_53c7cb0b9c875',
                'label' => 'URL do Vídeo',
                'name' => 'url_do_video',
                'type' => 'text',
                'instructions' => 'Adicione a url do vídeo que deseja embedar inserir. Os principais serviços suportados são YouTube, Vimeo e DailyMotion, GoogleVídeo.',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'videos',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 0,
    ));
}
if (function_exists("register_field_group")) {
    $_id = get_page_by_path('institucional', OBJECT, 'page');
    $_id = $_id->ID;
    register_field_group(array(
        'id' => 'acf_ordenar',
        'title' => 'Ordenar',
        'fields' => array(
            array(
                'key' => 'field_53ceb3ebbbab9',
                'label' => 'Ordernar',
                'name' => 'institucional_order',
                'type' => 'number',
                'instructions' => 'Ordene a exibição dos botões na página Institucional',
                'default_value' => 1,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_parent',
                    'operator' => '==',
                    'value' => $_id,
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
}


if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_destaque',
        'title' => 'Destaque',
        'fields' => array(
            array(
                'key' => 'field_53df98de354d7',
                'label' => 'Mostrar no slider de publicações na página inicial?',
                'name' => 'in_home_slider',
                'type' => 'radio',
                'conditional_logic' => array(
                    'status' => 1,
                    'rules' => array(
                        array(
                            'field' => 'field_53df994c354d8',
                            'operator' => '==',
                            'value' => 'sim',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'choices' => array(
                    'sim' => 'SIm',
                    'nao' => 'Não',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_53df994c354d8',
                'label' => 'Mostrar nos sliders da biblioteca?',
                'name' => 'in_biblioteca_slider',
                'type' => 'radio',
                'choices' => array(
                    'sim' => 'SIm',
                    'nao' => 'Não',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_53df9a0d354db',
                'label' => 'Mostrar nos sliders das áreas?',
                'name' => 'in_area_slider',
                'type' => 'radio',
                'choices' => array(
                    'sim' => 'SIm',
                    'nao' => 'Não',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '!=',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 0,
    ));
}
if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_idioma',
        'title' => 'Idioma',
        'fields' => array (
            array (
                'key' => 'field_545b6ba500069',
                'label' => 'Português',
                'name' => '',
                'type' => 'tab',
            ),
            array (
                'key' => 'field_545b6bdc0006b',
                'label' => 'Titulo',
                'name' => 'title_ptbr',
                'type' => 'text',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_545b6c090006c',
                'label' => 'Conteudo',
                'name' => 'content_ptbr',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
            array (
                'key' => 'field_545b6bca0006a',
                'label' => 'Espanhol',
                'name' => '',
                'type' => 'tab',
            ),
            array (
                'key' => 'field_545b6cef0006d',
                'label' => 'Deseja ativar esse idioma?',
                'name' => 'active_es',
                'type' => 'radio',
                'choices' => array (
                    'true' => 'Sim',
                    'false' => 'Não',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'false',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_545b6d640006f',
                'label' => 'Titulo',
                'name' => 'title_es',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_545b6d6800070',
                'label' => 'Conteudo',
                'name' => 'content_es',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
            array (
                'key' => 'field_545b6bca0GYTYT6a',
                'label' => 'Inglês',
                'name' => '',
                'type' => 'tab',
            ),
            array (
                'key' => 'field_545b6cee9wee93r90006d',
                'label' => 'Deseja ativar esse idioma?',
                'name' => 'active_en',
                'type' => 'radio',
                'choices' => array (
                    'true' => 'Sim',
                    'false' => 'Não',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'false',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_542t94t494b6d640006feefe',
                'label' => 'Titulo',
                'name' => 'title_en',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_54539y347hrfweuiuheb6d6800070',
                'label' => 'Conteudo',
                'name' => 'content_en',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),

        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'default',
            'hide_on_screen' => array(
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
}

function update_field_area_order( $post_id )
{
    // vars
    $fields = false;

    // load from post
    if( isset($_POST['fields']) && isset($_POST['user_id'])  )
    {
        $_user_id = $_POST['user_id'];
        $field = $_POST['fields']['field_area_acf'];
       // global $wpdb;

        if($field == 'reforma'){
            $order = 1;
        }
        elseif($field == 'democracia'){
            $order = 2;
        }
        elseif($field == 'inclusao'){
            $order = 3;
        }
        elseif($field == 'cidadania'){
            $order = 4;
        }
        else{
            $order = 5;
        }

        update_user_meta($_user_id, 'area_user_order', $order);
    }

    // ...
}

// run before ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'update_field_area_order', 1);

// run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'update_field_area_order', 20);

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_conteudo',
        'title' => 'Conteudo',
        'fields' => array (
            array (
                'key' => 'field_content_publicacoes',
                'label' => '',
                'name' => 'publicacoes_content',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
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
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
}

function save_user( $user_id ) {

	// specific field value
	$field = $_POST['fields']['field_area_acf'];
	if($field == 'Institucional'){
		update_user_meta($user_id, 'user_area_hide', 'Institucional');
	}
	elseif($field == 'Outro'){
		update_user_meta($user_id, 'user_area_hide', 'Outro');
	}
	elseif($field == 'democracia'){
		update_user_meta($user_id, 'user_area_hide', 'democracia-e-participacao');
	}
	elseif($field == 'reforma'){
		update_user_meta($user_id, 'user_area_hide', 'reforma-urbana');
	}
	elseif($field == 'cidadania'){
		update_user_meta($user_id, 'user_area_hide', 'cidadania-cultural');
	}
	elseif($field == 'inclusao'){
		update_user_meta($user_id, 'user_area_hide', 'inclusao-e-sustentabilidade');
	}
	else{
		$term = get_term_by('slug', $field, 'areas');
		if($term && $term->parent != 0){
			$parent  = get_term($term->parent,'areas');
			update_user_meta($user_id, 'user_area_hide', $parent->slug);
		}
	}

}


// run after ACF saves the $_POST['acf'] data
add_action('profile_update', 'save_user', 20);
