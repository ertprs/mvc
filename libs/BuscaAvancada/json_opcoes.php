<?php

//require "../config.php";


function setArrayId($array){
	$i = 0;
	foreach ($array as $key => $value) {
		$array[$key]['id'] = ++$i;
	}
	return $array;
}


$tipos = array(
	1 => array('id' => 1,'value' => '1','label' => 'Comercial','url' => 'comerciais'),
	2 => array('id' => 2,'value' => '2','label' => 'Residencial','url' => 'residenciais')
);


########################################################
############  Conexao com o Banco de Dados  ############
############     Execucao das consultas     ############
########################################################

$db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);

$condicao = '';
if(!empty($_SESSION['estado'])){
    $condicao = " WHERE estado_id='".$_SESSION['estado']."' ";
}

$cidades = array();
$cidades = $db->select("SELECT cidade_nome as label, cidade_id as value,id,(SELECT slug_nome FROM cidade WHERE cidade.id=view_empreendimento.cidade_id) as url FROM view_empreendimento ".$condicao." GROUP BY cidade_id");
$cidades = setArrayId($cidades);


########################################################
############  Arrays com as opcoes de busca  ###########
########################################################

// ###################### TIPO DO IMOVEL
$opcoes_tipo_imovel = array(
	'title'    	    => 'Tipo do imóvel',
	'name'    	    => 'input_busca_tipo',
	'parametro_get' => 'tipo',
	'num_options'   => 4,
	'content' 	    => $tipos
);

// ###################### CIDADE
$opcoes_cidade = array(
	'title'    	    => 'Cidades',
	'name'    	    => 'input_busca_cidades',
	'parametro_get' => 'cidades',
	'num_options'   => 4,
	'content' 	    => $cidades
);



?>