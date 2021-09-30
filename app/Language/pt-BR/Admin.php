<?php use App\Entities\SysConfigVariable;
use App\Entities\SysPageVariable;

return [
	'btn-save'             => 'Salvar',
	'btn-add'              => 'Adicionar',
	'help-selectImage'     => 'Escolher Imagem',
	'help-pressEnterToAdd' => 'pressione Enter para adicionar',
	'Menu'                 => [
		'config' => 'Configuração',
		'pages'  => 'Páginas',
		'users'  => 'Usuários',
		'exit'   => 'Sair',
	],
	'Config'               => [
		'title'       => 'Configuração',
		'Seo'         => [
			'title'    => 'SEO',
			'General'  => [
				'title'             => 'Geral',
				'label-icon'        => 'Ícone',
				'label-title'       => 'Título',
				'label-description' => 'Descrição',
				'label-keywords'    => 'Palavras Chave',
			],
			'Facebook' => [
				'title'             => 'Facebook',
				'label-image'       => 'Imagem',
				'label-title'       => 'Título',
				'label-description' => 'Descrição',
			],
			'Twitter'  => [
				'title'             => 'Twitter',
				'label-image'       => 'Imagem',
				'label-title'       => 'Título',
				'label-description' => 'Descrição',
				'label-site'        => 'Site',
				'label-creator'     => 'Criador',
			],
		],
		'Variables'   => [
			'title'                                       => 'Variáveis',
			'placeholder-key'                             => 'Chave',
			'option-' . SysConfigVariable::TYPE_TEXT      => 'Texto',
			'option-' . SysConfigVariable::TYPE_MULTITEXT => 'Texto em linhas',
			'option-' . SysConfigVariable::TYPE_IMAGE     => 'Imagem',
			'option-' . SysConfigVariable::TYPE_CODE      => 'Código',
		],
		'SocialMedia' => [
			'title' => 'Mídias Sociais',
		],
	],
	'Pages'                => [
		'title'               => 'Páginas',
		'btn-new'             => 'Nova',
		'label-newPage'       => 'Nova Página',
		'help-selectPage'     => 'Selecione uma página',
		'help-noPageSelected' => 'Nenhuma página selecionada',

		'General' => [
			'title'          => 'Geral',
			'label-mainLink' => 'Link principal',
			'help-mainLink'  => "Endereço principal da página{0}<br />Atenção: Alterar isto pode quebrar os links do site!",
			'label-route'    => 'Rota',
			'help-route'     => 'Rota interna. Não altere sem conhecimento.',
			'Seo'            => [
				'title'             => 'SEO',
				'label-title'       => 'Título',
				'label-description' => 'Descrição',
				'label-keywords'    => 'Palavras Chave',
				'Facebook'          => [
					'title'             => 'Facebook',
					'label-image'       => 'Imagem',
					'label-title'       => 'Título',
					'label-description' => 'Descrição',
				],
				'Twitter'           => [
					'title'             => 'Twitter',
					'label-image'       => 'Imagem',
					'label-title'       => 'Título',
					'label-description' => 'Descrição',
					'label-site'        => 'Site',
					'label-creator'     => 'Criador',
				],
			],
		],
		'Content' => [
			'title'                                      => 'Conteúdo',
			'placeholder-key'                            => 'Chave',
			'option-' . SysPageVariable::TYPE_TEXT       => 'Texto',
			'option-' . SysPageVariable::TYPE_MULTITEXT  => 'Texto em linhas',
			'option-' . SysPageVariable::TYPE_TEXT_LIST  => 'Texto em lista',
			'option-' . SysPageVariable::TYPE_TEXT_PAIRS => 'Texto em pares',
			'option-' . SysPageVariable::TYPE_IMAGE      => 'Imagem',
			'option-' . SysPageVariable::TYPE_GALLERY    => 'Galeria',
		],
		'Links'   => [
			'title' => 'Links',
		],
	],
];
