
<?php
if($_GET['cadastrado'] == 1){
    $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Banner cadastrado com sucesso!</p>";
}


if($_GET['acao'] == 'atualizar'){
    $input_titulo         = mysql_real_escape_string($_POST['input_titulo']);
    $input_link           = mysql_real_escape_string($_POST['input_link']);
    $input_status         = mysql_real_escape_string($_POST['input_status']);
    $input_nova_janela    = mysql_real_escape_string($_POST['input_nova_janela']);

    $arquivo_tmp = $_FILES['input_arquivo']['tmp_name'];
    $arquivo_name = $_FILES['input_arquivo']['name'];

    if(!empty($arquivo_name)){
        $arquivo_name = removercaracteres(date('dmYHis').$arquivo_name);
        $muda_arquivo=",arquivo='".$arquivo_name."' ";
    }

    $arquivo_mobile_tmp = $_FILES['input_arquivo_mobile']['tmp_name'];
    $arquivo_mobile_name = $_FILES['input_arquivo_mobile']['name'];

    if(!empty($arquivo_mobile_name)){
        $arquivo_mobile_name = removercaracteres(date('dmYHis').$arquivo_mobile_name);
        $muda_arquivo_mobile=",arquivo_mobile='".$arquivo_mobile_name."' ";
    }

    $sql_update = "
    UPDATE banner_principal SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    titulo='".$input_titulo."',
    link='".$input_link."',
    status='".$input_status."',
    nova_janela='".$input_nova_janela."'
    ".$muda_arquivo."
    ".$muda_arquivo_mobile."
    WHERE
    id='".$_GET['id']."'";

    if(mysql_query($sql_update)){
        if(!empty($arquivo_mobile_name)){move_uploaded_file($arquivo_mobile_tmp, 'arquivos/banners_principais/'.$arquivo_mobile_name);}
        if(!empty($arquivo_name)){move_uploaded_file($arquivo_tmp, 'arquivos/banners_principais/'.$arquivo_name);}

        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Banner atualizado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização! ".mysql_error()."</p>";
    }
}

$sql_banner = "SELECT * FROM banner_principal WHERE id='".abs($_GET['id'])."'";
$sql_banner = mysql_query($sql_banner);
$dados_banner = mysql_fetch_assoc($sql_banner);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Banners Principais
            <small>Editar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/banners_principais_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <br clear="all">
            <?=$mensagem?>

            <form role="form" action="?secao=banners_principais_editar&acao=atualizar&id=<?=$_GET['id']?>" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">

                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-titulo" class="col-sm-2 control-label text-right">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-titulo" name="input_titulo" placeholder="Título" value="<?=$dados_banner['titulo']?>">
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
                                    <input type="text" class="form-control" id="input-link" name="input_link" placeholder="Link" value="<?=$dados_banner['link']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-nova-janela" class="col-sm-2 control-label text-right">Nova janela</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-nova-janela" name="input_nova_janela" style="max-width:200px;">
                                        <option value='1' <?php if($dados_banner['nova_janela'] == 1){?>selected<?php } ?>>Sim</option>
                                        <option value='0' <?php if($dados_banner['nova_janela'] == 0){?>selected<?php } ?>>Não</option>
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
                                    <?php if(!empty($dados_banner['arquivo'])){?>
                                        <a href="arquivos/banners_principais/<?=$dados_banner['arquivo']?>" target="blank" class="btn btn-primary" style="margin-left:10px;">Visualizar arquivo</a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-arquivo_mobile" class="col-sm-2 control-label text-right">Imagem mobile (768x1024)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control pull-left" id="input-arquivo_mobile" name="input_arquivo_mobile" style="width:auto;">
                                    <?php if(!empty($dados_banner['arquivo_mobile'])){?>
                                        <a href="arquivos/banners_principais/<?=$dados_banner['arquivo_mobile']?>" target="blank" class="btn btn-primary" style="margin-left:10px;">Visualizar arquivo</a>
                                    <?php } ?>
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
                                        <option value='1' <?php if($dados_banner['status'] == 1){?>selected<?php } ?>>Ativo</option>
                                        <option value='0' <?php if($dados_banner['status'] == 0){?>selected<?php } ?>>Inativo</option>
                                    </select>
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

