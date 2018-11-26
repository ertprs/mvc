<?php

$sql_cliente = "SELECT * FROM clientes WHERE id='".abs($_GET['id'])."'";
$sql_cliente   = mysql_query($sql_cliente);
$dados_cliente = mysql_fetch_assoc($sql_cliente);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Cliente
            <small>Detalhes</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/clientes_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>

                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Nome</label>
                            <div class="col-sm-10"><?=$dados_cliente['nome']." ".$dados_cliente['sobrenome']?></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Email</label>
                            <div class="col-sm-10"><?=$dados_cliente['email']?></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Telefone</label>
                            <div class="col-sm-10"><?=$dados_cliente['telefone']?></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">status</label>
                            <div class="col-sm-10"><?=($dados_cliente['status'] == 0 ? "Não" : "Sim")?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <p class="text-center"><a href="?secao=orcamentos&buscar=true&cliente=<?=$_GET['id']?>">Visualizar orçamentos desse cliente</a></p>
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
