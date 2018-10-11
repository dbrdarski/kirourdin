<?php

$container['contact'] = [
	'galleries' => [
		[
			'name' => 'mouche',
			'title' => 'Mouche Gallery',
			'address' => '340 N Beverly Dr, Beverly Hills, CA 90210, USA',
			'website' => 'www.mouchegallery.com',
			'website_url' => 'https://mouchegallery.com/',
		]
	]
];

$container['pages'] = [
	'children' => [
		'about' => [
			'title' => 'About',
			'template' => 'about'
		],
		'artwork' => [
			'title' => 'Artwork',
			'data' => function($container, $node){
				return $node['children'];
			},
			'children' => [
				'paintings' => [
					'title' => 'Paintings',
					'data' => 'paintings',
					'path' => 'paintings',
					'template' => 'gallery-item'
				],
				'watercolours' => [
					'title' => 'Watercolours',
					'data' => 'watercolours',
					'path' => 'watercolours',
					'template' => 'gallery-item'
				],
				'drawings' => [
					'title' => 'Drawings',
					'data' => 'drawings',
					'path' => 'drawings',
					'template' => 'gallery-item'
				],
				'sculptures' => [
					'title' => 'sculptures',
					'data' => 'sculptures',
					'path' => 'sculptures',
					'template' => 'gallery-item'
				],
			]
		],
		'planetarium-dance' => [
			'title' => 'Planetarium Dance',
			'data' => 'planetarium-dance',
			'path' => 'planetarium-dance',
			'template' => 'standard-page'
		],
		'films' => [
			'Title' => 'Films',
			'children' => [
				'planetarium' => [
					'title' => 'Planetarium Film',
					'data' => 'planetarium-film',
					'path' => 'planetarium-film',
					'template' => 'standard-page'
				],
				'pishta' => [
					'title' => 'Pishta',
					'data' => 'pishta',
					'path' => 'pishta',
					'template' => 'standard-page'
				],
				'dogs-and-trains' => [
					'title' => 'Dogs and Trains',
					'data' => 'dogs-and-trains',
					'path' => 'dogs-and-trains',
					'template' => 'standard-page'
				],
				'steps' => [
					'title' => 'Steps',
					'data' => 'steps',
					'path' => 'steps',
					'template' => 'standard-page'
				],
				'dogona' => [
					'title' => 'Dogona',
					'data' => 'dogona',
					'path' => 'dogona',
					'template' => 'standard-page'
				],
				'two-times' => [
					'title' => 'Two Times',
					'data' => 'two-times',
					'path' => 'two-times',
					'template' => 'standard-page'
				],
				'water-and-fire' => [
					'title' => 'Water and Fire',
					'data' => 'water-and-fire',
					'path' => 'water-and-fire',
					'template' => 'standard-page'
				],
				'life-and-death' => [
					'title' => 'Life and Death',
					'data' => 'life-and-death',
					'path' => 'life-and-death',
					'template' => 'standard-page'
				]
			]
		],
		'planetarism' => [
			'title' => 'Planetarism'
		],
		'projects' => [
			'title' => 'Projects'
		],
		'gallery' => [
			'title' => 'Photo Gallery',
			'template' => 'gallery-index',
			'path' => 'gallery',
			'data' => function($container, $node){
				return $node['children'];
			},
			'children' => [
				'people'=> [
					'title' => 'With People',
					'thumb' => 'kiro_urdin_and_gerard_meulensteen.jpg',
					'data' => 'people',
					'path' => 'people',
					'template' => 'gallery-item'
				],
				'planetarium' => [
					'title' => 'Planetarium',
					'thumb' => 'Kiro_Urdin-Planetarium-Jerusalem1.jpg',
					'data' => 'planetarium',
					'path' => 'planetarium',
					'template' => 'gallery-item'
				],
				'portraits' => [
					'title' => 'Portraits',
					'thumb' => 'Kiro-Urdin-Portrait-3.jpg',
					'data' => 'portraits',
					'path' => 'portraits',
					'template' => 'gallery-item'
				],
				'planetarium-dance' => [
					'title' => 'Planetarium Dance',
					'thumb' => 'Planetarium-Dance-Kiro-Urdin-and-Debbie-Wilson-10.jpg',
					'data' => 'planetarium-dance',
					'path' => 'planetarium-dance',
					'template' => 'gallery-item'
				],
				'press' => [
					'title' => 'In the Press',
					'thumb' => 'KiroUrdin-Geneve-EuropArt.jpg',
					'data' => 'press',
					'path' => 'press-coverage',
					'template' => 'gallery-item'
				],
				'omo-valley' => [
					'title' => 'Tribes of Omo Valley',
					'thumb' => 'Tribes-of-Omo-Valley-Cover.jpg',
					'data' => 'omo-valley',
					'path' => 'omo-valley',
					'template' => 'gallery-item'
				],
				'china-film-festival' => [
					'title' => 'China Nature Film Festival',
					'thumb' => 'China-Nature-Film-Festival-2.jpg',
					'data' => 'china-film-festival',
					'path' => 'china-film-festival',
					'template' => 'gallery-item'
				],
				'studio' => [
					'title' => 'The Atelier',
					'thumb' => 'Kiro_Urdin_Studio_1.jpg',
					'data' => 'studio',
					'path' => 'studio',
					'template' => 'gallery-item'
				]
			]
		],
		'contact' => [
			'title' => 'Contact',
			'data' => 'contact',
			'path' => 'contact',
			'template' => 'contact-page'
		]
	]
];

?>
