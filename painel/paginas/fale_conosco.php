<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM fale_conosco WHERE id='".$_GET['deletar']."'";

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
            Fale conosco
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/fale_conosco_menu.php"; ?>
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
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:150px;" class="text-center">Data</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:150px;" class="text-center">Assunto</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Email</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                          
                               

                                $sql_fale_conosco = "SELECT id,assunto,(SELECT nome FROM fale_conosco_assuntos WHERE fale_conosco_assuntos.id=fale_conosco.assunto) as nome_assunto,data,nome,email FROM fale_conosco ORDER BY data ASC,id ASC";
                                $sql_fale_conosco = mysql_query($sql_fale_conosco) or die (mysql_error());
                                if(mysql_num_rows($sql_fale_conosco) > 0){
                                    while($linha_fale_conosco = mysql_fetch_assoc($sql_fale_conosco)){
                                        echo "
                                        <tr id='recordsArray_".$linha_fale_conosco['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_fale_conosco['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".date("d/m/Y H:i:s", strtotime($linha_fale_conosco['data']))."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_fale_conosco['nome_assunto']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_fale_conosco['nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_fale_conosco['email']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=fale_conosco_detalhes&id=".$linha_fale_conosco['id']."' data-toggle='tooltip' data-placement='top' title='Detalhes'>
                                                    <img src='imagens/add.png' height='18'>
                                                </a>
                                                &nbsp;
                                                <a href='javascript:;' onClick='Deletar(\"?secao=fale_conosco&deletar=".$linha_fale_conosco['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
                                                    <img src='imagens/cancel.png' height='18'>
                                                </a>
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='6' class='text-center' style='vertical-align:middle;'>Nenhum registro cadastrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:150px;" class="text-center">Data</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>; width:150px;" class="text-center">Assunto</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Email</th>
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
