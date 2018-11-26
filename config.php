<?php


// #######

define('CONFIG_TITLE', 'Dal Col Carnes');

define('LIBS', 'libs/');

if($_SERVER['HTTP_HOST'] == '192.168.2.152'){

	define('CONFIG_PATH', 'http://192.168.2.152/dalcol');
	define('CONFIG_PATH_LIB', 'http://192.168.2.152/dalcol/libs');
	define('CONFIG_PATH_PUBLIC', 'http://192.168.2.152/dalcol/public');
	define('CONFIG_PATH_MAIN', 'http://192.168.2.152/dalcol');
	define('CONFIG_PATH_PAINEL', 'http://192.168.2.152/dalcol/painel');
	
	define('DB_TYPE', 'mysql');
	define('DB_HOST', '192.168.2.151');
	define('DB_NAME', 'dalcol');
	define('DB_USER', 'rd');
	define('DB_PASS', 'rd@2011#');
	
	define('DEV',true);

}else{
	//$host = 'http://www.dalcolcarnes.com.br';
	$host = 'http://dalcol.rdweb.com.br';
	define('CONFIG_PATH', $host);
	define('CONFIG_PATH_LIB', $host.'/libs');
	define('CONFIG_PATH_PUBLIC', $host.'/public');
	define('CONFIG_PATH_MAIN', $host);
	define('CONFIG_PATH_PAINEL', $host.'/painel');

	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'dalcolcarnes_bd');
	define('DB_USER', 'dalcolcarnes_admin');
	define('DB_PASS', 'XuOTwDC+Re%9');
	
	define('DEV',true);
}

define('HASH_GENERAL_KEY', 'd@1c0L2018c@rn3S');

define('HASH_PASSWORD_KEY', 'AUgH7AS%D#t$%&YJ6');

// SEO CONFIG
define('CONFIG_SEO_TYPE',        'article');
define('CONFIG_SEO_TITLE',       'Dal Col Carnes');
define('CONFIG_SEO_URL',         "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
define('CONFIG_SEO_SITE_NAME',   'Dal Col Carnes');
define('CONFIG_SEO_DESCRIPTION', 'Dal Col Carnes!');
define('CONFIG_SEO_IMAGE',       CONFIG_PATH_PUBLIC.'/img/logo-facebook.jpg');