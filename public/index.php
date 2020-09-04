<?php
error_reporting(-1);
ini_set('display_errors', 'On');
/**
 * Php-Framework
 * @author Mohamed Ashraf Elsaed m.ashraf.saed@gmail.com
 */

/**
 |------------------------------------------------------
 | Register AutoLoader
 |------------------------------------------------------
 | Load the autoloader that will generate classes that well be used
 |
 */
require __DIR__ . '/../vendor/autoload.php';


/**
 |------------------------------------------------------
 | Bootstrap The Application
 |------------------------------------------------------
 | Bootstrap the applications and handle framework actions
 |
 */
require __DIR__ . '/../bootstrap/Application.php';


/**
 |------------------------------------------------------
 | Run Application
 |------------------------------------------------------
 | Handel Request and response
 |
 */
Application::run();