
<?php
if($_GET['cadastrado'] == 1){
    $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Notícia cadastrada com sucesso!</p>";
}


if($_GET['acao'] == 'atualizar'){
    $input_titulo    = mysql_real_escape_string($_POST['input_titulo']);
    $input_subtitulo = mysql_real_escape_string($_POST['input_subtitulo']);
    $input_data      = mysql_real_escape_string($_POST['input_data']);
    $input_arquivo   = mysql_real_escape_string($_POST['input_arquivo']);
    $input_status    = mysql_real_escape_string($_POST['input_status']);
    $input_texto     = mysql_real_escape_string($_POST['input_texto']);
    $input_estado    = mysql_real_escape_string($_POST['input_estado']);
    $input_categoria = mysql_real_escape_string($_POST['input_categoria']);

    $arquivo_tmp = $_FILES['input_arquivo']['tmp_name'];
    $arquivo_name = $_FILES['input_arquivo']['name'];
    $arquivo_ext = end((explode(".", $arquivo_name)));

    if(!empty($arquivo_name)){
        $arquivo_name = date('dmYHis').md5(uniqid()).'.'.$arquivo_ext;
        $muda_arquivo=",arquivo='".$arquivo_name."' ";
    }

    $sql_update = "
    UPDATE noticia SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    data='".converte_data($input_data)."',
    titulo='".$input_titulo."',
    subtitulo='".$input_subtitulo."',
    status='".$input_status."',
    texto='".$input_texto."'
    ".$muda_arquivo."
    WHERE
    id='".$_GET['id']."'";

    if(mysql_query($sql_update)){
        if(!empty($arquivo_name)){

            // #### THUMBNAILS
            $targetFile = 'arquivos/noticias/'.$arquivo_name;

            move_uploaded_file($arquivo_tmp, $targetFile);

            // #### THUMBNAILS
            $thumbnail[] = array('sufixo' => '_thumbnail.jpg',  'x' => '640', 'y' => '480');
            $thumbnail[] = array('sufixo' => '_thumbnail2.jpg',  'x' => '400', 'y' => '300');
            include "imagens_resize.php";

        }
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Notícia atualizada com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização! ".mysql_error()."</p>";
    }
}

$sql_noticias = "SELECT * FROM noticia WHERE id='".abs($_GET['id'])."'";
$sql_noticias = mysql_query($sql_noticias);
$dados_noticias = mysql_fetch_assoc($sql_noticias);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Inspire-se
            <small>Editar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/noticias_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <br clear="all">
            <?=$mensagem?>

            <form role="form" action="?secao=noticias_editar&acao=atualizar&id=<?=$_GET['id']?>" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">

                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-data" class="col-sm-2 control-label text-right">Data</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control data" id="input-data" name="input_data" placeholder="" value="<?=converte_data($dados_noticias['data'])?>" style="width:200px;" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-titulo" class="col-sm-2 control-label text-right">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-titulo" name="input_titulo" placeholder="Título" value="<?=$dados_noticias['titulo']?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-subtitulo" class="col-sm-2 control-label text-right">Subtítulo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-subtitulo" name="input_subtitulo" placeholder="Subtitulo" value="<?=$dados_noticias['subtitulo']?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="input-status" class="col-sm-2 control-label text-right">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-status" name="input_status" style="max-width:200px;" required>
                                        <option value='1' <?php if($dados_noticias['status'] == 1){?>selected<?php } ?>>Ativo</option>
                                        <option value='0' <?php if($dados_noticias['status'] == 0){?>selected<?php } ?>>Inativo</option>
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
                                    <?php if(!empty($dados_noticias['arquivo'])){?>
                                        <a href="arquivos/noticias/<?=$dados_noticias['arquivo']?>" target="blank" class="btn btn-primary" style="margin-left:10px;color:<?=$cor3?> !important">Visualizar arquivo</a>
                                    <?php } ?>
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
                                    <textarea id="input_texto" name="input_texto" class="ckeditor" rows="10" cols="80"><?=$dados_noticias['texto']?></textarea>
                                </div>
                            </div>
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

