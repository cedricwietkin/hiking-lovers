<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
include_once "inc/default.inc.php";

use core\Router;

$router = new Router();

$url_path = trim(
    parse_url(
        $_SERVER['REQUEST_URI'],
        PHP_URL_PATH));

$method = $_SERVER['REQUEST_METHOD']; // GET -- POST
$router->route($url_path, $method);



