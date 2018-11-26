<?php

// jCart v1.3
// http://conceptlogic.com/jcart/

// By default, this file returns the $config array for use with PHP scripts
// If requested via Ajax, the array is encoded as JSON and echoed out to the browser

// Don't edit here, edit config.php
include('config.php');

// Use default values for any settings that have been left empty
if (!isset($config['currencyCode'])) $config['currencyCode']                     = 'BRL';
if (!isset($config['text']['cartTitle'])) $config['text']['cartTitle']           = 'Produtos em seu orçamento!';
if (!isset($config['text']['singleItem'])) $config['text']['singleItem']         = 'Item';
if (!isset($config['text']['multipleItems'])) $config['text']['multipleItems']   = 'Itens';
if (!isset($config['text']['subtotal'])) $config['text']['subtotal']             = 'Subtotal';
if (!isset($config['text']['update'])) $config['text']['update']                 = 'Atualizar Carrinho';
if (!isset($config['text']['checkout'])) $config['text']['checkout']             = 'Finalizar Or&ccedil;amento';
if (!isset($config['text']['checkoutPaypal'])) $config['text']['checkoutPaypal'] = 'Finalizar Or&ccedil;amento';
if (!isset($config['text']['removeLink'])) $config['text']['removeLink']         = 'Remover';
if (!isset($config['text']['emptyButton'])) $config['text']['emptyButton']       = 'Vazio';
if (!isset($config['text']['emptyMessage'])) $config['text']['emptyMessage']     = 'Seu carrinho est&aacute; vazio!';
if (!isset($config['text']['itemAdded'])) $config['text']['itemAdded']           = 'Produto adicionado!';
if (!isset($config['text']['priceError'])) $config['text']['priceError']         = 'Formato de valor inv&aacute;lido!';
if (!isset($config['text']['quantityError'])) $config['text']['quantityError']   = 'Quantidade de produtos deve conter apenas n&uacute;meros!';
if (!isset($config['text']['checkoutError'])) $config['text']['checkoutError']   = 'Sua requisi&ccedil;&atilde;o n&atilde;o p&ocirc;de ser processada!';



if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($config);
}