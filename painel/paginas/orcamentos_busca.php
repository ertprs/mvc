<? header("Content-type: text/html; charset=iso-8859-1"); 
if ($_REQUEST[falha]!="1" and $_REQUEST[logout]!="s" and $_REQUEST[acao]!="logando" and $_REQUEST[inicio]!="1") {include "restrito.php";}
include "conecta.php"; 
include "funcoes.php"; 

	
$sql_a = mysql_query("SELECT * FROM niveis ORDER BY nome ASC;")
or die("erro no SQL: ".mysql_error());

///$quantos=mysql_num_rows($sql);

while ($linha_a=mysql_fetch_array($sql_a)){

    $niveis.="<option value='".$linha_a["id"]."'>".$linha_a["nome"]."</option>	  
				      ";
}



	
$sql_b = mysql_query("SELECT * FROM filiais ORDER BY nome ASC;")
or die("erro no SQL: ".mysql_error());

///$quantos=mysql_num_rows($sql);

while ($linha_b=mysql_fetch_array($sql_b)){

    $filiais.="<option value='".$linha_b["id"]."'>".$linha_b["nome"]."</option>	  
				      ";
}


	
$sql_c = mysql_query("SELECT * FROM cargos ORDER BY nome ASC;")
or die("erro no SQL: ".mysql_error());

///$quantos=mysql_num_rows($sql);

while ($linha_c=mysql_fetch_array($sql_c)){

    $cargos.="<option value='".$linha_c["id"]."'>".$linha_c["nome"]."</option>	  
				      ";
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="scripts.js" language="javascript" type="text/javascript"></script>

</head>

<body>
<form id="formulario" name="formulario" method="post" action="?secao=pedidos&acao=buscar">
    <ul>
	
    
	
		
		
<li class="esquerda"><label for="nome">&nbsp;Nome</label></li>
<li class="direita"><input name="nome" type="text" id="nome" class="formulario" style="width:350px;"/></li>
	  
<li class="esquerda"><label for="email">&nbsp;E-mail</label></li>
<li class="direita"><input name="email" type="text" id="email" class="formulario"  style="width:350px;"/></li>



	  
<li class="esquerda"><label for="tel">&nbsp;Telefone</label></li>
<li class="direita"><input name="tel" type="text" id="tel" class="formulario"  style="width:350px;"  /></li>



<li class="separa"></li><br clear="all" />

		
<li class="esquerda"><label for="filial">&nbsp;Filial</label></li>
<li class="direita"><select name="filial" class="formulario" id="filial"  style="width:360px;"><option  value="" ></option>
<?=$filiais?></select></li>

		
<li class="esquerda"><label for="cargo">&nbsp;Cargo</label></li>
<li class="direita"><select name="cargo" class="formulario" id="cargo"  style="width:360px;"><option  value="" ></option>
<?=$cargos?></select></li>
	

	
<li class="esquerda"><label for="nivel">&nbsp;N&iacute;vel</label></li>
<li class="direita"><select name="nivel" class="formulario" id="nivel"  style="width:360px;"><option value=""></option><?=$niveis?></select></li>
	
 	
<li class="esquerda"><label for="login">&nbsp;Login</label></li>
<li class="direita"><input name="login" type="text" id="login" class="formulario" style="width:350px;text-align:left;"/>
</li>


	 <li class="separa"></li><br clear="all" />	
     
     	 	
		
<li class="esquerda"><label for="status">&nbsp;Status</label></li>
<li class="direita"><select name="status" class="formulario" id="status"  style="width:360px;">
          <option value="ativo" selected="selected">ativos</option>
          <option value="inativo">inativos</option>

</select></li>	
	 
	 	
<li class="esquerda"><label for="obs">&nbsp;Obs</label></li>
<li class="direita"> <textarea name="obs" rows="2" class="formulario" id="obs" style="width:350px;" ></textarea>
</li>
	  	

	
	  
      <li class="separa"></li><br clear="all" />
     
      <li class="esquerda"></li>
      <li class="direita">
        <input name="buscar" type="image" id="buscar" src="imagens/buscar.jpg" />
      </li>
    </ul>
  </form>
</body>
</html>
