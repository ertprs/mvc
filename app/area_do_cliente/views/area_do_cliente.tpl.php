<section class="section-internas" id="internas-area-cliente">
    <header class="header-section-internas">
        <div class="container">
            <h2>Área do cliente</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <header>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Olá, <?=$_SESSION['cliente']['nome']?>!</h2>
                    </div>

                    <div class="col-md-6">
                        <ul>
                            <li>
                                <a href="<?=CONFIG_PATH?>/finalizar/" data-toggle="tooltip" data-placement="top" title="Finalizar compra">
                                    <img src="<?=CONFIG_PATH_PUBLIC?>/img/icon-carrinho.png" alt="Carrinho">
                                </a>
                            </li>

                            <li>
                                <a href="<?=CONFIG_PATH?>/meus-dados/" data-toggle="tooltip" data-placement="top" title="Meus dados">
                                    <img src="<?=CONFIG_PATH_PUBLIC?>/img/icon-meus-dados.png" alt="Meus dados">
                                </a>
                            </li>

                            <li>
                                <a href="<?=CONFIG_PATH?>/area-do-cliente/" data-toggle="tooltip" data-placement="top" title="Histórico de compras">
                                    <img src="<?=CONFIG_PATH_PUBLIC?>/img/icon-historico.png" alt="Histórico">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
        </div>

        <div class="bg-branco">
            <div class="container wi1200">
                <div id="info-carrinho">
                    <div class="icon">
                        <img src="<?=CONFIG_PATH_PUBLIC?>/img/icon-carrinho-lg.png" class="img-responsive" alt="Carrinho">
                    </div>

                    <div class="dados">
                        <strong>Você tem <b><i class="glyphicon glyphicon-time"></i></b> produtos no carrinho</strong>
                        <span>Finalize sua compra <a href="<?=CONFIG_PATH?>/finalizar/">clicando aqui</a>.</span>
                    </div>
                </div>

                <div id="box-historicos">
                    <h3>Histórico de pedidos</h3>
                    <p>Estes são seus pedidos, para informações completas, clique no número do pedido.</p>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Pedido</td>
                                <td>Data</td>
                                <td>Situação</td>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(count($this->orcamentos) > 0){ ?>
                                <?php foreach($this->orcamentos as $linha){ ?>
                                    <tr class="<?=$linha['status']?>">
                                        <td scope="row"><?=$linha['id']?></td>
                                        <td><?=date("d/m/Y H:i:s", strtotime($linha['data']));?></td>
                                        <td><?=($linha['status'] == '1' ? 'Aberto' : 'Finalizado')?></td>
                                        <td>
                                            <a href="<?=CONFIG_PATH?>/area-do-cliente/detalhes/<?=$linha['id']?>/" style="font-size:22px; color:#000;">
                                                <i class="glyphicon glyphicon-plus-sign"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            <?php }else{ ?>
                                <tr class="pendente">
                                    <td colspan="3">Nenhum pedido encontrado!</td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
$(function(){
    $('[data-toggle="tooltip"]').tooltip()
});
</script>
