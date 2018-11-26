<section class="section-internas">
    <header class="header-section-internas">
        <div class="container">
            <h2>Novidades</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <div class="row">
                <?php if(count($this->registros) > 0){ ?>
                	<?php foreach($this->registros as $linha){ ?>
                		<div class="col-md-4 col-sm-12 reg-animation">
                            <article class="reg-noticias">
                                <a href="<?php echo CONFIG_PATH; ?>/novidades/<?=$linha['id']?>/<?=url_amigavel(($linha['titulo']))?>">
                                    <div class="data-reg-noticias"><?=converte_data($linha['data'])?></div>

                                    <?php if(!empty($linha['arquivo'])){ ?>
                                        <img src="<?php echo CONFIG_PATH; ?>/painel/arquivos/noticias/<?=$linha['arquivo']?>" class="img-responsive" alt="<?=($linha['titulo'])?>"/>

                                    <?php }else{ ?>
                                        <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/sem-foto.jpg" class="img-responsive" alt=""/>
                                    <?php } ?>


                                    <div class="dados">
                                        <h3><?=($linha['titulo'])?></h3>
                                        <p>
                                        <?php
                                        if(!empty($linha['subtitulo'])){
                                            echo ($linha['subtitulo']);

                                        }else{
                                            echo substr(strip_tags(($linha['texto'])),0,200);
                                        }
                                        ?>
                                        </p>
                                    </div>

                                    <div class="btn-leia-mais text-center">Leia mais +</div>
                                </a>
                            </article>
                        </div>
					<?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>