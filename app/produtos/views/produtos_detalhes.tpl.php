
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5651be1b861ab092" async="async"></script>

<section class="section-internas">
    <div id="section-produtos-detalhes" class="conteudo-section-internas" style="min-height:auto;">
        <div class="container">
            <div class="row">
                <form method='post' action='' class='jcart'>
                    <input type='hidden' name='jcartToken' value='' />
                    <input type='hidden' name='my-item-id' value='<?=$this->info['id']?>' />
                    <input type='hidden' name='my-item-name' value='<?=($this->info['nome'])?>' />
                    <input type='hidden' name='my-item-quality' value='1' />
                    <input type='hidden' name='my-item-company' value='' />
                    <input type='hidden' name='my-item-thickness' value='' />
                    <input type='hidden' name='my-item-block' value='' />
                    <input type='hidden' name='my-item-bundle' value='' />
                    <input type='hidden' name='my-item-url' value='javascript:;' />
                    <input type='hidden' name='my-item-price' value='<?=number_format($this->info['preco'],2,'.',',')?>' />
                    <input type='hidden' name='my-item-color' value='1' class="my-item-color-<?=$this->info['id']?>" />

                    <div class="col-md-3 col-sm-4">
                        <?php if(!empty($this->info['foto'])){ ?>
                            <img src="<?php echo CONFIG_PATH_PAINEL; ?>/arquivos/produtos/<?=substr($this->info['foto'],0,-4)?>_thumbnail.jpg" class="img-responsive" alt="<?=$linha['nome']?>"/>
                        <?php } ?>
                    </div>

                    <div class="col-md-6 col-sm-8">
                        <strong id="codigo">COD. <?=$this->info['id']?></strong>

                        <h2><?php echo $this->info['nome']?></h2>

                        <p>
                        <strong>Categoria:  </strong> <?php echo $this->info['categoria_nome']?><br />
                        <strong>Parceiro:   </strong> <?php echo $this->info['parceiro_nome']?><br />
                        <strong>Preço:      </strong> <span style="font-size:18px;">R$ <?php echo $this->info['preco']?></span> reais
                        </p>

                        <br clear="all">

                        <div id="descricao">
                            <?php if(!empty($this->info['descricao'])){ ?>
                                <?=$this->info['descricao']?>
                            <?php }else{ ?>
                                <i>Nenhuma descrição adicionada.</i>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div id="botoes">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-7" style="padding-top:7px;">Informe a quantidade</label>
                                    <div class="col-md-5">
                                        <input type='text' class="form-control" name='my-item-qty' value='1' placeholder="* Seu nome" required />
                                    </div>
                                </div>
                            </div>

                            <button type='submit' name='my-add-button' value='<?=$this->info['id']?>' class='btn adicionar-carrinho add add<?=$this->info['id']?> link-cycle btn-adicionar' id='add<?=$this->info['id']?>'>
                                Adicionar
                            </button>

                            <a class='btn remove jcart-remove2 btn-remover remove<?=$this->info['id']?>' id='remove<?=$this->info['id']?>' href='?jcartRemove=<?=$this->info['id']?>' style='display:none;'>
                                Remover
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php if(count($this->outros_produtos) > 0){ ?>
    <section id="section-outros-empreendimentos" style="padding-top:0px;">
        <div class="container">
            <header>
                <h3 class="text-center">Outras Produtos</h3>
            </header>

            <div class="row">
                <?php foreach($this->outros_produtos as $key=>$linha){ ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 <?php if($key == 2){ ?>hidden-sm<?php } ?>">
                        <article class="reg-produtos">
                            <form method='post' action='' class='jcart'>
                                <input type='hidden' name='jcartToken' value='' />
                                <input type='hidden' name='my-item-id' value='<?=$linha['id']?>' />
                                <input type='hidden' name='my-item-name' value='<?=($linha['nome'])?>' />
                                <input type='hidden' name='my-item-quality' value='1' />
                                <input type='hidden' name='my-item-company' value='' />
                                <input type='hidden' name='my-item-thickness' value='' />
                                <input type='hidden' name='my-item-block' value='' />
                                <input type='hidden' name='my-item-bundle' value='' />
                                <input type='hidden' name='my-item-url' value='javascript:;' />
                                <input type='hidden' name='my-item-qty' value='1' />
                                <input type='hidden' name='my-item-price' value='<?=number_format($linha['preco'],2,'.',',')?>' />
                                <input type='hidden' name='my-item-color' value='1' class="my-item-color-<?=$linha['id']?>" />

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
        </div>
    </section>
<?php } ?>

