<?php#---------------------------------------------------$dados_orcamento = mysql_fetch_assoc(mysql_query("SELECT *,(select nome FROM status_orcamento WHERE id=pedidos.status) AS status_nome FROM pedidos WHERE id='".$_GET['id']."'"));$dados_cliente = mysql_fetch_assoc(mysql_query("SELECT * FROM clientes WHERE id='".$dados_orcamento['cliente_id']."'"));#---------------------------------------------------if($_GET['acao'] == "atualizar"){	$sql_b = "    UPDATE orcamentos_itens SET		quantidade='".$_POST['quantidade']."'	WHERE		id='".$_GET['produto']."'	";	if($sql_b = mysql_query($sql_b)){		$mensagem = "<p class='bg-success'>Item atualizado com sucesso!</p>";	}else{		$mensagem = "<p class='bg-success'>Não foi possível atualizar o item!</p>";	}}#--------------------------------------------------------if($deleta){	$sql_d = "DELETE FROM orcamentos_itens WHERE id='".$_GET['deleta']."'";    if(mysql_query($sql_d)){        $mensagem = "<p class='bg-success'>Item deletado com sucesso!</p>";    }else{        $mensagem = "<p class='bg-danger'>Não foi possível deletar o item!</p>";    }}#------------------------------------------------------------------------------------------------------------------------------------------------------------------------?><div class="content-wrapper">    <section class="content-header">        <h1 class="pull-left">            Itens do Orçamento            <small>listar</small>        </h1>        <br clear="all">    </section>    <section class="content">        <div class="row">            <div class="col-xs-12">          		<div class="box box-primary" style="border-top-color:<?=$cor1?>;">                    <div class="box-header with-border">                        <h3 class="box-title">Dados do pedido</h3>                    </div>                    <div class="box-body">						<div class="form-group">                            <label for="input-nome" class="col-sm-2 control-label text-right">Data</label>                            <div class="col-sm-10"><?=$dados_orcamento['data']?></div>                        </div>                        <div class="form-group">                            <label for="input-nome" class="col-sm-2 control-label text-right">Solicitante</label>                            <div class="col-sm-10"><?=$dados_cliente['nome']?></div>                        </div>                        <div class="form-group">                            <label for="input-nome" class="col-sm-2 control-label text-right">Status</label>                            <div class="col-sm-10"><?=$dados_orcamento['status_nome']?></div>                        </div>						<br clear="all">					</div>				</div>				<div class="box box-primary" style="border-top-color:<?=$cor1?>;">                    <div class="box-header with-border">                        <h3 class="box-title">Produtos</h3>                    </div>                    <div class="box-body">						<table id="example2" class="ordem-table table table-bordered table-hover">		                    <thead>		                        <tr>		                            <td style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:18%;" class="text-center">Foto</td>		                            <td style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:18%;" class="text-center">Nome</td>									<td style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:19%;" class="text-center">Quantidade</td>									<td style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:19%;" class="text-center">Preço</td>								</tr>		                    </thead>		                    <tbody>				            	<?php								$sql = "								SELECT									p.foto,									p.nome,									p.preco,									i.quantidade,									i.id								FROM									itens i									LEFT JOIN produtos p ON p.id=i.produtoId								WHERE									i.pedidoId='".$_GET['id']."'								";								$sql = mysql_query($sql);								if(mysql_num_rows($sql) > 0){								   	$a = 0;								   	while($linha = mysql_fetch_assoc($sql)){										echo "											<td class='text-center' style='vertical-align:middle;'>												".(!empty($linha['foto']) ? "												    <img src='arquivos/produtos/".substr($linha['foto'],0,-4)."_thumbnail.jpg' width='100' class='img-responsive' >												" : "")."											</td>											<td class='text-center' style='vertical-align:middle;'>												".$linha['nome']."											</td>											<td class='text-center' style='vertical-align:middle;'>												".$linha['quantidade']."											</td>											<td class='text-center' style='vertical-align:middle;'>												".$linha['preco']."											</td>								      	</tr>";										$a++;								    }								}else{									echo "	                                <tr>	                                    <td colspan='4' class='text-center' style='vertical-align:middle;'>Nenhum pedido encontrado!</td>	                                </tr>";								}								?>		                    </tbody>		                    <tfoot>		                        <tr>		                            <td style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:18%;" class="text-center">Foto</td>		                            <td style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:18%;" class="text-center">Produto</td>									<td style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:19%;" class="text-center">Quantidade</td>									<td style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:19%;" class="text-center">Preço</td>								</tr>		                    </tfoot>		                </table>		            </div>		        </div>            </div>        </div>    </section></div>