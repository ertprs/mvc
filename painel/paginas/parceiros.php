<?php

if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM parceiros WHERE id='".$_GET['deletar']."'";

    if(mysql_query($sql_delete)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Parceiro deletado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível deletar o parceiro!</p>";
    }
}

?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">

$(function(){
    $(".ordem-table tbody").sortable({
        opacity: 0.6,
        cursor: 'move',
        update: function(){
            var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
            $.post("paginas/parceiros_update_ordem.php", order, function(theResponse){
                location.reload();
            });
        }
    });
});
</script>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Parceiros
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/parceiros_menu.php"; ?>
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
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:10%;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:15%;" class="text-center">Logo</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql_parceiros = "SELECT id,nome,logo FROM parceiros ORDER BY ordem ASC";
                                $sql_parceiros = mysql_query($sql_parceiros);
                                if(mysql_num_rows($sql_parceiros) > 0){
                                    while($linha_parceiros = mysql_fetch_assoc($sql_parceiros)){
                                        echo "
                                        <tr id='recordsArray_".$linha_parceiros['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_parceiros['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <center>
                                                    <img src='arquivos/parceiros/".$linha_parceiros['logo']."' class='img-responsive'>
                                                </center>
                                            </td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_parceiros['nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Mover'>
                                                    <img src='imagens/move.png' height='18'>
                                                </a>
                                                &nbsp;

                                                <a href='?secao=parceiros_editar&id=".$linha_parceiros['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                    <img src='imagens/edit.png' height='16'>
                                                </a>
                                                &nbsp;

                                                <a  href='javascript:;' onClick='Deletar(\"?secao=parceiros&deletar=".$linha_parceiros['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
                                                    <img src='imagens/delete.png' height='16'>
                                                </a>
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='4' class='text-center' style='vertical-align:middle;'>Nenhum parceiro cadastrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Logo</th>
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
