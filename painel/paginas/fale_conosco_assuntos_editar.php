<?php
if($_GET['cadastrado'] == 1){
    $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Registro cadastrado com sucesso!</p>";
}


if($_GET['acao'] == 'atualizar'){
    $input_nome      = mysql_real_escape_string($_POST['input_nome']);
    $input_email      = mysql_real_escape_string($_POST['input_email']);

    $sql_update = "
    UPDATE fale_conosco_assuntos SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    nome='".$input_nome."',
    email='".$input_email."'
    WHERE
    id='".$_GET['id']."'";

    if(mysql_query($sql_update)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Registro atualizado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!</p>";
    }
}

$sql_selo = "SELECT * FROM fale_conosco_assuntos WHERE id='".abs($_GET['id'])."'";
$sql_selo = mysql_query($sql_selo);
$dados_selo = mysql_fetch_assoc($sql_selo);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Fale conosco - Assuntos
            <small>Editar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/fale_conosco_assuntos_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <br clear="all">
            <?=$mensagem?>

            <form role="form" action="?secao=fale_conosco_assuntos_editar&acao=atualizar&id=<?=$_GET['id']?>" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-nome" class="col-sm-2 control-label text-right">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-nome" name="input_nome" placeholder="Nome" value="<?=$dados_selo['nome']?>">
                                </div>
                            </div>

                            <!--
<div class="form-group">
                                <label for="input-email" class="col-sm-2 control-label text-right">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-email" name="input_email" placeholder="Email" value="<?=$dados_selo['email']?>">
                                </div>
                            </div>
-->
                        </div>
                    </div>
                </div>

                <br clear="all">

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Atualizar</button>
                </div>
            </form>
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

