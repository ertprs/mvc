<section class="section-internas" id="internas-area-cliente">
    <header class="header-section-internas">
        <div class="container">
            <h2>Orçamento</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <p>
            <b>Nome: </b><?=$_SESSION['cliente']['nome']?><br />
            <b>Email: </b><?=$_SESSION['cliente']['email']?><br />
            <b>Telefone: </b><?=$_SESSION['cliente']['telefone']?>
            </p>

            <hr />

            <h3>Dados do orçamento</h3>

            <p>
            <b>Código: </b><?=$this->info['id']?><br />
            <b>Data: </b><?=date("d/m/Y H:i:s", strtotime($this->info['data']));?><br />
            <b>Status: </b><?=($this->info['status'] == '1' ? 'Aberto' : 'Finalizado')?><br />
            </p>

            <hr />

            <h3>Itens</h3>

            <?php if(count($this->info['itens']) > 0){ ?>
                <?php foreach($this->info['itens'] as $linha){ ?>
                    <p>
                    <b>Produto: </b><?=$linha['nome_produto']?><br />
                    <b>Quantidade: </b><?=$linha['quantidade']?>
                    </p>

                    <hr />
                <?php } ?>
            <?php } ?>

            <br clear="all">
            <br clear="all">

            <center>
                <a href="<?=CONFIG_PATH?>/area-do-cliente/" class="btn btn-lg btn-primary" style="background-color: #BE1622; !important; border:0px; color:#FFFFFF;">Voltar para a listagem</a>
            </center>

            <br clear="all">
        </div>
    </div>
</section>


<script>
$(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
