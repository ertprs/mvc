<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM banner_principal WHERE id='".$_GET['deletar']."'";

    if(mysql_query($sql_delete)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Banner deletado com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível deletar o banner!</p>";
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
            $.post("paginas/banners_principais_update_ordem.php", order, function(theResponse){
                location.reload();
            });
        }
    });
});
</script>


<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Banners Principais
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/banners_principais_menu.php"; ?>
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
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Ordem</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Título</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Status</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $condicao = '';

                                $sql_banner_principal = "SELECT id,ordem,titulo,arquivo,status FROM banner_principal ORDER BY status DESC, ordem ASC";
                                $sql_banner_principal = mysql_query($sql_banner_principal);
                                if(mysql_num_rows($sql_banner_principal) > 0){
                                    while($linha_banner_principal = mysql_fetch_assoc($sql_banner_principal)){
                                        echo "
                                        <tr id='recordsArray_".$linha_banner_principal['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_banner_principal['ordem']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_banner_principal['titulo']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".($linha_banner_principal['status'] == 1 ? "Ativo" : "Inativo")."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Arraste para alterar a ordem'>
                                                    <img src='imagens/move.png' height='18'>
                                                </a>
                                                &nbsp;

                                                ".(checa_permissao($_SESSION['nivel_online'],'banners_principais_editar') ? "
                                                    <a href='?secao=banners_principais_editar&id=".$linha_banner_principal['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                        <img src='imagens/edit.png' height='16'>
                                                    </a>
                                                    &nbsp;
                                                " : "")."

                                                ".(checa_permissao($_SESSION['nivel_online'],'banners_principais_deletar') ? "
                                                    <a href='javascript:;' onClick='Deletar(\"?secao=banners_principais&deletar=".$linha_banner_principal['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
                                                        <img src='imagens/delete.png' height='16'>
                                                    </a>
                                                " : "")."
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='4' class='text-center' style='vertical-align:middle;'>Nenhum banner cadastrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Ordem</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Título</th>
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
