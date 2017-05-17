<?php 

/*
type :
	text
	textarea
	radio (with choices array)
	checkbox
	select (with choices array)
	dropdown-pages
	email
	url
	number
	hidden
	date
*/

$customize_options = [
	'social_facebook' => [
		'description' => 'Votre page facebook',
		'label'       => 'Page facebook',
		'type'		  => 'url',
		'default'	  => 'netcom'
	],
	'social_twitter' => [
		'description' => 'Votre compte twitter',
		'label'       => 'Page twitter',
		'type'		  => 'textarea',
		'default'	  => ''
	],
	'social_display' => [
		'description' => 'Afficher les réseaux sociaux',
		'label'       => 'Voire les réseaux sociaux sur les pages du site',
		'type'		  => 'radio',
		'default'	  => '1',
		'choices'     => [
            '0'   => 'Non',
            '1'   => 'Oui'
        ]
	],
	'logo_footer_1' => [
   		'description' => 'Logo 1 du footer',
		'label'      => 'Logo footer 1',
		'type'		  => 'image',
		'default'	  => ''
    ],
    'plaquette' => [
   		'description' => 'Votre plaquette',
		'label'      => 'Plaquette',
		'type'		  => 'file',
		'default'	  => ''
    ]
];