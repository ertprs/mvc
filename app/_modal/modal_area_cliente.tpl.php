<div class="modal fade modal-vcenter" id="areacliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content bgModal_buscaAvancada" style="border-radius:0;">
            <div class="modal-header bg-vermelho">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fonte24 branco">×</span>
                </button>
                
                <h4 class="modal-title branco" id="myModalLabel">
                    MINHA CONTA:
                </h4>
            </div>
                
            <form action="<?=$data['path']?>/area-restrita/?acao=logar&fin=1" method="post" enctype="multipart/form-data" name="formulario_senha" id="formulario_acesso">
                <div class="modal-body">
                    <div class="form-group">
                        <span style="width:100%; display:block; font-weight:700; text-align:center;">
                            Informe seu e-mail e senha para acessar sua conta:
                        </span>
                        <!--   <div id="ajax_mensagem"></div> -->
                        <label for="email-acesso" class="control-label vermelho">E-mail</label>
                        <input type="email" class="form-control" id="email-acesso" name="email" required>
                        <br />
                        <label for="senha-acesso" class="control-label vermelho">Senha</label>
                        <input type="password" class="form-control" id="senha-acesso" name="senha" required>
                        
                    </div>
                    <div class="modal-footer" style="padding:15px 0;">
                        <a href="javascript:;" class="vermelho fonte12 pull-left" data-toggle="modal" data-target="#lembrarSenha" style="padding-top:5px; display:block;"> 
                          [ Esqueci minha senha ] 
                        </a>
                        <right>
                            <button type="submit" class="btn btn-primary bg-vermelho" style="border-radius:0;">
                                <span class="glyphicon glyphicon-send" /> </span>&nbsp;&nbsp; Enviar
                            </button>
                        <right>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>