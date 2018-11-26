<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM status_orcamento WHERE id='".$_GET['deletar']."'";

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
            Status de orçamento
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/status_orcamento_menu.php"; ?>
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
                                $sql_status_orcamento = "SELECT id,nome FROM status_orcamento ORDER BY nome ASC";
                                $sql_status_orcamento = mysql_query($sql_status_orcamento) or die (mysql_error());
                                if(mysql_num_rows($sql_status_orcamento) > 0){
                                    while($linha_status_orcamento = mysql_fetch_assoc($sql_status_orcamento)){
                                        echo "
                                        <tr id='recordsArray_".$linha_status_orcamento['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_status_orcamento['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_status_orcamento['nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=status_orcamento_editar&id=".$linha_status_orcamento['id']."' data-toggle='tooltip' data-placement='top' title='Editar'>
                                                    <img src='imagens/edit.png' height='18'>
                                                </a>
                                                &nbsp;
                                                <a href='javascript:;' onClick='Deletar(\"?secao=status_orcamento&deletar=".$linha_status_orcamento['id']."\")' data-toggle='tooltip' data-placement='top' title='Deletar'>
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
