<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM usuario WHERE id='".$_GET['deletar']."'";

    if(mysql_query($sql_delete)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Usuário deletado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível deletar o usuário!</p>";
    }
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Usuários
            <small>listar</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="?secao=main"><i class="fa fa-dashboard"></i> Página inicial</a></li>
            <li><a href="?secao=usuarios">Usuários</a></li>
            <li class="active">Listar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <?=$mensagem?>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Foto</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nível</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Status</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql_usuarios = "SELECT id,nome,perfil,status,(SELECT nome FROM nivel WHERE id=usuario.nivel_id) as nome_nivel FROM usuario ORDER BY id ASC";
                                $sql_usuarios = mysql_query($sql_usuarios);
                                while($linha_usuarios = mysql_fetch_assoc($sql_usuarios)){
                                    echo "
                                    <tr>
                                        <td class='text-center' style='vertical-align:middle;'>".$linha_usuarios['id']."</td>
                                        <td class='text-center' style='vertical-align:middle;'>".(!empty($linha_usuarios['perfil']) ? "<img src='imagem.php?img=arquivos/usuarios/".$linha_usuarios['perfil']."&w=70&h=70&q=90' class='img-circle' alt='User image'>" : "")."</td>
                                        <td class='text-center' style='vertical-align:middle;'>".utf8_decode($linha_usuarios['nome'])."</td>
                                        <td class='text-center' style='vertical-align:middle;'>".$linha_usuarios['nome_nivel']."</td>
                                        <td class='text-center' style='vertical-align:middle;'>".($linha_usuarios['status'] == 1 ? "Ativo" : "Inativo")."</td>
                                        <td class='text-center' style='vertical-align:middle;'>
                                            <a href='?secao=usuarios_editar&id=".$linha_usuarios['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                <img src='imagens/edit.png' height='16'>
                                            </a>
                                            &nbsp;
                                            <a href='javascript:;' onClick='Deletar(\"?secao=usuarios&deletar=".$linha_usuarios['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
                                                <img src='imagens/cancel.png' height='16'>
                                            </a>
                                        </td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Foto</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nível</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Status</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
