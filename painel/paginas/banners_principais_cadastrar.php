<?php


if($_GET['acao'] == 'cadastrar'){
    $input_titulo         = mysql_real_escape_string($_POST['input_titulo']);
    $input_link           = mysql_real_escape_string($_POST['input_link']);
    $input_status         = mysql_real_escape_string($_POST['input_status']);
    $input_nova_janela    = mysql_real_escape_string($_POST['input_nova_janela']);

    $arquivo_tmp = $_FILES['input_arquivo']['tmp_name'];
    $arquivo_name = $_FILES['input_arquivo']['name'];

    if(!empty($arquivo_name)){
        $arquivo_name = removercaracteres(date('dmYHis').$arquivo_name);
    }

    $arquivo_mobile_tmp = $_FILES['input_arquivo_mobile']['tmp_name'];
    $arquivo_mobile_name = $_FILES['input_arquivo_mobile']['name'];

    if(!empty($arquivo_mobile_name)){
        $arquivo_mobile_name = removercaracteres(date('dmYHis').$arquivo_mobile_name);
    }

    $fachada_tmp = $_FILES['input_fachada']['tmp_name'];
    $fachada_name = $_FILES['input_fachada']['name'];

    if(!empty($fachada_name)){
        $fachada_name = removercaracteres(date('dmYHis').$fachada_name);
    }

    $sql_insert = "
    INSERT INTO banner_principal
    (
        data_cadastro,
        usuario_cadastro,
        titulo,
        link,
        nova_janela,
        arquivo,
        arquivo_mobile,
        status
    ) VALUES (
        NOW(),
        '".$_SESSION['usuario_online']."',
        '".$input_titulo."',
        '".$input_link."',
        '".$input_nova_janela."',
        '".$arquivo_name."',
        '".$arquivo_mobile_name."',
        '".$input_status."'
    );
    ";

    if(mysql_query($sql_insert)){
        move_uploaded_file($arquivo_tmp, 'arquivos/banners_principais/'.$arquivo_name);
        move_uploaded_file($arquivo_mobile_tmp, 'arquivos/banners_principais/'.$arquivo_mobile_name);
        echo "<script>location.href = '?secao=banners_principais_editar&id=".mysql_insert_id()."&cadastrado=1';</script>";

    }else{
        $mensagem = "<p class='bg-danger'>Não foi possível efetuar o cadastro!</p>";
    }
}


?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Banners Principais
            <small>Cadastrar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/banners_principais_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <?=$mensagem?>

            <form role="form" id="form" action="?secao=banners_principais_cadastrar&acao=cadastrar" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-titulo" class="col-sm-2 control-label text-right">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-titulo" name="input_titulo" placeholder="Título">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Link</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-link" class="col-sm-2 control-label text-right">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-link" name="input_link" placeholder="Link">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-nova-janela" class="col-sm-2 control-label text-right">Nova janela</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-nova-janela" name="input_nova_janela" style="max-width:200px;">
                                        <option value='1'>Sim</option>
                                        <option value='0'>Não</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Arquivos</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-arquivo" class="col-sm-2 control-label text-right">Imagem (2000x700)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control pull-left" id="input-arquivo" name="input_arquivo" style="width:auto;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-arquivo_mobile" class="col-sm-2 control-label text-right">Imagem mobile (768x1024)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control pull-left" id="input-arquivo_mobile" name="input_arquivo_mobile" style="width:auto;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Status</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-status" class="col-sm-2 control-label text-right">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-status" name="input_status" style="max-width:200px;">
                                        <option value='1'>Ativo</option>
                                        <option value='0'>Inativo</option>
                                    </select>
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