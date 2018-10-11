<?php
$contents = $container->contents;
// print_r($contents);
$contents([
	'planetarium-film',
	'planetarium-dance',
	'pishta',
	'dogona',
	'dogs-and-trains',
	'steps',
	'water-and-fire',
	'two-times',
	'life-and-death',
	'contact'
]);

$container['menu'] = [
	['title' => 'About', 'url' => '/about'],
	['title' => 'Artwork', 'url' => '/artwork'],
	['title' => 'Planetarism', 'url' => '/planetarism'],
	['title' => 'Projects', 'url' => '/projects'],
	['title' => 'Photo Gallery', 'url' => '/gallery'],
	['title' => 'Contact', 'url' => '/contact']
];

$container['social'] = [
	[
		'name' => 'facebook',
		'url' => 'https://www.facebook.com/kiro.urdin.official/'
	],
	[
		'name' => 'twitter',
		'url' => 'https://twitter.com/KiroUrdin'
	],
	[
		'name' => 'instagram',
		'url' => 'https://www.instagram.com/kirourdin/'
	],
	[
		'name' => 'vimeo',
		'url' => 'https://vimeo.com/kirourdin'
	]
];

include 'pages.php';
include 'galleries.php';

?>
