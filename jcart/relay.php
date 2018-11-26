<?php
ini_set('display_erros',0);

// jCart v1.3
// http://conceptlogic.com/jcart/

// This file takes input from Ajax requests and passes data to jcart.php
// Returns updated cart HTML back to submitting page

//header('Content-type: text/html; charset=iso-8859-1');

// Include jcart before session start
//
include_once('jcart.php');

// Process input and return updated cart HTML
$_SESSION['jcart']->display_cart();