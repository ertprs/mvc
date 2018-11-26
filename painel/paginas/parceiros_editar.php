<?php
if($_GET['cadastrado'] == 1){
    $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Registro cadastrado com sucesso!</p>";
}


if($_GET['acao'] == 'atualizar'){
    $input_nome = mysql_real_escape_string($_POST['input_nome']);
    $input_link = mysql_real_escape_string($_POST['input_link']);

    $logo_tmp = $_FILES['input_logo']['tmp_name'];
    $logo_name = $_FILES['input_logo']['name'];

    if(!empty($logo_name)){
        $logo_name = removercaracteres(date('dmYHis').$logo_name);
        $muda_logo=",logo='".$logo_name."' ";
    }

    $sql_update = "
    UPDATE parceiros SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    nome='".$input_nome."',
    link='".$input_link."'
    ".$muda_logo."
    WHERE
    id='".$_GET['id']."'";

    if(mysql_query($sql_update)){
        if(!empty($logo_name)){move_uploaded_file($logo_tmp, 'arquivos/parceiros/'.$logo_name);}
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Registro atualizado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!</p>";
    }
}

$sql_parceiro = "SELECT * FROM parceiros WHERE id='".abs($_GET['id'])."'";
$sql_parceiro = mysql_query($sql_parceiro);
$dados_parceiro = mysql_fetch_assoc($sql_parceiro);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Parceiros
            <small>Editar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/parceiros_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <br clear="all">
            <?=$mensagem?>

            <form role="form" action="?secao=parceiros_editar&acao=atualizar&id=<?=$_GET['id']?>" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">

                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-nome" class="col-sm-2 control-label text-right">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-nome" name="input_nome" placeholder="Nome" value="<?=$dados_parceiro['nome']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-link" class="col-sm-2 control-label text-right">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-link" name="input_link" placeholder="Link" value="<?=$dados_parceiro['link']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-logo" class="col-sm-2 control-label text-right">Logo</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control pull-left" id="input-logo" name="input_logo" style="width:auto;">
                                    <?php if(!empty($dados_parceiro['logo'])){?>
                                        <a href="arquivos/parceiros/<?=$dados_parceiro['logo']?>" target="blank" class="btn btn-primary" style="margin-left:10px;color:<?=$cor3?> !important">Visualizar arquivo</a>
                                    <?php } ?>
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

