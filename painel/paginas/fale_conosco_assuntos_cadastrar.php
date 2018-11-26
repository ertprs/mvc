<?php


if($_GET['acao'] == 'cadastrar'){
    $input_nome   = mysql_real_escape_string($_POST['input_nome']);
    $input_email  = mysql_real_escape_string($_POST['input_email']);
    $input_estado = mysql_real_escape_string($_POST['input_estado']);


    $sql_insert = "
    INSERT INTO fale_conosco_assuntos
    (data_cadastro,usuario_cadastro,nome,email)
    VALUES
    (NOW(),'".$_SESSION['usuario_online']."','".$input_nome."','".$input_email."');
    ";

    if(mysql_query($sql_insert)){
        echo "<script>location.href = '?secao=fale_conosco_assuntos_editar&id=".mysql_insert_id()."&cadastrado=1';</script>";

    }else{
        $mensagem = "<p class='bg-danger'>Não foi possível efetuar o cadastro!</p>";
    }
}


?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Fale conosco - Assuntos
            <small>Cadastrar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/fale_conosco_assuntos_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <?=$mensagem?>

            <form role="form" id="form" action="?secao=fale_conosco_assuntos_cadastrar&acao=cadastrar" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-nome" class="col-sm-2 control-label text-right">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-nome" name="input_nome" placeholder="Nome">
                                </div>
                            </div>

                           <!--
 <div class="form-group">
                                <label for="input-email" class="col-sm-2 control-label text-right">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-email" name="input_email" placeholder="Email">
                                </div>
                            </div>
-->
                        </div>
                    </div>
                </div>

                <br clear="all">

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Cadastrar</button>
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