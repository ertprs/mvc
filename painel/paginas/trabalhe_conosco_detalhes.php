<?php

$sql_fale_conosco = "
SELECT
    *,
    (SELECT nome FROM fale_conosco_assuntos WHERE fale_conosco_assuntos.id=fale_conosco.assunto) as nome_assunto,
    (SELECT nome FROM estado WHERE estado.id=fale_conosco.estado_id) as nome_estado
FROM
    fale_conosco
WHERE
    id='".abs($_GET['id'])."'";

$sql_fale_conosco = mysql_query($sql_fale_conosco);
$dados_fale_conosco = mysql_fetch_assoc($sql_fale_conosco);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Fale Conosco
            <small>Detalhes</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/fale_conosco_menu.php"; ?>
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
                            <div class="col-sm-10"><?=date("d/m/Y H:i:s", strtotime($dados_fale_conosco['data']))?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Assunto</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Assunto</label>
                            <div class="col-sm-10"><?=$dados_fale_conosco['nome_assunto']?></div>
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
                            <div class="col-sm-10"><?=$dados_fale_conosco['nome']?></div>
                        </div>

                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Email</label>
                            <div class="col-sm-10"><?=$dados_fale_conosco['email']?></div>
                        </div>

                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Telefone</label>
                            <div class="col-sm-10"><?=$dados_fale_conosco['telefone']?></div>
                        </div>


                        <div class="form-group">
                            <label for="input-nome" class="col-sm-2 control-label text-right">Estado</label>
                            <div class="col-sm-10"><?=$dados_fale_conosco['nome_estado']?></div>
                        </div>
                    </div>
                </div>
            </div>

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

