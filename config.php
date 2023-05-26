<?php

if(!defined('ABSPATH'))
    define('ABSPATH' , dirname (__FILE__) . '/');

/*Caminho no server para o sistema*/
if (empty($_SERVER['SERVER_NAME']) || preg_match('/.edu.br/', $_SERVER['SERVER_NAME'])) {
    if(!defined('BASEURL'))
        define('BASEURL', 'https://stocksystem.faex.edu.br/');
    define('HOST', 'localhost');
    define('USER', 'stocksystem');
    define('PASS', '0Q+azVb)');
    define('BD', 'stocksystem');
} else {
    // LOCALHOST
    if(!defined('BASEURL'))
        define('BASEURL', '/stocksystem/');
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '712396');
    define('BD', 'controle');
}
?>