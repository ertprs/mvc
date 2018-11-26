<section class="section-internas">
    <header class="header-internas">
        <div class="container">
            <h2>Vídeos</h2>
        </div>
    </header>

    <div class="conteudo-internas">
        <div class="container">
            <div id="container-videos-int">
                <?php if(count($this->videos) > 0){ ?>
                    <?php foreach($this->videos as $linha){ ?>
                        <div class="col-md-4 col-sm-6 col-xs-12" data-src="<?=$linha['link']?>" data-sub-html="<h4><?=$linha['titulo']?></h4>" data-poster="<?php echo CONFIG_PATH; ?>/painel/arquivos/videos/<?=$linha['arquivo']?>">
                            <div class="reg-video-main">
                                <a href="javascript:;">
                                    <div class="img" style="background-image:url(<?php echo CONFIG_PATH; ?>/painel/arquivos/videos/<?=$linha['arquivo']?>);">
                                        <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/player.png" alt="Assistir Vídeo">
                                    </div>

                                    <div class="texto">
                                        <h3><?=$linha['titulo']?></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<link href="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/css/lightgallery.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/js/lightgallery.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/js/lg-fullscreen.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/js/lg-thumbnail.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/js/lg-video.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/js/lg-autoplay.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/js/lg-zoom.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/js/lg-hash.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/js/lg-pager.js"></script>
<script src="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/lib/jquery.mousewheel.min.js"></script>


<script>
$(function(){
    $('#container-videos-int').lightGallery();
});
</script>