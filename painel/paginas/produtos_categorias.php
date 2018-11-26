<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM produtos_categorias WHERE id='".$_GET['deletar']."'";

    if(mysql_query($sql_delete)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Registro deletado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível deletar o registro!</p>";
    }
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Produtos - Categorias
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/produtos_categorias_menu.php"; ?>
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
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql_categorias = "SELECT id,nome FROM produtos_categorias ORDER BY nome ASC";
                                $sql_categorias = mysql_query($sql_categorias) or die (mysql_error());
                                if(mysql_num_rows($sql_categorias) > 0){
                                    while($linha_categorias = mysql_fetch_assoc($sql_categorias)){
                                        echo "
                                        <tr id='recordsArray_".$linha_categorias['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_categorias['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_categorias['nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=produtos_categorias_editar&id=".$linha_categorias['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                    <img src='imagens/edit.png' height='18'>
                                                </a>
                                                &nbsp;
                                                <a href='javascript:;' onClick='Deletar(\"?secao=produtos_categorias&deletar=".$linha_categorias['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
                                                    <img src='imagens/cancel.png' height='18'>
                                                </a>
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='4' class='text-center' style='vertical-align:middle;'>Nenhum registro cadastrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome</th>
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
