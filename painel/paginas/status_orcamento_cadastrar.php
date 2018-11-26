<?php


if($_GET['acao'] == 'cadastrar'){
    $input_nome      = mysql_real_escape_string($_POST['input_nome']);


    $sql_insert = "
    INSERT INTO status_orcamento
    (data_cadastro,usuario_cadastro,nome)
    VALUES
    (NOW(),'".$_SESSION['usuario_online']."','".$input_nome."');
    ";

    if(mysql_query($sql_insert)){
        echo "<script>location.href = '?secao=status_orcamento_editar&id=".mysql_insert_id()."&cadastrado=1';</script>";

    }else{
        $mensagem = "<p class='bg-danger'>Não foi possível efetuar o cadastro!</p>";
    }
}


?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Status de orçamento
            <small>Cadastrar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/status_orcamento_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <?=$mensagem?>

            <form role="form" id="form" action="?secao=status_orcamento_cadastrar&acao=cadastrar" method="post"  enctype="multipart/form-data">
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