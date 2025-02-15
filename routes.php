<?php
//$url = $_SERVER['REQUEST_URI']; // But when we have query param in uri then it will not match the below paths so we have to take only path

//Option 1
//$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
//dd($uri);

//Option 2
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//dd($url);

//We have used here by using if What if we use array (Associative key => value)

//if ($url === '/') {
//    require 'controllers/index.php';
//} else if ($url === '/about') {
//    require 'controllers/about.php';
//} else if ($url === '/contact') {
//    require 'controllers/contact.php';
//}

//function abort()
//{
//    http_response_code(404);
//    require 'views/404.php';
//    die();
//}

$routes = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php',
];

function routeToController($url, $routes)
{
    if (array_key_exists($url, $routes)) {
        require $routes[$url];
    } else {
//    abort(); but in future we have any type of status code to abort then hoe we make them as dynamic
        abort(404); // ByDefault we have set to 404 but you can pass any code

    }
}

function abort($code = 404)
{
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

routeToController($url, $routes);
