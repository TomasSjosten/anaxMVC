<?php
/**
 * Sample configuration file for Anax webroot.
 *
 */


/**
 * Define essential Anax paths, end with /
 *
 */
define('ANAX_INSTALL_PATH', realpath(__DIR__ . '/../') . '/');
define('ANAX_APP_PATH', ANAX_INSTALL_PATH . 'app/');


$baseUrl = explode('/', $_SERVER['REQUEST_URI']);
$cleanUrl = '';
foreach ($baseUrl as $key => $val) {
    $cleanUrl .= $val.'/';
    if ($val == 'webroot') {break;}
}
define('ANAX_BASE_PATH', $cleanUrl);



/**
 * Include autoloader.
 *
 */
include(ANAX_APP_PATH . 'config/autoloader.php'); 



/**
 * Include global functions.
 *
 */
include(ANAX_INSTALL_PATH . 'src/functions.php'); 
