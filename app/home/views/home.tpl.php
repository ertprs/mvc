<?php if(count($this->BannersPrincipais) > 0){ ?>
    <section class="section-main" id="section-banner-principal">
        <div id="control-banner-principal" class="hidden-xs">
            <a href="javascript:;" class="seta-voltar" onClick="$('#banner-principal .slick-prev').click();">Voltar</a>
            <a href="javascript:;" class="seta-avancar" onClick="$('#banner-principal .slick-next').click();">Avançar</a>
        </div>

        <div id="banner-principal">
            <?php foreach($this->BannersPrincipais as $linha){ ?>
                <a class="reg-banner-principal" href="<?=$linha['link']?>" <?php if($linha['nova_janela'] == 1){ ?> target="blank"<?php } ?> style="background-image:url(<?php echo CONFIG_PATH; ?>/painel/arquivos/banners_principais/<?=$linha['arquivo']?>);"></a>
            <?php } ?>
        </div>
    </section>
<?php } ?>

<?php if(count($this->Parceiros) > 0){ ?>
    <section class="section-main" id="section-marcas">
        <div class="container">
            <h2 class="hidden-sm">Parceiros</h2>

            <div id="slick-marcas">
                <?php foreach($this->Parceiros as $linha){ ?>
                    <div class="reg-marcas">
                        <a href="<?php echo CONFIG_PATH; ?>/produtos/<?=$linha['link']?>/" target="blank" style="background-image:url(<?php echo CONFIG_PATH_PAINEL; ?>/arquivos/parceiros/<?=$linha['logo']?>);"></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php if(count($this->Produtos) > 0){ ?>
    <section class="section-main" id="section-produtos-destaque">
        <div id="header-section-produtos-destaque">
            <div class="container">
                <h2>Produtos destaque</h2>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div id="slick-produtos-destaque">
                    <?php foreach($this->Produtos as $linha){ ?>
                        <div class="col-md-3">
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
        </div>
    </section>
<?php } ?>



<section class="section-main" id="section-canais-atendimento">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
               <div id="box-telefones">
                 <span>Compre por telefone</span>
                 <div class="col-md-5 center-block">
                     <a href="#">27 3077-7578</a>
                     <span>/</span>
                     <a href="#">27 99867-7578</a>
                 </div>
                 <div class="pull-right">
                     <span >Seg. a Sex. 6h às 15h | Sáb. 06h às 11h</span>
                 </div>
             </div>
         </div>
     </div>
 </div>
</section>



<script>
$(function(){
    $('#banner-principal').slick({
        infinite: true
    });

    $('#slick-produtos-destaque').slick({
        dots: true,
        infinite: true,
        speed: 300,
        arrows:true,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },{
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('#slick-lancamentos').slick({
        infinite: true
    });

    $('#slick-marcas').slick({
        dots: true,
        infinite: true,
        speed: 300,
        arrows:true,
        slidesToShow: 9,
        slidesToScroll: 9,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 7,
                    slidesToScroll: 7
                }

            },{
                breakpoint: 992,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5
                }

            },{
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
        ]
    });

    setTimeout(function(){
        $('.reg-produtos').each(function(a,b){
            var figure = $(b).find('figure');
            var img = figure.find('img');

            // console.log(img.height());

            img.css('margin-top',((figure.height() - img.height()) / 2));
        });
    },500);


    setTimeout(function(){
        $('.reg-produtos').each(function(a,b){
            var figure = $(b).find('figure');
            var img = figure.find('img');

            // console.log(img.height());

            img.css('margin-top',((figure.height() - img.height()) / 2));
        });
    },1500);
});
</script>

<style type="text/css">
    .reg-produtos {
        box-shadow: none !important;
        outline: none !important;
    }
</style>