<?php

if($_GET['acao'] == 'atualizar'){
    $input_video = mysql_real_escape_string($_POST['input_video']);
    $texto = mysql_real_escape_string($_POST['texto']);

    $sql_update = "
    UPDATE a_empresa SET
    data_atualizacao=NOW(),
    usuario_atualizacao='".$_SESSION['usuario_online']."',
    texto='".$texto."'
    WHERE
    id='1'";

    if(mysql_query($sql_update)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Textos atualizados com sucesso!</p>";

    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!".mysql_error()."</p>";
    }
}


$sql_grupo = "SELECT * FROM a_empresa WHERE id='1'";
$sql_grupo = mysql_query($sql_grupo) or die (mysql_error());
$dados_grupo = mysql_fetch_assoc($sql_grupo);

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            A empresa
            <small>Textos</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <?=$mensagem?>

            <form role="form" action="?secao=a_empresa&acao=atualizar" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    


                    <div class="box box-info" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header">
                            <h3 class="box-title">Texto Principal</h3>
                        </div>

                        <div class="box-body pad">
                            <textarea id="texto" name="texto" class="ckeditor" rows="10" cols="80"><?=$dados_grupo['texto']?></textarea>
                        </div>
                    </div>
                </div>


                <center>
                    <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Atualizar</button>
                </center>
            </form>
        </div>
    </section>
</div>
