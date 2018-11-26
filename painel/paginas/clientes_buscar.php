<div class="modal fade" id="modal_busca" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Clientes - Buscar</h4>
            </div>

            <form action="?secao=clientes" method="get">
                <div class="modal-body">
                    <input type="hidden" name="secao" value="clientes">
                    <input type="hidden" name="buscar" value="true">

                    <div class="form-group">
                        <label for="input-nome" class="control-label">Nome</label>
                        <input type="text" class="form-control" id="input-nome" name="nome" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label for="input-sobrenome" class="control-label">Sobrenome</label>
                        <input type="text" class="form-control" id="input-sobrenome" name="sobrenome" placeholder="Sobrenome">
                    </div>

                    <div class="form-group">
                        <label for="input-email" class="control-label">Email</label>
                        <input type="text" class="form-control" id="input-email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="status" class="control-label">Status</label>
                        <select class="form-control" name="status">
                            <option value=''></option>
                            <option value='1'>Ativo</option>
                            <option value='0'>Inativo</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Buscar</button>
                </div>
            </form>
        </div>
    </div>
</div>