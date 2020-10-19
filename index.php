<?php

/**
 * Created by PhpStorm.
 * User: Henry Ugochukwu
 * Date: 7/9/20
 * Time: 10:25 AM
 */

require __DIR__ . '/core/session.php';

$sess = new Session();
$sess::start();

// Instantiate Autoload
if(file_exists(dirname( __FILE__ ) . '/vendor/autoload.php' )) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 *---------------------------------------------------------------
 * ENVIRONMENT INSTANCE
 *---------------------------------------------------------------
 * Allow setting environment variables using .env
 */
$dotEnv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotEnv->load();

// Database
// Sessions
// Exception Handler
// Middleware
// Dockerize

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
define('ENVIRONMENT', isset($_SERVER['APP_ENV']) ? $_SERVER['APP_ENV'] : 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;

    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

/**
 *---------------------------------------------------------------
 * ROUTER INSTANCE
 *---------------------------------------------------------------
 *
 * Create router instance for the app
 */
$router = new \Bramus\Router\Router();

$router->mount('', function () use ($router) {
    $router->setNamespace('\App\Controllers');
    require __DIR__ . '/routes/api.php';
});

$router->run();

