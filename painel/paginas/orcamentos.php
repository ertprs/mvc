<?php


#--------------------------------------------------------

if(!empty($_GET['deletar'])){
    $sql_d = "DELETE FROM pedidos WHERE id='".$_GET['deletar']."'";

    if(mysql_query($sql_d)){
        $resultado = "<br clear='all'><p class='bg-success' style='padding:5px 10px;'>Item deletado com sucesso!</p>";

    }else{
        $resultado = "<br clear='all'><p class='bg-danger' style='padding:5px 10px;'>Não foi possível deletar o item!</p>";
    }
}

#--------------------------------------------------------

if($_REQUEST['acao'] == 'buscar'){
	$num_por_pagina = 1000000;
}else{
	$num_por_pagina = 100000;
}

if(!$paginax){
	$paginax = 1;
}

$primeiro_registro = ($paginax * $num_por_pagina) - $num_por_pagina;

if($_POST['de_data'] == ""){
	$de_data = "01/01/".date("Y");

}else{
	$de_data = $_POST['de_data'];
}

if($_POST['ate_data'] == ''){
	$ate_data = date("d/m/Y");
}else{
	$ate_data = $_POST['ate_data'];
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Orçamentos
            <small>listar</small>
        </h1>

        <br clear="all">
    </section>

    <?=$resultado?>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>

                    <div class="box-body">
						<form id="formulario" name="formulario" method="post" action="?secao=orcamentos&acao=buscar">
	                        <div style='width:1000px; display:block; margin:0px auto;'>
	                        	<div class="form-group">
	                                <label class="col-sm-3 control-label text-right" style="padding-top:7px;">Período de</label>
	                                <div class="col-sm-3">
	                                    <input type="text" name="de_data" class="form-control data" <?php if(!empty($_POST['de_data'])){ ?> value="<?=$de_data?>" <?php } ?> />
	                                </div>

	                                <label class="col-sm-1 control-label text-center" style="padding-top:7px;">at&eacute;</label>
	                                <div class="col-sm-3">
	    								<input type="text" name="ate_data" class="form-control data" <?php if(!empty($_POST['de_data'])){ ?> value="<?=$de_data?>" <?php } ?> />
	                                </div>

	                                <div class="col-md-2">
						          		<button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Enviar</button>
						          	</div>
	                            </div>
							</div>
						</form>

						<br clear="all">
						<br clear="all">

						<div align="center">
							<i style="font-size:14px;">
								Total das orçamentos no período de
								<strong><?=$de_data?></strong> a <strong><?=$ate_data?></strong>
							</i>
						</div>

						<br clear="all">
					</div>
				</div>



                    <table id="example2" class="ordem-table table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:5%;"  class="text-center">Codigo</th>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:15%;" class="text-center">Data</th>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:20%;" class="text-center">Solicitante</th>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:5%;"  class="text-center">Itens</th>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:10%;" class="text-center">Status</th>
                                <th style="background-color:#ccc; width:10%;" class="text-center"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sql = "
							SELECT
								*,
                                (select count(*) FROM itens WHERE pedidoId=pedidos.id) AS total_itens,
                                (select nome FROM status_orcamento WHERE id=pedidos.status) AS status_nome
							FROM
								pedidos
							WHERE
								(DATE_FORMAT(data,'%Y-%m-%d') BETWEEN '".converte_data($de_data)."' and '".converte_data($ate_data)."')
							ORDER BY
								id DESC
							LIMIT
								".$primeiro_registro.", ".$num_por_pagina."
							";

							$sql = mysql_query($sql);

							if(mysql_num_rows($sql) > 0){
                                while($linha = mysql_fetch_assoc($sql)){
                                    $dados_cliente = mysql_fetch_assoc(mysql_query("SELECT * FROM clientes WHERE id ='".$linha['cliente_id']."'"));

									echo "
                                    <tr id='recordsArray_".$linha['ped_id']."' style='background-color:#fff;'>
                                        <td class='text-center' style='vertical-align:middle;'>
                                        	".$linha['id']."
                                        </td>

                                        <td class='text-center' style='vertical-align:middle;'>
                                        	".$linha['data']."
                                        </td>

                                        <td class='text-center' style='vertical-align:middle;'>
                                        	".$dados_cliente['nome']."
                                        </td>

                                        <td class='text-center' style='vertical-align:middle;'>
                                        	".$linha['total_itens']."
                                        </td>

                                        <td class='text-center' style='vertical-align:middle;'>
                                        	".$linha['status_nome']."
                                        </td>

                                        <td class='text-center' style='vertical-align:middle;'>
											<a href='?secao=orcamentos_itens&id=".$linha['id']."'>
												<img src='imagens/add.png' height='16'>
											</a>

											&nbsp;

                                            <a href='?secao=orcamentos_editar&id=".$linha['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                <img src='imagens/edit.png' height='16'>
                                            </a>
                                            &nbsp;

											".(checa_permissao($_SESSION['nivel_online'],'orcamentos_deletar') ? "
                                                <a href='javascript:;' onClick='Deletar(\"?secao=orcamentos&deletar=".$linha['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
                                                    <img src='imagens/delete.png' height='16'>
                                                </a>
                                            " : "")."
                                        </td>
                                    </tr>
                                    ";
                                }

                            }else{
                                echo "
                                <tr>
                                    <td colspan='6' class='text-center' style='vertical-align:middle; background-color:#fff;'>Nenhuma orçamento encontrado!</td>
                                </tr>
                                ";
                            }

                            ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:5%;"  class="text-center">Codigo</th>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:15%;" class="text-center">Data</th>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:20%;" class="text-center">Solicitante</th>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:5%;"  class="text-center">Itens</th>
                                <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:10%;" class="text-center">Status</th>
                                <th style="background-color:#ccc; width:10%;" class="text-center"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>



