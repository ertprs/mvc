<?php
if($_GET['cadastrado'] == 1){
    $mensagem = "<p class='bg-success'>Cadastro efetuado com sucesso!</p>";
}


if($_GET['acao'] == 'atualizar'){
    $input_nome   = mysql_real_escape_string($_POST['input_nome']);
    $input_email  = mysql_real_escape_string($_POST['input_email']);
    $input_nivel  = mysql_real_escape_string($_POST['input_nivel']);
    $input_login = mysql_real_escape_string($_POST['input_login']);
    $input_senha  = mysql_real_escape_string($_POST['input_senha']);
    $input_status  = mysql_real_escape_string($_POST['input_status']);


    $foto_tmp = $_FILES['input_foto']['tmp_name'];
    $foto_name = $_FILES['input_foto']['name'];

    if(!empty($foto_name)){
        $foto_name = removercaracteres(date('dmYHis').$foto_name);
        $muda_foto = ",perfil='".$foto_name."' ";
    }

    if(!empty($input_senha)){
        $muda_senha = ",senha='".md5($input_senha)."' ";
    }

    $sql_update = "
    UPDATE usuario SET
    nome='".$input_nome."',
    email='".$input_email."',
    nivel_id='".$input_nivel."',
    login='".$input_login."' ,
    status='".$input_status."'
    ".$muda_senha."
    ".$muda_foto."
    WHERE
    id='".$_GET['id']."'";

    if(mysql_query($sql_update)){
        copy($foto_tmp, 'arquivos/usuarios/'.$foto_name);
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Campos atualizados com sucesso!</p><br clear='all'>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!</p><br clear='all'>";
    }
}

$sql_usuario = "SELECT * FROM usuario WHERE id='".abs($_GET['id'])."'";
$sql_usuario = mysql_query($sql_usuario);
$dados_usuario = mysql_fetch_assoc($sql_usuario);

if($_GET['acao'] == 'atualizar'){
    $_SESSION['dados_usuario_online'] = $dados_usuario;
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Usuários
            <small>Editar</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="?secao=main"><i class="fa fa-dashboard"></i> Página inicial</a></li>
            <li><a href="?secao=usuarios">Usuários</a></li>
            <li class="active">Editar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <form role="form" action="?secao=usuarios_editar&acao=atualizar&id=<?=$_GET['id']?>" method="post"  enctype="multipart/form-data">
                <?=$mensagem?>

                <div class="col-md-6">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-nome">Nome</label>
                                <input type="text" class="form-control" id="input-nome" name="input_nome" placeholder="Nome" value="<?=$dados_usuario['nome']?>">
                            </div>

                            <div class="form-group">
                                <label for="input-email">Email</label>
                                <input type="email" class="form-control" id="input-email" name="input_email" placeholder="Email" value="<?=$dados_usuario['email']?>">
                            </div>

                            <div class="form-group">
                                <label for="input-email">Nível</label>
                                <select class="form-control" id="input-nivel" name="input_nivel">
                                    <?php
                                    $sql_niveis = "SELECT id,nome FROM nivel ORDER BY nome ASC";
                                    $sql_niveis = mysql_query($sql_niveis);
                                    while($linha_niveis = mysql_fetch_assoc($sql_niveis)){
                                        echo "<option value='".$linha_niveis['id']."' ".($dados_usuario['nivel_id'] == $linha_niveis['id'] ? "selected" : "").">".$linha_niveis['nome']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">Foto</label>
                                <input type="file" id="input-foto" name="input_foto">
                                <?php if($dados_usuario['perfil'] != ''){ ?>
                                    <a href="arquivos/usuarios/<?=$dados_usuario['perfil']?>" target="blank">Visualizar arquivo</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-primary" style="height:349px; border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados de acesso</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-nome">Login</label>
                                <input type="text" class="form-control" id="input-login" name="input_login" placeholder="Login" value="<?=$dados_usuario['login']?>">
                            </div>

                            <div class="form-group">
                                <label for="input-senha">Senha</label>
                                <input type="password" class="form-control" id="input-senha" name="input_senha" placeholder="Senha">
                            </div>

                            <div class="form-group">
                                <label for="input-email">Status</label>
                                <select class="form-control" id="input-status" name="input_status">
                                    <option value='1' <?php if($dados_usuario['status'] == 1){ ?>selected<?php } ?>>Ativo</option>
                                    <option value='0' <?php if($dados_usuario['status'] == 0){ ?>selected<?php } ?>>Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Atualizar</button>
                </div>
            </form>
        </div>
    </section>
</div>