<?php

// jCart v1.3
// http://conceptlogic.com/jcart/

// Do NOT store any sensitive info in this file!!!
// It's loaded into the browser as plain text via Ajax


////////////////////////////////////////////////////////////////////////////////
// REQUIRED SETTINGS

if($_SERVER['HTTP_HOST'] == '192.168.2.152'){
	$path = "http://".$_SERVER['HTTP_HOST']."/dalcol";
}else{
	$path = "";
}

// Path to your jcart files
$config['jcartPath']              = 'jcart/';

// Path to your checkout page
$config['checkoutPath']           = $path.'/finalizar/';

// The HTML name attributes used in your item forms
$config['item']['id']			= 'my-item-id';    		// Item id
$config['item']['name']			= 'my-item-name';    	// Item name
$config['item']['price']		= 'my-item-price';    	// Item price
$config['item']['qty']			= 'my-item-qty';    	// Item qty
$config['item']['quality']		= 'my-item-quality';    // Item quality
$config['item']['company']		= 'my-item-company';    // Item company
$config['item']['thickness']	= 'my-item-thickness';	// Item thickness
$config['item']['block']		= 'my-item-block';    	// Item block
$config['item']['bundle']		= 'my-item-bundle';    	// Item bundle
$config['item']['color']		= 'my-item-color';   	// Item color
$config['item']['url']			= 'my-item-url';   		// Item URL (optional)
$config['item']['add']			= 'my-add-button';    	// Add to cart button

// Your PayPal secure merchant ID
// Found here: https://www.paypal.com/webapps/customerprofile/summary.view
$config['paypal']['id']           = 'seller_1282188508_biz@conceptlogic.com';

////////////////////////////////////////////////////////////////////////////////
// OPTIONAL SETTINGS

// Three-letter currency code, defaults to USD if empty
// See available options here: http://j.mp/agNsTx
$config['currencyCode']           = '';

// Add a unique token to form posts to prevent CSRF exploits
// Learn more: http://conceptlogic.com/jcart/security.php
$config['csrfToken']              = false;

// Override default cart text
if (!isset($config['currencyCode'])) $config['currencyCode']                     = 'BRL';
if (!isset($config['text']['cartTitle'])) $config['text']['cartTitle']           = 'Produtos em seu orçamento!';
if (!isset($config['text']['singleItem'])) $config['text']['singleItem']         = 'Item';
if (!isset($config['text']['multipleItems'])) $config['text']['multipleItems']   = 'Itens';
if (!isset($config['text']['subtotal'])) $config['text']['subtotal']             = 'Subtotal';
if (!isset($config['text']['update'])) $config['text']['update']                 = '';
if (!isset($config['text']['checkout'])) $config['text']['checkout']             = 'Finalizar Or&ccedil;amento';
if (!isset($config['text']['checkoutPaypal'])) $config['text']['checkoutPaypal'] = 'Finalizar Or&ccedil;amento';
if (!isset($config['text']['removeLink'])) $config['text']['removeLink']         = 'Remover';
if (!isset($config['text']['emptyButton'])) $config['text']['emptyButton']       = '';
if (!isset($config['text']['emptyMessage'])) $config['text']['emptyMessage']     = 'Seu carrinho est&aacute; vazio!';
if (!isset($config['text']['itemAdded'])) $config['text']['itemAdded']           = 'Produto adicionado!';
if (!isset($config['text']['priceError'])) $config['text']['priceError']         = 'Formato de valor inv&aacute;lido!';
if (!isset($config['text']['quantityError'])) $config['text']['quantityError']   = 'Quantidade de produtos deve conter apenas n&uacute;meros!';
if (!isset($config['text']['checkoutError'])) $config['text']['checkoutError']   = 'Sua requisi&ccedil;&atilde;o n&atilde;o p&ocirc;de ser processada!';

// Override the default buttons by entering paths to your button images
$config['button']['checkout']     = '';
$config['button']['paypal']       = '';
$config['button']['update']       = '';
$config['button']['empty']        = '';


////////////////////////////////////////////////////////////////////////////////
// ADVANCED SETTINGS

// Display tooltip after the visitor adds an item to their cart?
$config['tooltip']                = true;

// Allow decimals in item quantities?
$config['decimalQtys']            = true;

// How many decimal places are allowed?
$config['decimalPlaces']          = 1;

// Number format for prices, see: http://php.net/manual/en/function.number-format.php
$config['priceFormat']            = array('decimals' => 2, 'dec_point' => '.', 'thousands_sep' => ',');

// Send visitor to PayPal via HTTPS?
$config['paypal']['https']        = true;

// Use PayPal sandbox?
$config['paypal']['sandbox']      = false;

// The URL a visitor is returned to after completing their PayPal transaction
$config['paypal']['returnUrl']    = '';

// The URL of your PayPal IPN script
$config['paypal']['notifyUrl']    = '';

?>