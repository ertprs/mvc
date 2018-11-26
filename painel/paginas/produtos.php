<?php

if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM produtos WHERE id='".$_GET['deletar']."'";

    if(mysql_query($sql_delete)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Parceiro deletado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível deletar o parceiro!</p>";
    }
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Produtos
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/produtos_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">

                        <?=$mensagem?>

                        <table id="example2" class="ordem-table table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:7%;" class="text-center">Cod.</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:15%;" class="text-center">Imagem</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:35%;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:15%;" class="text-center">Parceiro</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Status</th>
                                    <th style="background-color:#ccc;" class="text-center"></th
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql_produtos = "SELECT id,nome,foto,parceiro_id,status,(SELECT nome FROM parceiros WHERE parceiros.id=produtos.parceiro_id) as parceiro_nome FROM produtos ORDER BY id ASC";
                                $sql_produtos = mysql_query($sql_produtos);
                                if(mysql_num_rows($sql_produtos) > 0){
                                    while($linha_produtos = mysql_fetch_assoc($sql_produtos)){
                                        echo "
                                        <tr id='recordsArray_".$linha_produtos['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_produtos['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <img src='arquivos/produtos/".$linha_produtos['foto']."' class='img-responsive'>
                                            </td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_produtos['nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_produtos['parceiro_nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".($linha_produtos['status'] == 1 ? "Ativo" : "Inativo")."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Mover'>
                                                    <img src='imagens/move.png' height='18'>
                                                </a>
                                                &nbsp;

                                                <a href='?secao=produtos_editar&id=".$linha_produtos['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                    <img src='imagens/edit.png' height='16'>
                                                </a>
                                                &nbsp;

                                                <a href='javascript:;' onClick='Deletar(\"?secao=produtos&deletar=".$linha_produtos['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
                                                    <img src='imagens/delete.png' height='16'>
                                                </a>
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='5' class='text-center' style='vertical-align:middle;'>Nenhum produto cadastrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">imagem</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Parceiro</th>
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
