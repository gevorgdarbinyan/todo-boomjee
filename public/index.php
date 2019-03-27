<?php
session_start();
/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('home/save-task', ['controller' => 'Home', 'action' => 'saveTask']);
$router->add('home/remove-task', ['controller' => 'Home', 'action' => 'removeTask']);
$router->add('home/complete-task', ['controller' => 'Home', 'action' => 'completeTask']);
$router->add('home/admin-logged', ['controller' => 'Home', 'action' => 'adminLogged']);
$router->add('home/admin-logout', ['controller' => 'Home', 'action' => 'adminLogout']);
$router->add('{controller}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);
/**
 * 1. pagination
 * 2. admin-ov login
 * 3. deploy
 * 4. rename php-mvc name
 * 5. don't forget rename it also in js include
 */
