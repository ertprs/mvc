<div class="modal fade modal-vcenter" id="lembrarSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content bgModal_buscaAvancada" style="border-radius:0;">
            <div class="modal-header bg-vermelho">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fonte24 branco">×</span>
                </button>
                
                <h4 class="modal-title branco" id="myModalLabel">
                    ESQUECI MINHA SENHA:  
                </h4>
            </div>
                
            <form action="" method="post" enctype="multipart/form-data" name="formulario_lembrar" id="formulario_lembrar" onSubmit="lembrarSenha(); return false;">
                <div class="modal-body">
                    <div class="form-group">
                        <span style="width:100%; display:block; font-weight:700; text-align:center; padding-bottom:12px;">
                            Caso tenha esquecido sua senha, informe o seu email no campo abaixo.<br />
                            Sua nova senha será enviada para o email cadastrado.
                        </span>                        
                        <div id="ajax_mensagem_lembrar"></div>
                        <br />
                        <label for="email_lembrar" class="control-label vermelho">Email</label>
                        <input type="email" class="form-control" id="email_lembrar" name="email_lembrar" required>
                    </div>
                    <div class="modal-footer" style="padding:15px 0;">
                        <right>
                            <button type="submit" class="btn btn-primary bg-vermelho"  style="border-radius:0;">
                                <span class="glyphicon glyphicon-send" /> </span>&nbsp;&nbsp; Enviar
                            </button>
                        <right>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>