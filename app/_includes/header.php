<!DOCTYPE html>
<html lang=”pt-br”>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=(isset($this->title)) ? $this->title : CONFIG_TITLE; ?></title>
<meta name="description" content="<?php echo (isset($this->SEO['description']) ? $this->SEO['description'] : CONFIG_SEO_DESCRIPTION); ?>">

<meta name="theme-color" content="#BE1622">
<meta name="msapplication-navbutton-color" content="#BE1622">

<!-- FAVICON -->
<link rel="SHORTCUT ICON" href="<?php echo CONFIG_PATH_PUBLIC; ?>/img/favicon.png" />
<link rel="icon" type="image/png" href="<?php echo CONFIG_PATH_PUBLIC; ?>/img/favicon.png" />
<link rel='icon' type='image/x-icon' href='<?php echo CONFIG_PATH_PUBLIC; ?>/img/favicon.png' />

<!-- Metas para o Facebook -->
<meta property="og:type"          content="<?php echo (isset($this->SEO['type'])        ? $this->SEO['type']        : CONFIG_SEO_TYPE); ?>"        />
<meta property="og:title"         content="<?php echo (isset($this->SEO['title'])       ? $this->SEO['title']       : CONFIG_SEO_TITLE); ?>"       />
<meta property="og:url"           content="<?php echo (isset($this->SEO['url'])         ? $this->SEO['url']         : CONFIG_SEO_URL); ?>"         />
<meta property="og:site_name"     content="<?php echo (isset($this->SEO['site_name'])   ? $this->SEO['site_name']   : CONFIG_SEO_SITE_NAME); ?>"   />
<meta property="og:description"   content="<?php echo (isset($this->SEO['description']) ? $this->SEO['description'] : CONFIG_SEO_DESCRIPTION); ?>" />
<meta property="og:image"         content="<?php echo (isset($this->SEO['image'])       ? $this->SEO['image']       : CONFIG_SEO_IMAGE); ?>"       />

<link href="<?php echo CONFIG_PATH_PUBLIC; ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo CONFIG_PATH_PUBLIC; ?>/css/estilo.css" rel="stylesheet">
<link href="<?php echo CONFIG_PATH_PUBLIC; ?>/js/slick/slick.css" rel="stylesheet">
<link href="<?php echo CONFIG_PATH_PUBLIC; ?>/js/sweetalert/dist/sweetalert.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo CONFIG_PATH_PUBLIC; ?>/js/mega-dropdown/css/style.css">
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CONFIG_PATH; ?>/jcart/css/jcart.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo CONFIG_PATH_PUBLIC; ?>/js/slick/slick.min.js"></script>
<script src="<?php echo CONFIG_PATH_PUBLIC; ?>/js/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo CONFIG_PATH_PUBLIC; ?>/js/scripts.js?v=1"></script>
<?php
    if(isset($this->css)){
        foreach($this->css as $css){
            echo '<link href="'.CONFIG_PATH.'/'.$css.'" rel="stylesheet"></link>';
        }
    }
?>

<!-- Facebook Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '585959678428880');
    fbq('track', 'PageView');
</script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=585959678428880&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

</head>

<body>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112740217-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-112740217-1');
</script>



<?php require_once('app/_modal/modal_area_cliente.tpl.php');  ?>
<?php require_once('app/_modal/modal_lembrar_senha.tpl.php'); ?>

<?php if($_GET['secao'] != 'finalizar'){ ?>
    <div id="box-carrinho">
        <div id="header-box-carrinho">
            <strong>Meu Carrinho</strong>
            <a class="close_carrinho" href='javascript:void(0)'>
                <i class="glyphicon glyphicon-remove"></i>
            </a>
        </div>

        <div id="container-jcart">
          <div id="jcart">
            <?php $_SESSION['jcart']->display_cart(); ?>
          </div>
        </div>
    </div>
<?php } ?>

<div class="cd-dropdown-wrapper" style="z-index:9999; height:0px; margin:0px; display: inline;">
    <nav class="cd-dropdown">
        <h2 style="margin-top:0px;">Menu Principal</h2>
        <a href="#0" class="cd-close">Close</a>

        <ul class="cd-dropdown-content">
            <li><a href="<?php echo CONFIG_PATH; ?>/">Página inicial</a></li>
            <li><a href="<?php echo CONFIG_PATH; ?>/a-empresa/">A empresa</a></li>
            <li><a href="<?php echo CONFIG_PATH; ?>/produtos/">Produtos</a></li>
            <li><a href="<?php echo CONFIG_PATH; ?>/novidades/">Novidades</a></li>
            <li><a href="<?php echo CONFIG_PATH; ?>/parceiros/">Parceiros</a></li>
            <li><a href="<?php echo CONFIG_PATH; ?>/trabalhe-conosco/">Trabalhe conosco</a></li>
            <li><a href="<?php echo CONFIG_PATH; ?>/fale-conosco/">Fale conosco</a></li>
        </ul>
    </nav>
</div>
<!-- #### MENU MOBILE #### -->


<div id="header-back"></div>

