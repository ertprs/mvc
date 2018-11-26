<?php

function getValorCampo($id_campo,$id_projeto){
	$sql = mysql_query("SELECT valor FROM landing_projetos_campos WHERE id_projeto='".$id_projeto."' AND id_campo='".$id_campo."'");
	$sql = mysql_fetch_assoc($sql);

	return $sql['valor'];
}


function url_amigavel($string){
	$string = str_replace(' ','-',$string);
	$pattern = array("/ã|á|a|â|a|Á|A|Â|A/","/é|e|e|E|É|E/","/í|i|î|I|Í|Î/","/ó|o|ô|o|Ó|O|Ô|O/","/ú|u|u|U|Ú|U/","/Ç|ç/","/['.\]}{\$:\[)(?!;?§*#%@&^~,\/]/");
	$replace = array("a","e","i","o","u","c","");
	$string = preg_replace($pattern,$replace,$string);
	$string = strtolower($string);
	return $string.'.html';
}


function converte_data($dataz){
    if(strstr($dataz, "/")){
        $A = explode("/",$dataz);
        $V_dataz = $A[2]."-".$A[1]."-".$A[0];
    }else{
        $A = explode("-",$dataz);
        $V_dataz = $A[2]."/".$A[1]."/".$A[0];
    }
    return $V_dataz;
}


function updateValorCampo($id_campo,$valor,$id_projeto){
	$valor = mysql_real_escape_string(stripslashes(str_replace('"',"'",$valor)));


	if(mysql_num_rows(mysql_query("SELECT id FROM landing_projetos_campos WHERE id_campo='".$id_campo."' and id_projeto='".$id_projeto."'")) == 0){
		mysql_query("INSERT INTO landing_projetos_campos (id_projeto,id_campo,valor) VALUES ('".$id_projeto."','".$id_campo."','".$valor."')");
	}else{
		mysql_query("UPDATE landing_projetos_campos SET valor='".$valor."' WHERE id_campo='".$id_campo."' and id_projeto='".$id_projeto."'");
	}
}



$niveis = array();
$sql_niveis = "SELECT id,nome FROM nivel ORDER BY nome ASC";
$sql_niveis = mysql_query($sql_niveis) or die (mysql_error());
if(mysql_num_rows($sql_niveis) > 0){
    while($linha_niveis = mysql_fetch_assoc($sql_niveis)){
        $i = 0;
        $permissoes = array();
		$sql_permissoes = "SELECT * FROM nivel_permissao WHERE nivel='".$linha_niveis['id']."'";
		$sql_permissoes = mysql_query($sql_permissoes) or die (mysql_error());
	    while($linha_permissoes = mysql_fetch_assoc($sql_permissoes)){
	        $permissoes[$linha_permissoes['pagina']] = 1;
	        $i++;
	    }

	    $_SESSION['array_niveis'][$linha_niveis['id']] = $permissoes;
    }
}




function checa_permissao($nivel,$pagina){
	if(!empty($_SESSION['array_niveis'][$nivel][$pagina])){
		return true;
	}else{
		return false;
	}
}




function acessos_semana($dia, $mes, $ano, $ver_acao = 0){
	$data = "{$ano}-{$mes}-{$dia} 00:00:00";

	$dia = abs(date('w',strtotime($data)));

    if($dia == 0){
		$domingo = $data;
        $sabado = date('Y-m-d',strtotime("+6 day", strtotime($data)));
    }
    else{
        $domingo = date('Y-m-d',strtotime("-{$dia} day", strtotime($data)));
        $sabado = date('Y-m-d',strtotime("+6 day", strtotime($domingo)));
    }

	$sql_acesso = "SELECT count(*) as qtd FROM landing_emails WHERE DATE_FORMAT(data_cadastro,'%Y-%m-%d') BETWEEN '{$domingo}' AND '{$sabado}'";

	$sql_acesso = mysql_query($sql_acesso);

	if($sql_acesso)
	{
		$acesso = mysql_fetch_assoc($sql_acesso);
		return $acesso['qtd'];
	}
	else
	{
		return 0;
	}
}


// Retorna a quantidade de acessos do mês de um determinado usuário.
function acessos_mes($mes,$ano){
	$sql_acesso = "SELECT count(*) as qtd FROM landing_emails WHERE date_format(data_cadastro, '%m') = {$mes} AND date_format(data_cadastro, '%Y') = {$ano}";

	$sql_acesso = mysql_query($sql_acesso);

	if($sql_acesso)
	{
		$acesso = mysql_fetch_assoc($sql_acesso);
		return $acesso['qtd'];
	}
	else
	{
		return 0;
	}
}


