<section id="internas-parceiros" class="section-internas">
    <header class="header-section-internas">
        <div class="container">
            <h2>Parceiros</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <div class="row">
                <?php if(count($this->registros) > 0){ ?>
                	<?php foreach($this->registros as $linha){ ?>
                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="reg-parceiros">
                                <a href="javascript:;" target="blank" data-toggle="tooltip" data-placement="top" title="<?=utf8_encode($linha['nome'])?>" style="cursor:default;background-image:url(<?php echo CONFIG_PATH_PAINEL; ?>/arquivos/parceiros/<?=$linha['logo']?>);">
                                     <span><?=utf8_encode($linha['nome'])?></span>
                                </a>
                                <span><?=utf8_encode($linha['nome'])?></span>
                            </div>
                        </div>
					<?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>