<?php


if($_GET['acao'] == 'cadastrar'){
    $input_titulo    = mysql_real_escape_string($_POST['input_titulo']);
    $input_subtitulo = mysql_real_escape_string($_POST['input_subtitulo']);
    $input_arquivo   = mysql_real_escape_string($_POST['input_arquivo']);
    $input_status    = mysql_real_escape_string($_POST['input_status']);
    $input_texto     = mysql_real_escape_string($_POST['input_texto']);
    $input_data      = converte_data($_POST['input_data']);

    $arquivo_tmp = $_FILES['input_arquivo']['tmp_name'];
    $arquivo_name = $_FILES['input_arquivo']['name'];

    if(!empty($arquivo_name)){
        $arquivo_name = removercaracteres(date('dmYHis').$arquivo_name);
    }

    $sql_insert = "
    INSERT INTO noticia
    (
        data_cadastro,
        usuario_cadastro,
        data,
        titulo,
        subtitulo,
        arquivo,
        status,
        texto
    ) VALUES (
        NOW(),
        '".$_SESSION['usuario_online']."',
        '".$input_data."',
        '".$input_titulo."',
        '".$input_subtitulo."',
        '".$arquivo_name."',
        '".$input_status."',
        '".$input_texto."'
    );
    ";

    if(mysql_query($sql_insert)){

        // #### THUMBNAILS
        $targetFile = 'arquivos/noticias/'.$arquivo_name;

        move_uploaded_file($arquivo_tmp, $targetFile);

        // #### THUMBNAILS
        $thumbnail[] = array('sufixo' => '_thumbnail.jpg',  'x' => '640', 'y' => '480');
        $thumbnail[] = array('sufixo' => '_thumbnail2.jpg',  'x' => '400', 'y' => '300');
        include "imagens_resize.php";

        echo "<script>location.href = '?secao=noticias_editar&id=".mysql_insert_id()."&cadastrado=1';</script>";

    }else{
        $mensagem = "<p class='bg-danger'>Não foi possível efetuar o cadastro!</p>";
    }
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Inspire-se
            <small>Cadastrar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/noticias_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <?=$mensagem?>

            <form role="form" id="form" action="?secao=noticias_cadastrar&acao=cadastrar" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-data" class="col-sm-2 control-label text-right">Data</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control data" id="input-data" name="input_data" placeholder="" style="width:200px;" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-titulo" class="col-sm-2 control-label text-right">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-titulo" name="input_titulo" placeholder="Título" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-subtitulo" class="col-sm-2 control-label text-right">Subtítulo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-subtitulo" name="input_subtitulo" placeholder="Subtitulo">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="input-status" class="col-sm-2 control-label text-right">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-status" name="input_status" style="max-width:200px;" required>
                                        <option value='1'>Ativo</option>
                                        <option value='0'>Inativo</option>
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
                                <label for="input-arquivo" class="col-sm-2 control-label text-right">Imagem</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control pull-left" id="input-arquivo" name="input_arquivo" style="width:auto;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Texto</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <div class="box-body pad">
                                    <textarea id="texto" name="input_texto" class="ckeditor" rows="10" cols="80"></textarea>
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