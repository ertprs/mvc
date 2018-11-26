var url_site = window.location.origin;

if(url_site != 'http://192.168.2.152'){
    url_site = url_site + "";

}else{
    url_site = url_site + "/dalcol";
}

$(function(){
	var path = url_site + '/jcart',
		container = $('#jcart'),
		config = '',
		token = $('[name=jcartToken]').val()

	$.get({
		url: path + '/config-loader.php',
		data:{
			"ajax": "true"
		},
		async: false,
		success: function(response){
			config = response;
		},
		error: function(){
			alert('Ajax error: Edit the path in jcart.js to fix.');
		}
	});

	$('#jcart-buttons').remove();

	var url = document.URL;
	var tmp2 = "";

	if(url.indexOf('finalizar') != -1){
		var tmp = url.split('finalizar');
		tmp2 = '?secao=finalizar'+tmp[1].replace('/', '');

	}else if(url.indexOf('?acao=final') != -1){
		var tmp = url.split('?acao=final');
		tmp2 = '?acao=final'+tmp[1].replace('/', '');
	}

	$.ajaxSetup({
		type: 'POST',
		url: path + '/relay.php'+tmp2,
		success: function(response) {
			container.html(response);
			$('#jcart-buttons').remove();

			$('.notification-counter').html($('#count-cart').html());
		},
		error: function(x, e) {
			var s = x.status,
				m = 'Ajax error: ' ;

			if(s === 0){
				m += 'Check your network connection.';
			}
			if(s === 404 || s === 500){
				m += s;
			}

			if(e === 'parsererror' || e === 'timeout'){
				m += e;
			}

			console.log(x);
		}
	});

	var isCheckout = $('#jcart-is-checkout').val();

	function add(form){
		var itemQty = form.find('[name=' + config.item.qty + ']'),
			itemAdd = form.find('[name=' + config.item.add + ']');

		$.ajax({
			data: form.serialize() + '&' + config.item.add + '=' + itemAdd.val(),
			success: function(response) {
				  $(".tab_carrinho").animate({width: '0px'}, function(){
					$(".tab_carrinho2").animate({width: '400px'});
					$('.tab_carrinho2').css('z-index','9999');
				  });

				  $(".added_"+form.find('[name=' + config.item.id + ']').val()+"").show();


				container.html(response);
				$('#jcart-buttons').remove();

				$('.notification-counter').html($('#count-cart').html());
			}
		});
	}

	function update(input){
		var updateId = input.parent().find('[name="jcartItemId[]"]').val();
		var Color = $('#jcartItemColor-'+updateId).val();
		var newQty = input.val();

		if(newQty){
			var nome = $('#nome').val();
			var tel = $('#tel').val();
			var email = $('#email').val();

			$(".tel").focusout(function(){
		        var phone, element;
		        element = $(this);
		        element.unmask();
		        phone = element.val().replace(/\D/g, '');

		        if(phone.length > 10){
		            element.mask('(99)99999-999?9');

		        }else{
		            element.mask('(99)9999-9999?9');
		        }
		    }).trigger('focusout');


			var updateTimer = window.setTimeout(function(){
				$.ajax({
					data: {
						"jcartUpdate": 1, // Only the name in this pair is used in jcart.php, but IE chokes on empty values
						"itemId": updateId,
						"itemQty": newQty,
						"itemColor": Color,
						"jcartIsCheckout": isCheckout,
						"jcartToken": token,
						"nome": nome,
						"tel": tel,
						"email": email
					},
					success: function(response){
						console.log(response);
					}
				});
			}, 1000);
		}

		input.keydown(function(e){
			if(e.which !== 9){
				window.clearTimeout(updateTimer);
			}
		});
	}

	function remove(link) {
		var queryString = link.attr('href');
		queryString = queryString.split('=');

		var removeId = queryString[1];

		$.ajax({
			type: 'GET',
			data: {
				"jcartRemove": removeId,
				"jcartIsCheckout": isCheckout
			}
		});

		$(".remove"+removeId+"").hide();
		$(".add"+removeId+"").show();
	}

	$('.jcart').on('submit',function(e){
		add($(this));
		e.preventDefault();
	});

	container.keydown(function(e){
		if(e.which === 13){
			e.preventDefault();
		}
	});

	container.delegate('[name="jcartItemQty[]"]', 'keyup', function(){
		update($(this));
	});

	container.delegate('[name="jcartItemColor[]"]', 'keyup', function(){
		updateColor($(this));
	});

	container.delegate('.jcart-remove', 'click', function(e){
		remove($(this));
		e.preventDefault();
	});

	$('.jcart-remove2').on('click', function(e){
		remove($(this));
		e.preventDefault();
	});
});