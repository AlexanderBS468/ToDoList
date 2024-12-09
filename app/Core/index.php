<?php
require_once 'Config/Session.php';
require_once 'Core/.env.php';
require_once 'autoloader.php';
require_once 'vendor/autoload.php';
require_once 'Config/DataBase.php';

$GLOBALS['TEMPLATE_NAME'] = 'main';
$GLOBALS['DIR_PROJECT'] = '/';

const PROLOG_INCLUDED = true;

$router = new ProjectA\Core\Router\Router();

$router->addRoute($GLOBALS['DIR_PROJECT'] . 'about', 'about');
$router->addRoute($GLOBALS['DIR_PROJECT'] . 'index.php', 'home');
$router->addRoute($GLOBALS['DIR_PROJECT'], 'home');

$router->dispatch($_SERVER['REQUEST_URI']);
