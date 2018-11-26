<section id="internas-produtos" class="section-internas">
    <header class="header-section-internas">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Produtos</h2>
                </div>

                <div class="col-md-8">
                    <?php if(!empty($this->dados_parceiro)){ ?>
                        <div id="box-parceiro">
                            <div style="background-color:#191919;">
                                <div class="container">
                                    <div id="img-box-parceiro">
                                        <img src="<?php echo CONFIG_PATH_PAINEL; ?>/arquivos/parceiros/<?=$this->dados_parceiro['logo']?>" class="img-responsive" alt="<?=$this->dados_parceiro['nome']?>">
                                    </div>

                                    <div id="dados-box-parceiro">
                                        <strong><?=$this->dados_parceiro['nome']?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <div class="row">
                <?php if(count($this->registros) == 0){ ?>
                    <div class="col-md-12">
                        <p style="font-size:20px;">Nenhum produto encontrado <?php if(!empty($_GET['palavra_chave'])){ ?> pelo termo '<b><?=$_GET['palavra_chave']?></b>'<?php } ?></p>
                    </div>

                <?php }else{ ?>
                    <div class="col-md-3">
                        <p style="font-size:20px;"><b><?=count($this->registros)?></b> produto(s) encontrado(s) <?php if(!empty($_GET['palavra_chave'])){ ?> pelo termo '<b><?=$_GET['palavra_chave']?></b>'<?php } ?></p>
                        <br />

                        <?php if(count($this->categorias) > 0){ ?>
                            <ul class="list-group">
                                <?php foreach($this->categorias as $linha){ ?>
                                    <li class="list-group-item">
                                        <a href="<?php echo CONFIG_PATH; ?>/produtos/?categoria=<?=$linha['id']?>">
                                            <span class="badge pull-right"><?=$linha['num_produtos']?></span>
                                            <?=$linha['nome']?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>

                    <div class="col-md-9">
                    	<?php foreach($this->registros as $linha){ ?>
                    		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <article class="reg-produtos">
                                    <form method='post' action='' class='jcart'>
                                        <input type='hidden' name='jcartToken' value='' />
                                        <input type='hidden' name='my-item-id' value='<?=$linha['id']?>' />
                                        <input type='hidden' name='my-item-name'    value='<?=($linha['nome'])?>' />
                                        <input type='hidden' name='my-item-quality' value='1' />
                                        <input type='hidden' name='my-item-company' value='' />
                                        <input type='hidden' name='my-item-thickness' value='' />
                                        <input type='hidden' name='my-item-block'   value='' />
                                        <input type='hidden' name='my-item-bundle'  value='' />
                                        <input type='hidden' name='my-item-url'     value='javascript:;' />
                                        <input type='hidden' name='my-item-qty'     value='1' />
                                        <input type='hidden' name='my-item-price'   value='<?=number_format($linha['preco'],2,'.',',')?>' />
                                        <input type='hidden' name='my-item-color'   value='1' class="my-item-color-<?=$linha['id']?>" />

                                        <div class="top">
                                            <div class="imagem">
                                                <figure>
                                                    <?php if(!empty($linha['foto'])){ ?>
                                                        <img src="<?php echo CONFIG_PATH_PAINEL; ?>/arquivos/produtos/<?=substr($linha['foto'],0,-4)?>_thumbnail.jpg" class="img-responsive" alt="<?=$linha['nome']?>"/>

                                                    <?php }else{ ?>
                                                        <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/sem-foto.jpg" class="img-responsive" alt=""/>
                                                    <?php } ?>
                                                </figure>
                                            </div>

                                            <div class="botoes">
                                                <a href="<?php echo CONFIG_PATH; ?>/produtos/<?=$linha['id']?>/<?=url_amigavel($linha['nome'])?>" class="btn-ver">
                                                    <div class="box">
                                                        <i class="icon-ver"></i>
                                                    </div>

                                                    <span>Ver</span>
                                                </a>

                                                <button type='submit' name='my-add-button' value='<?=$linha['id']?>' class='adicionar-carrinho add add<?=$linha['id']?> link-cycle btn-adicionar' id='add<?=$linha['id']?>'>
                                                    <div class="box">
                                                        <i class="icon-adicionar"></i>
                                                    </div>

                                                    <span>Adicionar</span>
                                                </button>

                                                <a class='remove jcart-remove2 btn-remover remove<?=$linha['id']?>' id='remove<?=$linha['id']?>' href='?jcartRemove=<?=$linha['id']?>'>
                                                    <div class="box">
                                                        <i class="icon-remover"></i>
                                                    </div>

                                                    <span>Remover</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bottom">
                                            <strong>COD. <?=$linha['id']?></strong>
                                            <h3><?=$linha['nome']?></h3>
                                            <?php if($linha['preco']){ ?>
                                                <span class="preco">
                                                        R$ <?=$linha['preco']?>        
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </article>
                            </div>
    					<?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>