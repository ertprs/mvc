<?php
if($_GET['cadastrado'] == 1){
    $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Registro cadastrado com sucesso!</p>";
}


if($_GET['acao'] == 'atualizar'){
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
        $muda_foto=",foto='".$foto_name."' ";
    }

    $sql_update = "
    UPDATE produtos SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    cod_venda='".$input_cod_venda."',
    nome='".$input_nome."',
    categoria='".$input_categoria."',
    parceiro_id='".$input_parceiro."',
    descricao='".$input_descricao."',
    status='".$input_status."',
    destaque='".$input_destaque."',
    preco='".$input_preco."'
    ".$muda_foto."
    WHERE
    id='".$_GET['id']."'";

    if(mysql_query($sql_update)){
        if(!empty($foto_name)){
            // #### THUMBNAILS
            $targetFile = 'arquivos/produtos/'.$foto_name;

            move_uploaded_file($foto_tmp, $targetFile);

            // #### THUMBNAILS
            $thumbnail[] = array('sufixo' => '_thumbnail.jpg',  'x' => '297', 'y' => '297');
            include "imagens_resize.php";
        }

        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Registro atualizado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!</p>";
    }
}

$sql_produto = "SELECT * FROM produtos WHERE id='".abs($_GET['id'])."'";
$sql_produto = mysql_query($sql_produto);
$dados_produto = mysql_fetch_assoc($sql_produto);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Produtos
            <small>Editar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/produtos_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <br clear="all">
            <?=$mensagem?>

            <form role="form" action="?secao=produtos_editar&acao=atualizar&id=<?=$_GET['id']?>" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">

                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-nome" class="col-sm-2 control-label text-right">Código de venda *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-cod-venda" name="input_cod_venda" placeholder="Código de venda" value="<?=$dados_produto['cod_venda']?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-nome" class="col-sm-2 control-label text-right">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-nome" name="input_nome" placeholder="Nome" value="<?=$dados_produto['nome']?>">
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
                                            echo "<option value='".$linha_categorias['id']."' ".($linha_categorias['id'] == $dados_produto['categoria'] ? "selected" : "").">".$linha_categorias['nome']."</option>";
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
                                            echo "<option value='".$linha_parceiros['id']."' ".($linha_parceiros['id'] == $dados_produto['parceiro_id'] ? "selected" : "").">".$linha_parceiros['nome']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-foto" class="col-sm-2 control-label text-right">Logo</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control pull-left" id="input-foto" name="input_foto" style="width:auto;">
                                    <?php if(!empty($dados_produto['foto'])){?>
                                        <a href="arquivos/produtos/<?=$dados_produto['foto']?>" target="blank" class="btn btn-primary" style="margin-left:10px;color:<?=$cor3?> !important">Visualizar arquivo</a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-preco" class="col-sm-2 control-label text-right">Preço</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control real" id="input-preco" name="input_preco" placeholder="Preço" value="<?=$dados_produto['preco']?>">
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
                                    <textarea id="descricao" name="input_descricao" class="ckeditor" rows="10" cols="80"><?=$dados_produto['descricao']?></textarea>
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
                                        <option value='1' <?php if($dados_produto['status'] == 1){?>selected<?php } ?>>Ativo</option>
                                        <option value='0' <?php if($dados_produto['status'] == 0){?>selected<?php } ?>>Inativo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-status" class="col-sm-2 control-label text-right">Destaque</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="input-destaque" name="input_destaque" style="max-width:200px;" required>
                                        <option value='1' <?php if($dados_produto['destaque'] == 1){?>selected<?php } ?>>Sim</option>
                                        <option value='0' <?php if($dados_produto['destaque'] == 0){?>selected<?php } ?>>Não</option>
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

