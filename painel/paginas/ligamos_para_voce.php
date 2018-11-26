<?php
if(!empty($_GET['deletar'])){
    $sql_delete = "DELETE FROM ligamos_para_voce WHERE id='".$_GET['deletar']."'";

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
            Ligamos para você
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/ligamos_para_voce_menu.php"; ?>
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
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff; width:150px;" class="text-center">Data</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Email</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">
                                    Telefone</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $condicao = '';
                                if(!empty($_SESSION['painel_estado'])){
                                    $condicao = " WHERE estado_id='".$_SESSION['painel_estado']."' ";
                                }

                                $sql_ligamos = "SELECT id,data_cadastro,nome,email,telefone FROM ligamos_para_voce ORDER BY data_cadastro ASC,id ASC";
                                $sql_ligamos = mysql_query($sql_ligamos) or die (mysql_error());
                                if(mysql_num_rows($sql_ligamos) > 0){
                                    while($linha_ligamos = mysql_fetch_assoc($sql_ligamos)){
                                        echo "
                                        <tr id='recordsArray_".$linha_ligamos['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                ".$linha_ligamos['id']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                ".date("d/m/Y H:i:s", strtotime($linha_ligamos['data_cadastro']))."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                ".$linha_ligamos['nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                ".$linha_ligamos['email']."</td>
                                             <td class='text-center' style='vertical-align:middle;'>
                                                ".$linha_ligamos['telefone']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=ligamos_para_voce_detalhes&id=".$linha_ligamos['id']."' data-toggle='tooltip' data-placement='top' title='Detalhes'>
                                                    <img src='imagens/add.png' height='18'>
                                                </a>
                                                &nbsp;
                                                <a href='?secao=ligamos_para_voce&deletar=".$linha_ligamos['id']."' data-toggle='tooltip' data-placement='top' title='Deletar'>
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
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Id</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff; width:150px;" class="text-center">Data</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Nome</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff;" class="text-center">Email</th>
                                    <th style="background-color:<?=$cor1?>; color:#fff; width:150px;" class="text-center"> Telefone </th>
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
