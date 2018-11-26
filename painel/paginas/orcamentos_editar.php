<?php





if($_GET['acao'] == 'atualizar'){
    $status = mysql_real_escape_string($_POST['status']);

    $sql_update = "
    UPDATE pedidos SET
    status='".$status."'
    WHERE
    id='".$_GET['id']."'";

    if(mysql_query($sql_update)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Status atualizado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!</p>";
    }
}

$dados_orcamento = mysql_fetch_assoc(mysql_query("SELECT *,(select nome FROM status_orcamento WHERE id=pedidos.status) AS status_nome FROM pedidos WHERE id='".$_GET['id']."'"));

$dados_cliente = mysql_fetch_assoc(mysql_query("SELECT * FROM clientes WHERE id='".$dados_orcamento['cliente_id']."'"));



?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Itens do Orçamento
            <small>Alteração de status</small>
        </h1>

        <br clear="all">
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?=$mensagem?>

                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados do pedido</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Codigo</label>
                            <div class="col-sm-10"><?=$dados_orcamento['id']?></div>
                        </div>

                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Data</label>
                            <div class="col-sm-10"><?=$dados_orcamento['data']?></div>
                        </div>

                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Solicitante</label>
                            <div class="col-sm-10"><?=$dados_cliente['nome']?></div>
                        </div>


                        <br clear="all">
                    </div>
                </div>

                <form role="form" action="?secao=orcamentos_editar&acao=atualizar&id=<?=$_GET['id']?>" method="post"  enctype="multipart/form-data">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-nome" class="col-sm-2 control-label text-right">* Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-status" name="status" required>
                                        <option value="">Escolha uma opção</option>
                                        <?php
                                        $sql_status = "SELECT id,nome FROM status_orcamento ORDER BY nome ASC";
                                        $sql_status = mysql_query($sql_status);
                                        while($linha_status = mysql_fetch_assoc($sql_status)){
                                            echo "<option value='".$linha_status['id']."' ".($linha_status['id'] == $dados_orcamento['status'] ? "selected" : "").">".$linha_status['nome']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <br clear="all">

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Alterar status</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>


<style>
.form-group{
    width:100%;
    float:left;
}

#form label{
    padding-top:6px;
}


</style>

