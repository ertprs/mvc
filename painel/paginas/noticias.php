<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM noticia WHERE id='".$_GET['deletar']."'";

    if(mysql_query($sql_delete)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Notícia deletada com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível deletar a notícia!</p>";
    }
}
?>


<?php if(checa_permissao($_SESSION['nivel_online'],'noticias_editar')){ ?>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript">

    $(function(){
        $(".ordem-table tbody").sortable({
            opacity: 0.6,
            cursor: 'move',
            update: function(){
                var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
                $.post("paginas/noticias_update_ordem.php", order, function(theResponse){
                    location.reload();
                });
            }
        });
    });
    </script>
<?php } ?>


<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Inspire-se
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/noticias_menu.php"; ?>
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
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:200px;" class="text-center">Imagem</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:140px;" class="text-center">Data</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:35%;" class="text-center">Título</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Status</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql_noticias = "
                                SELECT
                                    id,
                                    titulo,
                                    data,
                                    arquivo,
                                    arquivo,
                                    status
                                FROM
                                    noticia
                                WHERE
                                    id=id AND
                                    (estado_id='0' OR estado_id='".$_SESSION['painel_estado']."')
                                ORDER BY
                                    status DESC
                                ";

                                $sql_noticias = mysql_query($sql_noticias);
                                if(mysql_num_rows($sql_noticias) > 0){
                                    while($linha_noticias = mysql_fetch_assoc($sql_noticias)){
                                        echo "
                                        <tr id='recordsArray_".$linha_noticias['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_noticias['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                ".(!empty($linha_noticias['arquivo']) ? "
                                                    <img src='arquivos/noticias/".substr($linha_noticias['arquivo'],0,-4)."_thumbnail2.jpg' class='img-responsive'>
                                                " : "")."
                                            </td>
                                            <td class='text-center' style='vertical-align:middle;'>".converte_data($linha_noticias['data'])."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_noticias['titulo']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".($linha_noticias['status'] == 1 ? "Ativo" : "Inativo")."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                ".(checa_permissao($_SESSION['nivel_online'],'noticias_editar') ? "
                                                    <a href='?secao=noticias_editar&id=".$linha_noticias['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                        <img src='imagens/edit.png' height='16'>
                                                    </a>
                                                    &nbsp;
                                                " : "")."

                                                ".(checa_permissao($_SESSION['nivel_online'],'noticias_deletar') ? "
                                                    <a href='javascript:;' onClick='Deletar(\"?secao=noticias&deletar=".$linha_noticias['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
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
                                        <td colspan='4' class='text-center' style='vertical-align:middle;'>Nenhuma dica cadastrada!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Imagem</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Data</th>
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
