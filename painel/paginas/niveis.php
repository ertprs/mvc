<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM nivel WHERE id='".$_GET['deletar']."'";

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
            Níveis
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/niveis_menu.php"; ?>
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
                                $sql_niveis = "SELECT id,nome FROM nivel ORDER BY nome ASC";
                                $sql_niveis = mysql_query($sql_niveis) or die (mysql_error());
                                if(mysql_num_rows($sql_niveis) > 0){
                                    while($linha_niveis = mysql_fetch_assoc($sql_niveis)){
                                        echo "
                                        <tr id='recordsArray_".$linha_niveis['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_niveis['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_niveis['nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=niveis_editar&id=".$linha_niveis['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                    <img src='imagens/edit.png' height='18'>
                                                </a>
                                                &nbsp;
                                                <a href='?secao=niveis&deletar=".$linha_niveis['id']."' data-toggle='tooltip' data-placement='top' title='Deletar'>
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
