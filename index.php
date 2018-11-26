<?php
if(strstr($_SERVER['HTTP_HOST'],'dalcolcarnes') !== false)
exit;
ini_set('display_errors',0);

date_default_timezone_set('America/Sao_Paulo');

session_start();

require 'config.php';
require 'functions.php';
require 'jcart/jcart.php';

define('DS',DIRECTORY_SEPARATOR);
define('ROOT',__DIR__);

require LIBS . 'AutoLoad.php';
$autoLoad = new AutoLoad();
$autoLoad->setPath(ROOT);
$autoLoad->setExt('php');

spl_autoload_register(array($autoLoad, 'loadLibs'));

$bootstrap = new Bootstrap();
$bootstrap->init();
