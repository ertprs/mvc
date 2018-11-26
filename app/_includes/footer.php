<footer id="footer">
    <div id="bg-news">
        <div class="container">
            <strong>Cadastre-se e receba ofertas exclusivas</strong>

            <form id="form-news" method="post" action="<?php echo CONFIG_PATH; ?>/">
                <input type="text" name="nome_news" id="nome-news" placeholder="Digite seu nome" required>
                <input type="email" name="email_news" id="email-news" placeholder="Digite seu email" required>

                <button type="submit" id="btn-news">Enviar</button>
            </form>
        </div>
    </div>

    <?php if($_GET['secao'] != 'fale_conosco'){ ?>
        <div id="bg-localizacao">
            <div id="header-localizacao">
                <div class="container">
                    <strong>Localização</strong>
                </div>
            </div>

            <div id="mapa"></div>

         <!--    <div id="footer-localizacao" class="hidden-xs">
                <div class="container">
                    <a href="javascript:;" class="active link-localizacao" rel="0">Rua Carlos Gomes, 77, Cristóvão Colombo - Vila Velha/ES - CEP: 29.106-370</a>
                </div>
            </div> -->
        </div>
    <?php } ?>

    <div id="bg-branco-footer" class="hidden-sm hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="<?php echo CONFIG_PATH; ?>/" id="logo-footer">
                        <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/logo-header.png" class="img-responsive" alt="Dal Col Carnes">
                    </a>
                </div>

                <div class="col-md-8">
                    <!--
<ul id="menu-footer">
                        <li><a href="<?php echo CONFIG_PATH; ?>/a-empresa/">A empresa</a></li>
                        <li><a href="<?php echo CONFIG_PATH; ?>/produtos/">Produtos</a></li>
                        <li><a href="<?php echo CONFIG_PATH; ?>/novidades/">Novidades</a></li>
                        <li><a href="<?php echo CONFIG_PATH; ?>/parceiros/">Parceiros</a></li>
                        <li><a href="<?php echo CONFIG_PATH; ?>/trabalhe_conosco/">Trabalhe conosco</a></li>
                        <li><a href="<?php echo CONFIG_PATH; ?>/fale_conosco/">Fale conosco</a></li>
                    </ul>
-->

                    <div id="endereco-footer">
                        <div class="row">
							<div class="col-md-7"></div>
                            <div class="col-md-5">
                                <p>
                                    <strong>Cristóvão Colombo</strong><br />
                                    Rua Carlos Gomes, 77<br />
                                    Cristóvão Colombo, Vila Velha - 29106-370<br />
                                    <span>(27) 3077-7578</span> / <span>(27) 99867-7578</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="bg-cinza-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div id="copyright">Copyright 2018 &copy; Todos os direitos reservados - Dal Col Carnes</div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <a href="http://www.rdweb.com.br/" target="blank" id="link-rd">
                        <span>Desenvolvimento</span>
                        <i class="icon-logo-rd">RDWEB</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php if($_GET['secao'] != "finalizar" && $_GET['secao'] != "finalizar_ok"){ ?>
    <div class="cart-box" id="Normal">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <button href="#" class="draggable dropdown-toggle btn btn-primary btn-circle btn-xl" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span></button>
                <span  class="cart-items-count"><span class=" notification-counter"></span></span>
            </li>
        </ul>
    </div>
<?php } ?>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="<?php echo CONFIG_PATH; ?>/jcart/js/jcart.js" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADWaNBS1i49hKzTO2ceP8WMLw1kzK9X4Y"></script>
<script src="<?php echo CONFIG_PATH_PUBLIC; ?>/js/mega-dropdown/js/jquery.menu-aim.js"></script>
<script src="<?php echo CONFIG_PATH_PUBLIC; ?>/js/mega-dropdown/js/main.js"></script>
<script src="<?php echo CONFIG_PATH_PUBLIC; ?>/js/jquery.maskedinput.min.js"></script>

<?php
if(isset($this->js)){
    foreach($this->js as $js){
        echo '<script src="'.CONFIG_PATH.'/'.$js.'"></script>';
    }
}

if(!empty($this->notificacao)){
    require_once('app/_includes/notificacao.php');
}

?>

<script>
$('#footer-localizacao a').click(function(){
    $('#footer-localizacao a').removeClass('active');
    $(this).addClass('active');
});
</script>

<script type="text/javascript">
var map;
var marcadores = new Array();
var markers = new Array();
var marcadoresAtivos = [];
var info = [];
var curr_infw;
var image_main = '<?php echo CONFIG_PATH_PUBLIC; ?>/img/pin.png';

marcadores[0]  = new Array(-20.342335, -40.300265, '<h2 style="margin-top:0;">Rua Carlos Gomes, 77, Cristóvão Colombo - Vila Velha/ES - CEP: 29.106-370</p>', image_main);


if(typeof(Number.prototype.toRad) === "undefined"){
    Number.prototype.toRad = function(){
        return this * Math.PI / 180;
    }
}

