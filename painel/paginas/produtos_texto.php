<?php

if($_GET['acao'] == 'atualizar'){
    $input_titulo   = mysql_real_escape_string($_POST['input_titulo']);
    $texto1         = mysql_real_escape_string($_POST['texto1']);

    // IMAGEM PRINCIPAL
    $imagem_principal_tmp = $_FILES['imagem_principal']['tmp_name'];
    $imagem_principal_name = $_FILES['imagem_principal']['name'];

    if(!empty($imagem_principal_name)){
        $imagem_principal_name = removercaracteres(date('dmYHis').$imagem_principal_name);
        $muda_imagem_principal=",imagem_principal='".$imagem_principal_name."' ";
    }

    $sql_update = "
    UPDATE parceiros_texto SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    titulo='".$input_titulo."',
    texto1='".$texto1."'
    ".$muda_imagem_principal."
    WHERE
    id='1'";

    if(mysql_query($sql_update)){
        if(!empty($imagem_principal_name)){move_uploaded_file($imagem_principal_tmp, 'arquivos/parceiros/'.$imagem_principal_name);}
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Textos atualizados com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!".mysql_error()."</p>";
    }
}


if(!empty($_GET['limpar_campo'])){
    $sql_update = "
    UPDATE parceiros_texto SET
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

$sql_parceiro = "SELECT * FROM parceiros_texto WHERE id='1'";
$sql_parceiro = mysql_query($sql_parceiro) or die (mysql_error());
$dados_parceiro = mysql_fetch_assoc($sql_parceiro);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Clientes
            <small>Textos</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <?=$mensagem?>

            <form role="form" action="?secao=clientes_texto&acao=atualizar" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box box-info" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header">
                            <h3 class="box-title">Texto Principal</h3>
                        </div>

                        <div class="box-body pad">
                            <div class="form-group">
                                <label for="input-titulo" class="col-sm-2 control-label text-right">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-titulo" name="input_titulo" placeholder="Título" value="<?=$dados_parceiro['titulo']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="texto1" class="col-sm-2 control-label text-right">Texto 1</label>
                                <div class="col-sm-10">
                                    <textarea id="texto1" class="form-control" name="texto1" rows="4" cols="80"><?=$dados_parceiro['texto1']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Arquivos</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="imagem_fundo" class="col-sm-3 control-label text-right">Imagem principal</label>
                                <div class="col-sm-4">
                                    <input type="file" id="imagem_principal" name="imagem_principal">
                                </div>

                                <div class="col-sm-4">
                                    <?php if(!empty($dados_parceiro['imagem_principal'])){ ?>
                                        <a href="arquivos/clientes/<?=$dados_parceiro['imagem_principal']?>" target="blank" class="btn btn-primary">Visualizar</a>
                                        <a href="?secao=clientes&limpar_campo=imagem_principal" class="btn btn-danger">Deletar</a>
                                    <?php } ?>
                                </div>
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
