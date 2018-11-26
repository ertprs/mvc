<?php

if($_GET['acao'] == 'cadastrar'){
    $input_cod_venda = mysql_real_escape_string($_POST['input_cod_venda']);
    $input_nome      = mysql_real_escape_string($_POST['input_nome']);
    $input_categoria = mysql_real_escape_string($_POST['input_categoria']);
    $input_parceiro  = mysql_real_escape_string($_POST['input_parceiro']);
    $input_descricao = mysql_real_escape_string($_POST['input_descricao']);
    $input_status    = mysql_real_escape_string($_POST['input_status']);
    $input_destaque  = mysql_real_escape_string($_POST['input_destaque']);
    $input_preco     = mysql_real_escape_string($_POST['input_preco']);

    $foto_tmp  = $_FILES['input_foto']['tmp_name'];
    $foto_name = $_FILES['input_foto']['name'];

    if(!empty($foto_name)){
        $foto_name = removercaracteres(date('dmYHis').$foto_name);
    }

    $sql_insert = "
    INSERT INTO produtos
    (data_cadastro,usuario_cadastro,nome,cod_venda,destaque,categoria,parceiro_id,foto,descricao,status,preco)
    VALUES
    (NOW(),'".$_SESSION['usuario_online']."','".$input_nome."','".$input_cod_venda."','".$input_destaque."','".$input_categoria."','".$input_parceiro."','".$foto_name."','".$input_descricao."','".$input_status."','".$input_preco."')
    ";

    if(mysql_query($sql_insert)){
        // #### THUMBNAILS
        $targetFile = 'arquivos/produtos/'.$foto_name;

        move_uploaded_file($foto_tmp, $targetFile);

        // #### THUMBNAILS
        $thumbnail[] = array('sufixo' => '_thumbnail.jpg',  'x' => '297', 'y' => '297');
        include "imagens_resize.php";

        echo "<script>location.href = '?secao=produtos_editar&id=".mysql_insert_id()."&cadastrado=1';</script>";

    }else{
        $mensagem = "<p class='bg-danger'>Não foi possível efetuar o cadastro!</p>";
    }
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Produtos
            <small>Cadastrar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/produtos_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <?=$mensagem?>

            <form role="form" id="form" action="?secao=produtos_cadastrar&acao=cadastrar" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-nome" class="col-sm-2 control-label text-right">Código de venda *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-cod-venda" name="input_cod_venda" placeholder="Código de venda" required>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="input-nome" class="col-sm-2 control-label text-right">Nome *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-nome" name="input_nome" placeholder="Nome" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-categoria" class="col-sm-2 control-label text-right">Categoria *</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-categoria" name="input_categoria" required>
                                        <option value="">Escolha uma opção</option>
                                        <?php
                                        $sql_categorias = "SELECT id,nome FROM produtos_categorias ORDER BY nome ASC";
                                        $sql_categorias = mysql_query($sql_categorias);
                                        while($linha_categorias = mysql_fetch_assoc($sql_categorias)){
                                            echo "<option value='".$linha_categorias['id']."'>".$linha_categorias['nome']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-parceiro" class="col-sm-2 control-label text-right">Parceiro *</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-parceiro" name="input_parceiro" required>
                                        <option value="">Escolha uma opção</option>
                                        <?php
                                        $sql_parceiros = "SELECT id,nome FROM parceiros ORDER BY nome ASC";
                                        $sql_parceiros = mysql_query($sql_parceiros);
                                        while($linha_parceiros = mysql_fetch_assoc($sql_parceiros)){
                                            echo "<option value='".$linha_parceiros['id']."'>".$linha_parceiros['nome']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-foto" class="col-sm-2 control-label text-right">Foto *</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="input-foto" name="input_foto" style="width:auto;" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-preco" class="col-sm-2 control-label text-right">Preço</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control real" id="input-preco" name="input_preco" placeholder="Preço">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Descrição</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <div class="box-body pad">
                                    <textarea id="descricao" name="input_descricao" class="ckeditor" rows="10" cols="80"></textarea>
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
                                    <select class="form-control" id="input-status" name="input_status" style="max-width:200px;" required>
                                        <option value='1'>Ativo</option>
                                        <option value='0'>Inativo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-status" class="col-sm-2 control-label text-right">Destaque</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-destaque" name="input_destaque" style="max-width:200px;" required>
                                        <option value='1'>Sim</option>
                                        <option value='0'>Não</option>
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