function initialize() {
    if($(window).innerWidth() > 768){
        var zoom = 15;

    }else{
        var zoom = 15;
    }

    geocoder = new google.maps.Geocoder();

    var myOptions = {
        zoom: zoom,
        animation: google.maps.Animation.DROP,
        center: new google.maps.LatLng(-20.342335, -40.300265, zoom)
    };

    map = new google.maps.Map(document.getElementById('mapa'), myOptions);

    google.maps.event.addListener(map, 'center_changed', function() {
        var location = map.getCenter();
    });

    aplicaRaio(1);
}






google.maps.event.addDomListener(window, 'load', initialize);

function createMarker(point, title, content, map, image){
    var marker = new google.maps.Marker({
        position: point,
        map: map,
        title: title,
        icon: image
    });

    var infowindow = new google.maps.InfoWindow({content: content});

    // if(ativo == 1){
    //     if(curr_infw) { curr_infw.close();}
    //     curr_infw = infowindow;
    //     infowindow.open(map, marker);
    // }

    google.maps.event.addListener(marker, 'click', function() {
        if(curr_infw) { curr_infw.close();}
        curr_infw = infowindow;
        infowindow.open(map, marker);
    });
    markers.push(marker);
    return marker;
};

function getPosAtual(){
    navigator.geolocation.getCurrentPosition(function(position){
        var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

        var marker = new google.maps.Marker({
            position: pos,
            map: map,
            icon: image
        });

        map.setCenter(pos);
    });
}

function aplicaRaio(raio){
    if(marcadoresAtivos){
        marcadoresAtivos.length = 0;
    }

    var count, i, calcLat, calcLon, mediaLat, mediaLon;
    count =  marcadores.length-1;
    i=0;
    j=0;
    calcLat = 0;
    calcLon = 0;

    var location = map.getCenter();
    var latIni = location.lat();
    var lngIni = location.lng();

    for(i; i <= count; i++){
        var point = new google.maps.LatLng(marcadores[i][0], marcadores[i][1]);
        var title = marcadores[i][3];
        var content = marcadores[i][2];
        var imagem = marcadores[i][3];
        calcLat += marcadores[i][0];
        calcLon += marcadores[i][1];

        marcadoresAtivos[j] = createMarker(point, title, content, map, imagem);
        j++;
    }
}

function getCenter(){
    map.getCenter();
}

</script>






<!-- SCRIPT DO CARRINHO MOBILE -->
<script>
  // SCRIPT DO CARRINHO DESKTOP
  $(function(){
    $('.remove, .jcart-remove').on('click',function(){
        var clss = $(this).hasClass('jcart-remove');//verifica se a class jcart-remove existe no link
        if(clss){
            var id = $(this).attr('href').split('?jcartRemove=');
            var id = id[1];
        }else{
            var id = $(this).attr('id').substr(6);
        }

        $('.add'+id).addClass('fade').css('opacity','1').show();
        $('.remove'+id).removeClass('fade').hide();
        $('.added_'+id).hide();
    });

    $('.add').on('click',function(){
        var id = $(this).attr('id').substr(3);
        $('.add'+id).removeClass('fade').hide();
        $('.remove'+id).addClass('fade').css('opacity','1').show();
        $('.added_'+id).show();
    });

    <?php if(!empty($_SESSION['content_jcart'])){ ?>
        <?php foreach($_SESSION['content_jcart'] as $c) { ?>
            $('.add'+<?=$c['id']?>).removeClass('fade').hide();
            $('.remove'+<?=$c['id']?>).addClass('fade').css('opacity','1').show();
            $('.added_'+<?=$c['id']?>).show();
        <?php } ?>
    <?php } ?>

    $('.cart-box button').click(function(){
        $('.cart-box').css('bottom','-100%');

        if($(window).innerWidth() > 767){
            $('#box-carrinho').css('bottom','20px');

        }else{
            $('#box-carrinho').css('bottom','0px');
        }
    });

    $('.close_carrinho').click(function(){
        $('.cart-box').css('bottom','40px');
        $('#box-carrinho').css('bottom','-100%');
    });
});

$(function(){
  setTimeout(function(){
    $('.cart-box').css('bottom','38px');

    $('.notification-counter').html($('#count-cart').html());

    if($('#info-carrinho')){
        $('#info-carrinho .dados strong b').html($('#count-cart').html());
    }
  },1000);

  $(".link-localizacao").click(function(){
        var posicao = parseInt($(this).attr('rel'));

        var ativo = marcadores[posicao];

        var point = new google.maps.LatLng(ativo[0], ativo[1]);
        createMarker(point, 'title', ativo[2], image_main);
        map.setCenter(point);
        map.setZoom(18);
    });

  $("input.telefone")
      .mask("(99) 9999-9999?9")
      .focusout(function (event) {
          var target, phone, element;
          target = (event.currentTarget) ? event.currentTarget : event.srcElement;
          phone = target.value.replace(/\D/g, '');
          element = $(target);
          element.unmask();
          if(phone.length > 10) {
              element.mask("(99) 99999-999?9");
          } else {
              element.mask("(99) 9999-9999?9");
          }
      });
})
</script>

<script>
    (function(w,d,t,u,n,a,m){w['MauticTrackingObject']=n;
        w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),
        m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://dalcol.rdmail.com.br/mtc.js','mt');

    mt('send', 'pageview');
</script>
  
</body>
</html>