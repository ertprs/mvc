<?php


if($_GET['acao'] == 'atualizar'){
    $texto_principal      = mysql_real_escape_string($_POST['texto_principal']);


    // IMAGEM DE FUNDO
    $imagem_fundo_tmp = $_FILES['imagem_fundo']['tmp_name'];
    $imagem_fundo_name = $_FILES['imagem_fundo']['name'];

    if(!empty($imagem_fundo_name)){
        $imagem_fundo_name = removercaracteres(date('dmYHis').$imagem_fundo_name);
        $muda_imagem_fundo=",imagem_fundo='".$imagem_fundo_name."' ";
    }


    // IMAGEM PRINCIPAL
    $imagem_principal_tmp = $_FILES['imagem_principal']['tmp_name'];
    $imagem_principal_name = $_FILES['imagem_principal']['name'];

    if(!empty($imagem_principal_name)){
        $imagem_principal_name = removercaracteres(date('dmYHis').$imagem_principal_name);
        $muda_imagem_principal=",imagem_principal='".$imagem_principal_name."' ";
    }



    $sql_update = "
    UPDATE fale_conosco_texto SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    texto_principal='".$texto_principal."'
    ".$muda_imagem_fundo."
    ".$muda_imagem_principal."
    WHERE
    id='1'";

    if(mysql_query($sql_update)){
        if(!empty($imagem_fundo_name)){move_uploaded_file($imagem_fundo_tmp, 'arquivos/fale_conosco/'.$imagem_fundo_name);}
        if(!empty($imagem_principal_name)){move_uploaded_file($imagem_principal_tmp, 'arquivos/fale_conosco/'.$imagem_principal_name);}
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Texto atualizado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!".mysql_error()."</p>";
    }


    /* SEO */
    /* SELECIONA SEO DA PÁGINA */
    $title          = mysql_real_escape_string($_POST['title']);
    $keywords       = mysql_real_escape_string($_POST['keywords']);
    $description    = mysql_real_escape_string($_POST['description']);

    $dados_seo  = mysql_query("SELECT 1 FROM seo WHERE pagina='fale-conosco'") or die (mysql_error());
    $dados_seo  = mysql_num_rows($dados_seo);
    if($dados_seo > 0){
        mysql_query("UPDATE seo SET title='".$title."', keywords='".$keywords."', description='".$description."' WHERE
            pagina='fale-conosco'");
        echo "UPDATE seo SET title='".$title."', keywords='".$keywords."', description='".$description."' WHERE
            pagina='fale-conosco'";
    }
        else
    {
        mysql_query("INSERT INTO seo (title, keywords, description, pagina) VALUES ('".$title."', '".$keywords."', '".$description."', 'fale-conosco')");
        echo "INSERT INTO seo (title, keywords, description, pagina) VALUES ('".$title."', '".$keywords."', '".$description."', 'fale-conosco')";
    }
}



if(!empty($_GET['limpar_campo'])){
    $sql_update = "
    UPDATE fale_conosco_texto SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    ".$_GET['limpar_campo']."=''
    WHERE
    id='1'";

    if(mysql_query($sql_update)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Arquivo deletado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível deletar o arquivo!</p>";
    }
}

$sql_fale_conosco = "SELECT * FROM fale_conosco_texto WHERE id='1'";
$sql_fale_conosco = mysql_query($sql_fale_conosco);
$dados_fale_conosco = mysql_fetch_assoc($sql_fale_conosco);

/* SELECIONA SEO DA PÁGINA */
$sql_seo    = "SELECT * FROM seo WHERE pagina='fale-conosco' AND (title<>'' OR keywords<>'' OR description<>'')";
$sql_seo    = mysql_query($sql_seo) or die (mysql_error());
$dados_seo  = mysql_fetch_assoc($sql_seo);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Fale conosco
            <small>texto principal</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/fale_conosco_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <br clear="all">
            <?=$mensagem?>

            <form role="form" action="?secao=fale_conosco_texto&acao=atualizar" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box box-info" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header">
                            <h3 class="box-title">Texto Principal</h3>
                        </div>

                        <div class="box-body pad">
                            <textarea id="texto_principal" name="texto_principal" class="ckeditor" rows="10" cols="80"><?=$dados_fale_conosco['texto_principal']?></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Arquivos</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group" style="width:100%; float:left; margin-bottom:5px;">
                                <label for="imagem_fundo" class="col-sm-3 control-label text-right">Imagem de fundo (2000x250)</label>
                                <div class="col-sm-4">
                                    <input type="file" id="imagem_fundo" name="imagem_fundo">
                                </div>

                                <div class="col-sm-4">
                                    <?php if(!empty($dados_fale_conosco['imagem_fundo'])){ ?>
                                        <a href="arquivos/fale_conosco/<?=$dados_fale_conosco['imagem_fundo']?>" target="blank" class="btn btn-primary">Visualizar</a>
                                        <a href="?secao=fale_conosco_texto&limpar_campo=imagem_fundo" class="btn btn-danger">Deletar</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">SEO</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="<?=$dados_seo['title']?>" placeholder="Title da página">
                            </div>

                            <div class="form-group">
                                <label for="keywords">Keywords</label>
                                <input type="text" id="keywords" class="form-control" name="keywords" value="<?=$dados_seo['keywords']?>" placeholder="Keywords da página">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" id="description" class="form-control" name="description" value="<?=$dados_seo['description']?>" placeholder="Description da página">
                            </div>
                        </div>
                    </div>
                </div>

                <center>
                    <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Atualizar</button>
                </center>
            </form>
        </div>
    </section>
</div>