<header id="header">
    <div id="bg1-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-5 col-xs-6">
                    <h1 id="logo-header">
                        <a href="<?php echo CONFIG_PATH; ?>/">
                            <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/logo-header.png" class="img-responsive" alt="Dal Col Carnes">
                        </a>
                    </h1>
                </div>

                <div class="col-md-9 col-sm-7 col-xs-6">
                    <a href="javascript:;" id="menu-mobile" class="cd-dropdown-trigger hidden-lg hidden-md">
                        <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/menu.png" class="img-responsive" alt="Menu">
                    </a>

                    <a href="<?php echo CONFIG_PATH; ?>/area-do-cliente/" id="user-mobile" class="hidden-lg hidden-md">
                        <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/user.png" class="img-responsive" alt="Menu">
                    </a>

                    <div class="row">
                        <div class="col-md-12 hidden-sm hidden-xs">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php if(empty($_SESSION['cliente'])){ ?>
                                        <div id="box-login">
                                            <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/img-perfil.png" class="img-circle">
                                            <span>Olá, <a href="<?php echo CONFIG_PATH; ?>/login/">faça login</a> ou <a href="<?php echo CONFIG_PATH; ?>/cadastro-cliente/">cadastre-se</a></span>
                                        </div>

                                    <?php }else{ ?>
                                        <div id="logado">
                                            <a href="javascript:;" id="link-menu-cliente" class="hidden-sm hidden-xs">
                                                <div class="img">
                                                    <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/img-perfil.png" class="img-responsive img-circle">
                                                </div>

                                                <div class="dados">
                                                    <span>Bem vindo(a)</span>
                                                    <strong><?php
	                                                    $tmp = explode(' ',$_SESSION['cliente']['nome']);
	                                                    if(!empty($tmp[0])){
		                                                    echo $tmp[0].' '.$tmp[1];
	                                                    }else
	                                                    	echo $_SESSION['cliente']['nome'];
	                                                    ?>
	                                                </strong>
                                                </div>
                                            </a>

                                            <ul id="menu-cliente">
                                                <li><a href="<?php echo CONFIG_PATH; ?>/meus-dados/">Meus dados</a></li>
                                                <li><a href="<?php echo CONFIG_PATH; ?>/area-do-cliente/">Histórico de pedidos</a></li>
                                                <li><a href="<?php echo CONFIG_PATH; ?>/login/logout/">Sair</a></li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="col-md-3">
                                  <!--   <a href="<?php echo CONFIG_PATH; ?>/login/" id="link-acesse-conta">
                                        <span>Acesse a sua conta</span>
                                        <i class="glyphicon glyphicon-play"></i>
                                    </a> -->
                                </div>

                                <div class="col-md-5">
                                    <form method="get" action="<?php echo CONFIG_PATH; ?>/produtos/" id="form-busca-topo">
                                        <input type="hidden" name='busca' value="true">

                                        <div class="form-group">
                                            <input type="search" class="form-control" id="palavra-chave" name="palavra_chave" placeholder="O que procura?">

                                            <button type="submit" id="btn-busca">
                                                <i class="icon-lupa-busca"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <div id="box-carrinho">
                                        <i class="icon-cart"></i>
                                        <strong></strong>
                                        <span>Produtos no carrinho</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-12 hidden-sm hidden-xs">
                            <div id="box-telefone-header">
                               <i class="icon-tel-amarelo"></i>
                               <a href="tel:+552732364080">27 3077-7578</a>
                               <div id="whatsapp" class="pull-right">
                                   <a href="https://api.whatsapp.com/send?phone=5527998677578">
                                       <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/whatsapp.png" height="27">
                                       27 99867-7578
                                   </a>
                               </div>
                           </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="bg2-header" class="hidden-sm hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav id="menu-principal">
                        <ul>
                            <li><a href="<?php echo CONFIG_PATH; ?>/a-empresa/">A empresa</a></li>
                            <li><a href="<?php echo CONFIG_PATH; ?>/produtos/">Produtos</a></li>
                            <li><a href="<?php echo CONFIG_PATH; ?>/novidades/">Novidades</a></li>
                            <li><a href="<?php echo CONFIG_PATH; ?>/parceiros/">Parceiros</a></li>
                            <li><a href="<?php echo CONFIG_PATH; ?>/fale_conosco/">Fale conosco</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-md-4">
                    <a href="javascript:;" onClick="$('.cart-box button').click();" class="btn-cart-header">Meu carrinho</a>

                    <ul id="icones-topo">
                    <li>
                            <a href="https://api.whatsapp.com/send?phone=5527998677578" target="blank" id="link-chat">
                                <span>Whatsapp</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/dalcolcarnes/" target="blank" id="link-facebook">
                                <span>Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
function header_fixo(){
    var scroll = $(window).scrollTop();
    var altura_header = $('#header').height();

    if(scroll > $('#header').height()){
        $('#header').addClass('fixed');
        altura_header += 20;

    }else{
        altura_header += 40;
        $('#header').removeClass('fixed');
    }
}

$(function(){
    header_fixo();

    $(window).scroll(function(){
        header_fixo();
    });
});
</script>




