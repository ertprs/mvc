<?php

/* ################## BUSCA ######################*/

$condicao = '';

if(!empty($_GET['cpf'])){
    $condicao .= " and cpf='".$_GET['cpf']."' ";
}

if(!empty($_GET['nome'])){
    $condicao .= " and nome LIKE '%".$_GET['nome']."%' ";
}

if(!empty($_GET['sobrenome'])){
    $condicao .= " and sobrenome LIKE '%".$_GET['sobrenome']."%' ";
}

if(!empty($_GET['email'])){
    $condicao .= " and email LIKE '%".$_GET['email']."%' ";
}

if($_GET['status'] == 0 && $_GET['status'] != ''){
    $condicao .= " and status=0 ";
}else{
    $condicao .= " and status=1 ";
}

$num_por_pagina = 20;
if(empty($_GET['pagina'])){$_GET['pagina'] = 1;}
$primeiro_registro = (abs($_GET['pagina']) * $num_por_pagina) - $num_por_pagina;


// REGISTROS
$clientes = array();

$sql_clientes = "
SELECT
    id,
    nome,
    telefone,
    email,
    status
FROM
    clientes
WHERE
    id=id
    ".$condicao."
ORDER BY
    id DESC
";

$total_clientes = mysql_num_rows(mysql_query($sql_clientes));
$sql_clientes = mysql_query($sql_clientes." LIMIT ".$primeiro_registro.", ".$num_por_pagina."") or die (mysql_error());
if(mysql_num_rows($sql_clientes) > 0){
    while($linha_clientes = mysql_fetch_assoc($sql_clientes)){
        $clientes[] = $linha_clientes;
    }
}

// PAGINACAO
$paginacao = paginacao($_GET['pagina'], "?secao=".$_GET['secao']."&cpf=".$_GET['cpf']."&nome=".$_GET['nome']."&sobrenome=".$_GET['sobrenome']."&email=".$_GET['email']."&status=".$_GET['status']."", $total_clientes, $num_por_pagina);

?>


<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Clientes
            <small>listar</small>
        </h1>

        <div class="pull-right">
            <?php include "paginas/clientes_menu.php"; ?>
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
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Imagem</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome completo</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">E-mail</th>
									<th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Telefone</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Status</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if($total_clientes > 0){
                                    foreach($clientes as $linha_clientes){
                                        echo "
                                        <tr id='recordsArray_".$linha_clientes['id']."'>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                ".(!empty($linha_clientes['foto']) ? "
                                                    <img src='arquivos/clientes/".substr($linha_clientes['foto'],0,-4)."_perfil.jpg' class='img-circle' height='60'>
                                                " : "")."
                                            </td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_clientes['nome']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_clientes['email']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".$linha_clientes['telefone']."</td>
                                            <td class='text-center' style='vertical-align:middle;'>".($linha_clientes['status'] == 1 ? "Ativo" : "Inativo")."</td>
                                            <td class='text-center' style='vertical-align:middle;'>
                                                <a href='?secao=clientes_detalhes&id=".$linha_clientes['id']."' data-toggle='tooltip' data-placement='top' title='Detalhes'>
                                                    <img src='imagens/add.png' height='18'>
                                                </a>
                                                &nbsp;
												<!--<a href='?secao=compras&cliente=".$linha_clientes['id']."' data-toggle='tooltip' data-placement='top' title='Compras'>
                                                    <img src='imagens/carrinho.gif' height='18'>
                                                </a>-->
                                            </td>
                                        </tr>
                                        ";
                                    }

                                }else{
                                    echo "
                                    <tr>
                                        <td colspan='4' class='text-center' style='vertical-align:middle;'>Nenhum cliente cadastrado!</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Imagem</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Nome completo</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">E-mail</th>
									<th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Telefone</th>
                                    <th style="background-color:<?=$cor1?>; color:<?=$cor_titulo?>;" class="text-center">Status</th>
                                    <th style="background-color:#ccc;" class="text-center"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <br clear="all">
            <?=$paginacao?>
            <br clear="all">

        </div>
    </section>
</div>
