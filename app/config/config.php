<?php


/****
 * 
 * Path definition
 * 
 */
define('ROOT', dirname(dirname(__DIR__)));

define('APP_ROOT', ROOT . "/app");

define('CONTROLLERS_ROOT', APP_ROOT . "/controllers");

define('VIEW_ROOT', APP_ROOT . "/views");

define('PUBLIC_ROOT', ROOT . "/public");

define('UPLOAD_ROOT', PUBLIC_ROOT . "/upload");

define('URL_ROOT', 'http://twitter-200-github.test/');




/***
 * Database configuration
 */

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mavix_twitter_github');
