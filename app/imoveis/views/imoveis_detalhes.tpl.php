<section id="section-detalhes-imovel">
    <div id="box-banner-imovel" style="background-image:url(<?=CONFIG_PATH?>/painel/arquivos/empreendimentos/<?=$this->info['banner']?>);"></div>

    <div id="box-titulo-imovel">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div id="info-titulo">
                        <span><?=$this->info['cidade_nome']?> / <?=$this->info['estado_sigla']?></span>
                        <strong><?=$this->info['bairro_nome']?></strong>
                        <h2><?=$this->info['nome']?></h2>
                    </div>
                </div>

                <div class="col-md-3">
                    <div id="envolve-topicos">
                    	<?php if($this->info['empreendimento_tipo_id'] == 1){ ?>
	                    	<div class="icon-detalhes-imovel">
	                            <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/qtos-branco.png" alt="Quartos">
	                            <span><?=$this->info['salas']?></span>
	                        </div>

	                    <?php }else{ ?>
	                    	<div class="icon-detalhes-imovel">
	                            <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/qtos-branco.png" alt="Quartos">
	                            <span><?=$this->info['qtos']?></span>
	                        </div>
	                    <?php } ?>

                        <div class="icon-detalhes-imovel">
                            <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/metragem-branco.png" alt="Tamanho">
                            <span><?=$this->info['tamanho']?></span>
                        </div>

                        <div class="icon-detalhes-imovel">
                            <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/vagas-branco.png" alt="Vagas de garagem">
                            <span><?=$this->info['vagas']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="box-menu-imovel">
        <div class="container">
            <div class="row">
                <div class="col-md-8 hidden-sm hidden-xs">
                    <ul id="menu-imovel">
                        <li><a href="#box-visao-geral-imovel" class="btn-easing">Visão Geral</a></li>

                        <?php if(!empty($this->info['detalhes'])){ ?>
                            <li><a href="#box-detalhes-imovel" class="btn-easing">Detalhes</a></li>
                        <?php } ?>

                        <?php if(!empty($this->info['video'])){ ?>
                            <li><a href="#ox-video-imovel" class="btn-easing">Galeria</a></li>
                        <?php }elseif(!empty($this->info['fotos'])){ ?>
                            <li><a href="#ox-fotos-imovel" class="btn-easing">Galeria</a></li>
                        <?php } ?>

                        <li><a href="#box-localizacao-imovel" class="btn-easing">Localização</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <div id="box-valor">
                        <!--<strong><small>R$</small>450.000<small>,00</small></strong>-->
                    	<?php if($this->info['vendas'] == 1){ ?>
                            <span><?=$this->info['valor_label']?></span>
							<strong><small>R$</small><?=number_format($this->info['valor'], 2, ',', '.')?></strong>

                        <?php }else{ ?>
                            <span>100%</span>
                            <strong>Vendido</strong>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="box-visao-geral-imovel">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>Visão Geral</h3>
                    <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/visao-geral.png" alt="">

                    <div class="texto">
                        <?=$this->info['descricao']?>

                        <br clear="all">

                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div id="box-canais-venda-imovel">
                        <span>VOCÊ SE INTERESSOU PELO IMÓVEL?</span>

                        <div class="link">
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_atendimento_online" onClick="corretor_online('<?=$_SESSION['id_imovel']?>','<?=$_SESSION['sigla_estado']?>');">
                                <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/atendimento.png" alt="Atendimento Online">
                                <div>
                                    <span>Atendimento</span>
                                    <strong>Online</strong>
                                </div>
                            </a>
                        </div>

                        <div class="link">
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_atendimento_email">
                                <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/email.png" alt="Atendimento por email">
                                <div>
                                    <span>Atendimento</span>
                                    <strong>Por E-mail</strong>
                                </div>
                            </a>
                        </div>

                        <div class="link">
                            <a href="tel:+55<?=$this->configuracoes['telefone2']?>">
                                <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/telefone.png" alt="Ligue agora">
                                <div>
                                    <span>Ligue agora</span>
                                    <strong><?=$this->configuracoes['telefone']?></strong>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(!empty($this->info['detalhes'])){ ?>
	    <div id="box-detalhes-imovel" class="box-conteudo-imovel">
	        <div class="header-box-conteudo-imovel">
	            <div class="container">
	                <h3>Detalhes do imóvel</h3>
	            </div>
	        </div>

	        <div class="conteudo-box-conteudo-imovel">
	            <?php if(!empty($this->info['banner_detalhes'])){ ?>
                    <div class="col-md-6">
    	                <div class="row">
    	                    <div id="box-banner-detalhes-imovel" style="background-image:url(<?=CONFIG_PATH?>/painel/arquivos/empreendimentos/<?=$this->info['banner_detalhes']?>);"></div>
    	                </div>
    	            </div>

    	            <div class="col-md-4">
    	                <div class="row">
    	                    <div id="texto-box-detalhes-imovel">
    	                        <?=$this->info['detalhes']?>

    	                        <a href="javascript:;" id="btn-memorial-descritivo">
    	                            <span>Memorial descritivo</span>
    	                            <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/icon-pdf.png">
    	                        </a>
    	                    </div>
    	                </div>
    	            </div>

                <?php }else{ ?>
                    <div class="container">
                        <div id="texto-box-detalhes-imovel" style="padding-left:0px;">
                            <?=$this->info['detalhes']?>

                            <a href="javascript:;" id="btn-memorial-descritivo">
                                <span>Memorial descritivo</span>
                                <img src="<?=CONFIG_PATH_PUBLIC?>/img/icons/icon-pdf.png">
                            </a>
                        </div>
                    </div>
                <?php } ?>
	        </div>
	    </div>
	<?php } ?>


	<?php if(!empty($this->info['video'])){ ?>
	    <div id="box-video-imovel" class="box-conteudo-imovel">
	        <div class="header-box-conteudo-imovel">
	            <div class="container">
	                <h3>Vídeo</h3>
	            </div>
	        </div>

	        <div class="conteudo-box-conteudo-imovel">
	            <div class="container">
	                <div id="conteudo-video">
	                    <div class="embed-responsive embed-responsive-16by9">
	                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=end(explode('v=',$this->info['video']))?>?rel=0&amp;controls=0&amp;"></iframe>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	<?php } ?>

	<?php if(!empty($this->fotos)){ ?>
	    <div id="box-fotos-imovel" class="box-conteudo-imovel">
	        <div class="header-box-conteudo-imovel">
	            <div class="container">
	                <h3>Fotos</h3>
	            </div>
	        </div>

	        <div class="conteudo-box-conteudo-imovel">
	            <div class="container">
	                <div class="row">
	                    <div id="galeria-fotos">
	                        <?php foreach($this->fotos as $linha){ ?>
	                            <div class="col-md-3 col-sm-4 col-xs-6" data-src="<?=CONFIG_PATH?>/painel/arquivos/empreendimentos_fotos/<?=$this->info['id']?>/<?=$linha['imagem']?>" data-sub-html="<h4><?=$linha['legenda']?></h4>">
	                                <a href="javascript:;" class="reg-fotos">
	                                    <img src="<?=CONFIG_PATH?>/painel/arquivos/empreendimentos_fotos/<?=$this->info['id']?>/<?=substr($linha['imagem'],0,-4)?>_thumbnail.jpg" class="img-responsive" alt="<?=$linha['legenda']?>">
	                                </a>
	                            </div>
	                        <?php } ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    <?php } ?>


    <?php if(!empty($this->plantas)){ ?>
	    <div class="box-conteudo-imovel">
	        <div class="header-box-conteudo-imovel">
	            <div class="container">
	                <h3>Plantas</h3>
	            </div>
	        </div>

	        <div class="conteudo-box-conteudo-imovel">
	            <div class="container">
	                <div class="row">
	                    <div id="galeria-plantas">
	                        <?php foreach($this->plantas as $linha){ ?>
	                            <div class="col-md-3 col-sm-4 col-xs-6" data-src="<?=CONFIG_PATH?>/painel/arquivos/empreendimentos_fotos/<?=$this->info['id']?>/<?=$linha['imagem']?>" data-sub-html="<h4><?=$linha['legenda']?></h4>">
                                    <a href="javascript:;" class="reg-fotos">
                                        <img src="<?=CONFIG_PATH?>/painel/arquivos/empreendimentos_fotos/<?=$this->info['id']?>/<?=substr($linha['imagem'],0,-4)?>_thumbnail.jpg" class="img-responsive" alt="<?=$linha['legenda']?>">
	                                </a>
	                            </div>
	                        <?php } ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    <?php } ?>


    <div id="box-localizacao-imovel" class="box-conteudo-imovel">
        <div class="header-box-conteudo-imovel">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h3>Localização</h3>
                    </div>

                    <div class="col-md-7">
                        <address><?=$this->info['endereco']?>, <?=$this->info['bairro_nome']?> - <?=$this->info['cidade_nome']?> - <?=$this->info['estado_sigla']?></address>
                    </div>
                </div>
            </div>
        </div>

        <?php if(!empty($this->info['latitude']) && !empty($this->info['longitude'])){ ?>
	        <div class="conteudo-box-conteudo-imovel">
                <div class='content-container embed-container maps mapa' data-color="">
                    <div id="map" class="mapa" data-modo="maps" data-endereco='<?=$this->info['endereco']?>, <?=$this->info['bairro_nome']?> - <?=$this->info['cidade_nome']?> - <?=$this->info['estado_sigla']?>' data-latitude="<?=$this->info['latitude']?>" data-longitude="<?=$this->info['longitude']?>"></div>
                </div>
	        </div>
	    <?php } ?>
    </div>
</section>

<link href="<?=CONFIG_PATH_PUBLIC?>/js/lightGallery/dist/css/lightgallery.css" rel="stylesheet">

<script type="text/javascript" src="<?=CONFIG_PATH_PUBLIC?>/js/mapa_detalhes.js"></script>
<script type="text/javascript">
$(function(){
    if($(window).innerWidth() > 992){
        var altura_tela = $(window).innerHeight();
        var altura_banner = (altura_tela - $('#footer-fixed').height());

        if(altura_banner > 700){
            altura_banner = 700;
        }

        $('#box-banner-imovel').css('height',altura_banner);
    }

    $('#galeria-fotos, #galeria-plantas').lightGallery({
        thumbnail:true
    });

    if($(window).innerWidth() > 992){
        $('#box-canais-venda-imovel').css('height',($('#box-visao-geral-imovel').height() + 50));
    }
});
</script>

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

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59ef428a46c44eeb"></script>


