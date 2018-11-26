<?php
if($_GET['acao'] == 'cadastrar_templates_campos' && !empty($_POST)){
    $label = $_POST['label'];
    $tipo = $_POST['tipo'];

    $sql_insert = "INSERT INTO templates_campos (label,tipo,template) VALUES ('".$label."','".$tipo."','".$_GET['id']."');";

    if(mysql_query($sql_insert)){
        $mensagem = "<p class='bg-success text-center' style='padding:10px;'>Campo cadastrado com sucesso!</p>";
        
    }else{
        $mensagem = "<p class='bg-danger text-center' style='padding:10px;'>Não foi possível efetuar o cadastro!</p>";
    }
}

?>

<div id="modal-templates-campos-cadastrar" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-templates-campos-cadastro" class="form-horizontal" method="post" action="?secao=templates_editar&id=<?=$_GET['id']?>&acao=cadastrar_templates_campos">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Campos - Cadastrar</h4>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="label" class="col-sm-2 control-label">Label</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="label" name="label">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="tipo" class="col-sm-2 control-label">Tipo</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="input_text">input_text</option>
                                <option value="input_file">input_file</option>
                                <option value="textarea">textarea</option>
                            </select>
                        </div>
                    </div>
                
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>