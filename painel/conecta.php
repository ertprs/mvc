<?php

if($_SERVER['HTTP_HOST'] == '192.168.2.152'){
	$nome_servidor="192.168.2.151";
	$usuario_bd="rd";
	$senha_bd="rd@2011#";
	$nome_bd="dalcol";
	$path = "http://192.168.2.152/dalcol";
	$path_painel  = "http://192.168.2.152/dalcol/painel";

}else{
	//$host = 'http://www.dalcolcarnes.com.br';
	$host = 'http://dalcol.rdweb.com.br';
	$nome_servidor="localhost";
	$usuario_bd="dalcolcarnes_admin";
	$senha_bd="XuOTwDC+Re%9";
	$nome_bd="dalcolcarnes_bd";
	$path = $host;
	$path_painel  = $host."/painel";
}
//echo $path_painel;

$con = @mysql_connect($nome_servidor,$usuario_bd,$senha_bd) or die ('Erro 1: '.mysql_error());
@mysql_select_db($nome_bd,$con) or die ('Erro 2: '.mysql_error());


$cor1 = '#BE1622';
$cor2 = '#BE1622';
$cor3 = '#FFFFFF';
$cor_titulo = '#FFFFFF';

/*
$vermelho: #A03233;
$vermelho_escuro: #C6B704;
$cinza_escuro: #FFFFFF;
$cinza: #7C808E;
$cinza_claro: #E1E2E5;
$branco: #FFFFFF;
*/

?>