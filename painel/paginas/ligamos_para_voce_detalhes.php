<?php

$sql_ligamos = "SELECT * FROM ligamos_para_voce WHERE id='".abs($_GET['id'])."'";
$sql_ligamos = mysql_query($sql_ligamos);
$dados_ligamos = mysql_fetch_assoc($sql_ligamos);


if($dados_ligamos['cliente'] == "Sim"){
    $cliente .= "Sim, já sou cliente";
}else{
    $cliente .= "Não, ainda não sou cliente";
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Ligamos para você
            <small>Detalhes</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/ligamos_para_voce_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <br clear="all">
            <?=$mensagem?>
            <div class="col-md-12">
                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Data</label>
                            <div class="col-sm-10">
                                <?=date("d/m/Y H:i:s", strtotime($dados_ligamos['data_cadastro']))?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados Pessoais</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Nome</label>
                            <div class="col-sm-10"><?=$dados_ligamos['nome']?></div>
                        </div>

                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Email</label>
                            <div class="col-sm-10"><?=$dados_ligamos['email']?></div>
                        </div>

                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Telefone</label>
                            <div class="col-sm-10"><?=$dados_ligamos['telefone']?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Melhor horário para contato</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-12"><?=$dados_ligamos['horario']?></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Já é cliente da Ágata?</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-12"><?=$cliente?></div>
                        </div>
                    </div>
                </div>
            </div>
<!--
            <div class="col-md-12">
                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mensagem</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <?=nl2br($dados_fale_conosco['mensagem'])?>
                        </div>
                    </div>
                </div>
            </div> -->
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

