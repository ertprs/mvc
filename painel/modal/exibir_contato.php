<div id="modal-exibe-contato" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Contato</h4>
            </div>
            
            <div class="modal-body" id="conteudo-exibe_contato">
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
function exibe_info_contato(id){
    $.post("ajax/ajax_exibe_contato.php",{
        id:id
    }).done(function(data){
        $('#conteudo-exibe_contato').html(data);
    });
}
</script>