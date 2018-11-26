<?php

if($_GET['acao'] == 'atualizar'){
    if(!empty($_POST['telefone'])){
        $sucesso = 1;
        foreach($_POST['telefone'] as $key=>$linha){
            $sql = "
            UPDATE codigos_site SET
                telefone='".$_POST['telefone'][$key]."',
                telefone2='".$_POST['telefone2'][$key]."',
                whatsapp='".$_POST['whatsapp'][$key]."',
                email='".$_POST['email'][$key]."',
                codigo='".mysql_real_escape_string($_POST['codigo'][$key])."',
                atendimento_online_id='".$_POST['atendimento_online_id'][$key]."'
            WHERE
                estado_id='".$key."'
            ";

            if(!mysql_query($sql)){
                $sucesso = 0;
            }
        }

        if($sucesso == 1){
            $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Configurações atualizadas com sucesso!</p>";

        }else{
            $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar a atualização!".mysql_error()."</p>";
        }
    }
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Configurações de acesso
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <?=$mensagem?>

            <form role="form" action="?secao=configuracoes_acesso&acao=atualizar" method="post"  enctype="multipart/form-data">

                <?php
                $dados_acesso = mysql_fetch_assoc(mysql_query("SELECT * FROM codigos_site WHERE estado_id='".$linha['id']."'"));
                ?>

                <div class="col-md-12">
                    <div class="box box-info" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Acesso todos estados</h3>
                        </div>

                        <div class="box-body pad">
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Telefone</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="telefone[0]" placeholder="Telefone" value="<?=$dados_acesso['telefone']?>">
                                </div>

                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="telefone2[0]" placeholder="Telefone (somente números)" value="<?=$dados_acesso['telefone2']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Whatsapp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="whatsapp[0]" placeholder="Whatsapp" value="<?=$dados_acesso['whatsapp']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Id do atendimento online</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="atendimento_online_id[0]" placeholder="Telefone" value="<?=$dados_acesso['atendimento_online_id']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email[0]" placeholder="Email" value="<?=$dados_acesso['email']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Código</label>
                                <div class="col-sm-10">
                                    <textarea id="texto" name="codigo[0]" class="form-control" rows="15"><?=$dados_acesso['codigo']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $sql = "SELECT id,nome FROM estado ORDER BY nome ASC";
                $sql = mysql_query($sql);
                while($linha = mysql_fetch_assoc($sql)){
                    $dados_acesso = mysql_fetch_assoc(mysql_query("SELECT * FROM codigos_site WHERE estado_id='".$linha['id']."'"));
                    ?>

                        <div class="col-md-12">
                            <div class="box box-info" style="border-top-color:<?=$cor1?>;">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Acesso - <?=$linha['nome']?></h3>
                                </div>

                                <div class="box-body pad">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Telefone</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="telefone[<?=$linha['id']?>]" placeholder="Telefone" value="<?=$dados_acesso['telefone']?>">
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="telefone2[<?=$linha['id']?>]" placeholder="Telefone (somente números)" value="<?=$dados_acesso['telefone2']?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Whatsapp</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="whatsapp[<?=$linha['id']?>]" placeholder="Whatsapp" value="<?=$dados_acesso['whatsapp']?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Id do atendimento online</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="atendimento_online_id[<?=$linha['id']?>]" placeholder="Telefone" value="<?=$dados_acesso['atendimento_online_id']?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="email[<?=$linha['id']?>]" placeholder="Email" value="<?=$dados_acesso['email']?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-right" style="padding-top:5px;">Código</label>
                                        <div class="col-sm-10">
                                            <textarea id="texto" name="codigo[<?=$linha['id']?>]" class="form-control" rows="15"><?=$dados_acesso['codigo']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }

                ?>


                <center>
                    <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Atualizar</button>
                </center>
            </form>
        </div>
    </section>
</div>
