<?php
include "funcoes_busca_avancada.php";
include "json_opcoes.php";
?>

<div class="box-busca-imoveis">
	<form id="form-busca-avanca" method="post" action="<?php echo CONFIG_PATH; ?>/imoveis/">
		<a href="javascript:;" onClick="exibeBuscaAvancada();" id="fechar-busca-mobile" class="hidden-lg hidden-md">
			<img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/close.png" alt="Fechar Busca" class="img-responsive">
		</a>

		<div class="clearfix">
			<div class="tab-content">
				<!-- ### CARACTERÍSTICAS ### -->
				<div role="tabpanel" class="tab-pane active" id="tab-caracteristicas">
					<div class='box-busca'>
						<strong>Palavra chave</strong>

						<div class='container-busca' style="background-color:transparent;">
							<div class="form-group">
								<input type="search" class="form-control" id="busca-palavra-chave" name="palavra_chave" placeholder="Ex: Praia da Costa Offices" value="<?php echo (isset($_GET['palavra_chave']) ? $_GET['palavra_chave'] : ''); ?>">
							</div>
						</div>
					</div>

					<?php
					echo html_box_opcoes_busca($opcoes_tipo_imovel,$this->array_filtros,'radio');
					echo html_box_opcoes_busca($opcoes_cidade,$this->array_filtros,'checkbox');
					?>
				</div>
			</div>
		</div>

		<div id="exibe-botao">
			<div id="envolve-botao-busca">
				<button id="btn-busca-avancada" class="btn btn-block btn-lg">Buscar</button>
			</div>
		</div>
	</form>
</div>




<script>

function runMyCode(elem, funcName, funcName_hide) {

    jQuery(window).on('scroll.' + funcName, __runMyCode(document.getElementById(elem)));
    jQuery('.box-busca-imoveis').on('scroll.' + funcName, __runMyCode(document.getElementById(elem)));
}

function isInViewPort(elem) {
    var rect = elem.getBoundingClientRect();
    return (rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && rect.right <= (window.innerWidth || document.documentElement.clientWidth));
}

function __runMyCode(elem){
    return function(){
        if(isInViewPort(elem)){
            $(function(){
				$('#envolve-botao-busca').removeClass('fixed');
				console.log('Visível');
			});

        }else{
        	$(function(){
				$('#envolve-botao-busca').addClass('fixed');
				console.log('Não visível');
			});
        }
    }
}

// $(function(){
// 	if($(window).innerWidth() > 992){
// 		$('#envolve-botao-busca').css('width',($('#envolve-botao-busca').width() + 24));

// 		setTimeout(function(){
// 			runMyCode("exibe-botao");
// 		},100);

// 	}else{
// 		$('#envolve-botao-busca').addClass('fixed');

// 		runMyCode("exibe-botao");
// 	}
// });

function habilitar(elemento){
	if($(elemento).hasClass('ativo')){
		$(elemento).removeClass('ativo');
		$(elemento).children('.check-lazer').prop('checked', false);
	}else{
		$(elemento).addClass('ativo');
		$(elemento).children('.check-lazer').prop('checked', true);
	}
}


function exibeMaisOpcoesBusca(elemento){
	var div_container = $(elemento).attr('data-container');

	if($(elemento).hasClass('f-close')){
		$('#'+div_container).slideDown(200,function(){
			$(elemento).removeClass('f-close').addClass('f-open').html('+ Ocultar opções');
		});

	}else{
		$('#'+div_container).slideUp(200,function(){
			$(elemento).removeClass('f-open').addClass('f-close').html('+ Mais opções');
		});
	}
}

function exibeBuscaAvancada(){
	if($('.box-busca-imoveis').hasClass('show')){
		$('.box-busca-imoveis').css('display','none').removeClass('show');
	}else{
		$('.box-busca-imoveis').css('display','block').addClass('show');
		$('#envolve-botao-busca').addClass('fixed');
	}
}

</script>