<?php

require __DIR__ . '/../vendor/autoload.php';

 use \App\Some as Some;
// $a = new Some(3);

$memo = function($fn){
	$m = [];
	return function($key) use ($fn, $m){
		if(!isset($m[$key])){
			$m[$key] = $fn($key);
		}
		return $m[$key];
	};
};

// $content = $memo(function($fname){
// 	return file_get_contents(__DIR__ . '/../content/' . $fname . '.html');
// });

$template = $memo(function($fname){
	return file_get_contents(__DIR__ . '/../templates/' . $fname . '.handlebars');
});

/* Redefine your with own defaults here.
 * This are just examples, no one is required. */

$app = new \Slim\App([
	'settings' => [
    'displayErrorDetails' => true
	]
]);

use Handlebars\Handlebars;

$handlebars = new Handlebars([
	'loader' => new \Handlebars\Loader\FilesystemLoader(__DIR__.'/../templates/'),
	    'partials_loader' => new \Handlebars\Loader\FilesystemLoader(
	        __DIR__ . '/../templates/partials',
	        array(
	            'prefix' => '_'
	        )
	    )
]);
$container = $app->getContainer();

$handler = function($template, $path) use ($handlebars, $container){
	return $handlebars->render(
	   $template, [
			 'path' => $path . '/',
			 'images' => $container->$path,
			 'menu' => $container->menu,
		 ]
	);
};

$app->get('/img', function($req, $res, $args){
	// Set the time the cache is cleaned (Since the image generation) to one month (2592000/60/60/24=30)
	define('FILE_CACHE_ENABLED', true);
	define('FILE_CACHE_TIME_BETWEEN_CLEANS', 3600000000);
	define ('FILE_CACHE_MAX_FILE_AGE', 3600000000);
	// Use the default system cache dir so your project's folder stays clean.
	define ('FILE_CACHE_DIRECTORY', __DIR__ . "/../cache");
	// Quality set to 100%
	define ('DEFAULT_Q', 70);

	// Start timthumb.
	timthumb::start();
});

$routeHandle = function($acc, $route){
	$maybe = $acc ? $acc->children->$route : false;
	$acc = ($maybe && $maybe->isSomething()) ? $maybe : false;
	// print_r($maybe);
	return $acc;
};

$routeHandle1 = function($acc, $route){
	return $acc && isset($acc['children']) && isset($acc['children'][$route]) && $acc['children'][$route];
};

// $app->get('[/{params:.*}]', function($req, $res, $args) use ($handlebars, $container){
// 	$path = $req->getAttribute('params');
// 	return $res->write($handlebars->render('gallery-item', [
// 		'path' => $path . '/',
// 		'data' => $container->$path,
// 		'social' => $container->social,
// 		'menu' => $container->menu
// 	]));
// });
// $page = function($defaults){
// 	return function($data) use ($defaults){
// 		return array_merge($defaults, $data);
// 	}
// };
//
// $film = $page()

// $container['about'] = [
//
// ];

$get_image_size = function($options){
  return function($dirname) use ($options){
  	return function($imgUrl) use ($options, $dirname){
  		$sizes = getimagesize($options['path'] . "$dirname/$imgUrl");
  		return [
  			'url' => $imgUrl,
  			'w' => $sizes[0],
  			'h' => $sizes[1],
        'ratio' => ( $sizes[1] / $sizes[0] * 100 )
  		];
  	};
  };
};

$loader = function($options) use ($container){
  return function($name) use ($container, $options){
  	$container[$name] = function() use ($name, $options){
  		return [
  			'content' => file_get_contents($options['path'] . $name . $options['extension'])
  		];
  	};
  };
};

$imgsize = $get_image_size([
  'path' => __DIR__ . "/../public/images/"
]);

$container['imgsize'] = $imgsize;

$container['contents'] = function() use ($loader){
  return function($names) use ($loader){
    // echo "<pre>";
    // print_r($names);
    // echo "</pre>";
  	return array_map($loader([
      'path' => __DIR__ . '/../data/content/',
      'extension' => '.html'
    ]), $names);
  };
};

include '../data/data.php';

$app->get('/about', function($req, $res, $args) use ($handlebars, $container){
	return $res->write($handlebars->render('about', [
		'menu' => $container->menu,
		'social' => $container->social,
		'data' => $container->portraits,
		'path' => 'portraits'
	]));
});

$resolveData = function($container, $locator){
	$handle = $locator['data'];
	$isFn = is_callable($handle);
	$isProp = is_string($handle);
	// $isPath = is_array($locator);
	if($isProp){
		// echo $handle;
		// print_r($container->has($handle) && $container->{$handle});
		// die();
		return $container->{$handle};
	} elseif ($isFn) {
		return $handle($container, $locator);
	}
};

$app->get('[/{params:.*}]', function($req, $res, $args) use ($handlebars, $container, $routeHandle, $resolveData){
	$path = explode('/', $req->getAttribute('params'));
	// $match = $container['pages'][$path[0]];
	$match = array_reduce($path, $routeHandle, new Some($container['pages']));
	// echo $match ? 'true' : 'false';
	if ($match) {
		$m = $match();
		$data = $resolveData($container, $m);
		// $key = $m['data'];
		// echo "<pre>";
		// print_r($data);
		// die();
		// $data = $container->has($key) && $container->{$key};
		$res->write($handlebars->render($m['template'], [
			'path' => isset($m['path']) ? $m['path'] . '/' : null,
			'data' => $data,
			'title' => $m['title'],
			'social' => $container->social,
			'menu' => $container->menu
		]));
	} else {
		$res->write('404');
	}
	// return $res->write($match);
});

$app->run();

// $img = function($path){
// 	return function($imgUrl) use ($path){
// 		$sizes = getimagesize(__DIR__ . "/../public/images/$path/$imgUrl");
// 		return [
// 			'url' => $imgUrl,
// 			'w' => $sizes[0],
// 			'h' => $sizes[1]
// 		];
// 	};
// };


// $content = function($name) use ($container){
// 	$container[$name] = function() use ($name){
// 		return [
// 			'content' => file_get_contents(__DIR__ . '/../data/content/' . $name . '.html')
// 		];
// 	};
// };

// $container['planetarium-film'] = [
// 	'content' => $content('planetarium-film')
// ];
// $container['pishta'] = [
// 	'content' => $content('pishta')
// ];
// $container['dogona'] = [
// 	'content' => $content('dogona')
// ];

?>