function paginacao($pagina_atual,$parametros_url,$total_artigos = 0, $artigos_por_pagina = 10, $offset = 5, $url_atual = ''){
    $numero_de_paginas = ceil( $total_artigos / $artigos_por_pagina );

	if ($url_atual == ''){
    	$url_atual = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	}

    if(strstr($url_atual,'?')){
        $explode_url = explode('?',$url_atual);
        $url_atual = $explode_url[0];
    }

    if($numero_de_paginas > 1){
		if(!empty($_GET['pagina'])){
			$pagina_atual = (int)$_GET['pagina'];
		}

		$paginas = null;

		$disabled_aterior = "";
		if($pagina_atual == 1){
			$disabled_aterior = "disabled";
		}

		if(($pagina_atual) >= 1){
			$paginas .= "<li class='".$disabled_aterior."'><a href='".$url_atual.$parametros_url.(!empty($parametros_url) ? "&" : "?")."pagina=".($pagina_atual - 1)."' aria-label='Anterior'><span aria-hidden='true'>&laquo;</span></a></li>";
		}


		for($i=($pagina_atual - 1); $i < ($pagina_atual) + $offset; $i++){
			if($i <= $numero_de_paginas && $i > 0){
				$pagina = $i;
				$estilo = null;

				if($i == $pagina_atual){
					$estilo = ' class="active" ';
				}

				$paginas .= "<li $estilo><a href='".$url_atual.$parametros_url.(!empty($parametros_url) ? "&" : "?")."pagina=".$pagina."'>$pagina</a></li>";

			}
		}

		$disabled_proxima = "";
		if(($pagina_atual) == $numero_de_paginas){
			$disabled_proxima = "disabled";
		}

		if(($pagina_atual) <= $numero_de_paginas){
			$paginas .= "<li class='".$disabled_proxima."'><a href='".$url_atual.$parametros_url.(!empty($parametros_url) ? "&" : "?")."pagina=".($pagina_atual + 1)."' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
		}

		$retorno = "
		<center>
			<nav style='text-align:center;'>
				<ul class='pagination pagination-lg'>
					".$paginas."
				</ul>
			</nav>
		</center>
		";

	}else{
		$retorno = '';
	}

    return $retorno;

}






function exibe_mensagem($titulo,$texto,$tipo){
	if($tipo == 'erro'){
		return "
		<div class='col-md-12'>
			<div class='alert alert-danger alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<h4 style='margin-bottom:1px;'><i class='icon fa fa-ban'></i> ".$titulo."</h4>
				".$texto."
	        </div>
	    </div>
	    <br clear='all'>
	    ";

    }elseif($tipo == 'info'){
		return "
		<div class='col-md-12'>
			<div class='alert alert-warning alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<h4 style='margin-bottom:1px;'><i class='icon fa fa-warning'></i> ".$titulo."</h4>
				".$texto."
	        </div>
	    </div>
	    <br clear='all'>
	    ";

    }elseif($tipo == 'sucesso'){
		return "
		<div class='col-md-12'>
			<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<h4 style='margin-bottom:1px;'><i class='icon fa fa-check'></i> ".$titulo."</h4>
				".$texto."
	        </div>
	    </div>
	    <br clear='all'>
	    ";
    }
}


function removercaracteres($string){
	$string=(str_replace(' ','_',$string));
	$string=(str_replace('-','_',$string));
	$string=(str_replace('ç','c',$string));
	$string=(str_replace('á','a',$string));
	$string=(str_replace('à','a',$string));
	$string=(str_replace('é','e',$string));
	$string=(str_replace('í','i',$string));
	$string=(str_replace('ó','o',$string));
	$string=(str_replace('ú','u',$string));
	$string=(str_replace('ã','a',$string));
	$string=(str_replace('õ','o',$string));
	$string=(str_replace('â','a',$string));
	$string=(str_replace('ê','e',$string));
	$string=(str_replace('ô','o',$string));

	$string=(str_replace('Ç','C',$string));
	$string=(str_replace('Á','A',$string));
	$string=(str_replace('À','A',$string));
	$string=(str_replace('É','E',$string));
	$string=(str_replace('Í','I',$string));
	$string=(str_replace('Ó','O',$string));
	$string=(str_replace('Ú','U',$string));
	$string=(str_replace('Ã','A',$string));
	$string=(str_replace('Õ','O',$string));
	$string=(str_replace('Â','A',$string));
	$string=(str_replace('Ê','E',$string));
	$string=(str_replace('Ô','O',$string));

	$string=(str_replace('?','_',$string));
	$string=(str_replace('!','_',$string));
	$string=(str_replace('(','_',$string));
	$string=(str_replace(')','_',$string));
	$string=(str_replace('%','_',$string));
	$string=(str_replace('#','_',$string));
	$string=(str_replace('@','_',$string));
	$string=(str_replace('&','_',$string));
	$string=(str_replace('+','_',$string));
	$string=(str_replace('=','_',$string));
	$string=(str_replace('§','_',$string));
	$string=(str_replace('ª','_',$string));
	$string=(str_replace('º','_',$string));
	$string=(str_replace('*','_',$string));
	$string=(str_replace(':','_',$string));
	$string=(str_replace(',','_',$string));
	$string=(str_replace(';','_',$string));
	$string=(str_replace('|','_',$string));
	$string = strtolower($string);

	return $string;
}

?>