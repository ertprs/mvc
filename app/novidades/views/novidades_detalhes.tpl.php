
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5651be1b861ab092" async="async"></script>

<section class="section-internas">
    <header class="header-section-internas">
        <div class="container">
            <h2>Novidades</h2>
        </div>
    </header>

    <div id="section-noticias-detalhes" class="conteudo-section-internas">
        <div class="container">
            <header>
                <strong><?=converte_data($this->info['data'])?></strong>
                <h2><?=($this->info['titulo'])?></h2>
                <?php if(!empty($this->info['subtitulo'])){ ?>
					<p><?=($this->info['subtitulo'])?></p>
				<?php } ?>
			</header>

            <div id="conteudo-noticias">
				<?php if(!empty($this->info['arquivo'])){ ?>
					<figure id="imagem-post">
						<img src="<?=CONFIG_PATH?>/painel/arquivos/noticias/<?=$this->info['arquivo']?>" class="img-responsive" alt="<?=($this->info['titulo'])?>">
					</figure>
				<?php } ?>

                <?=$this->info['texto']?>
            </div>
        </div>
    </div>
</section>

<?php if(count($this->outras_noticias) > 0){ ?>
    <section id="section-outros-empreendimentos">
        <div class="container">
            <header>
                <h3 class="text-center">Outras novidades</h3>
            </header>

            <div class="row">
                <?php foreach($this->outras_noticias as $linha){ ?>
                    <div class="col-md-4 col-sm-12 reg-animation">
                        <article class="reg-noticias">
                            <a href="<?=CONFIG_PATH?>/novidades/<?=$linha['id']?>/<?=url_amigavel(($linha['titulo']))?>">
                                <div class="data-reg-noticias"><?=converte_data($linha['data'])?></div>

                                <?php if(!empty($linha['arquivo'])){ ?>
                                    <img src="<?php echo CONFIG_PATH; ?>/painel/arquivos/noticias/<?=$linha['arquivo']?>" class="img-responsive" alt="<?=$linha['titulo']?>"/>

                                <?php }else{ ?>
                                    <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/sem-foto.jpg" class="img-responsive" alt=""/>
                                <?php } ?>

                                <div class="dados">
                                    <h3><?=($linha['titulo'])?></h3>
                                    <p><?=substr(strip_tags(($this->info['texto'])),0,150)?>...</p>
                                </div>

                                <div class="btn-leia-mais text-center">Leia mais +</div>
                            </a>
                        </article>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>


<link href="assets/js/lightgallery/css/lightgallery.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="assets/js/lightgallery/js/lightgallery.js"></script>
<script src="assets/js/lightgallery/js/lg-fullscreen.js"></script>
<script src="assets/js/lightgallery/js/lg-thumbnail.js"></script>
<script src="assets/js/lightgallery/js/lg-video.js"></script>
<script src="assets/js/lightgallery/js/lg-autoplay.js"></script>
<script src="assets/js/lightgallery/js/lg-zoom.js"></script>
<script src="assets/js/lightgallery/js/lg-hash.js"></script>
<script src="assets/js/lightgallery/js/lg-pager.js"></script>
<script src="assets/js/lightgallery/js/jquery.mousewheel.min.js"></script>

<!--lightGallery-->
<script type="text/javascript">
    $(document).ready(function() {
        $("#lightgallery").lightGallery();
    });
</script>

