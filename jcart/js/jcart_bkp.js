
// jCart v1.3
// http://conceptlogic.com/jcart/

var url_site = window.location.origin;

if (url_site != 'http://192.168.2.152' && url_site != 'http://192.168.2.5') {
    url_site = url_site + "";

} else {
    url_site = url_site + "/santaclarapromo";
}



$(function() {

	var JCART = (function() {

		// This script sends Ajax requests to config-loader.php and relay.php using the path below
		// We assume these files are in the 'jcart' directory, one level above this script
		// Edit as needed if using a different directory structure
		var path = url_site + '/jcart',
			container = $('#jcart'),
			token = $('[name=jcartToken]').val(),
			tip = $('#jcart-tooltip');

			console.log(url_site + '/jcart' + '/config-loader.php');

		var config = (function() {
			var config = null;
			$.ajax({
				url: path + '/config-loader.php',
				data: {
					"ajax": "true"
				},
				dataType: 'json',
				async: false,
				success: function(response) {
					config = response;
				},
				error: function() {
					alert('Ajax error: Edit the path in jcart.js to fix.');
				}
			});
			return config;
		}());

		var setup = (function() {
			if(config.tooltip === true) {
				tip.text(config.text.itemAdded);

				// Tooltip is added to the DOM on mouseenter, but displayed only after a successful Ajax request
				$('.jcart [type=submit]').mouseenter(
					function(e) {
						var x = e.pageY + 25,
							y = e.pageX + -10;
						$('body').append(tip);
						tip.css({top: y + 'px', left: x + 'px'});



					}
				)
				.mousemove(
					function(e) {
						var y = e.pageY + 25,
						x = e.pageX + -10;
						tip.css({top: y + 'px', left: x + 'px'});
					}
				)
				.mouseleave(
					function() {
						tip.hide();
					}
				);
			}

			// Remove the update and empty buttons since they're only used when javascript is disabled
			$('#jcart-buttons').remove();

			var url = document.URL;
			var tmp2 = "";
			if(url.indexOf('finalizar') != -1){
				var tmp = url.split('finalizar');
				tmp2 = '?secao=finalizar'+tmp[1].replace('/', '');
			}
			else if(url.indexOf('?acao=final') != -1){
				var tmp = url.split('?acao=final');
				tmp2 = '?acao=final'+tmp[1].replace('/', '');
			}


			// Default settings for Ajax requests
			$.ajaxSetup({
				type: 'POST',
				url: path + '/relay.php'+tmp2,
				success: function(response) {
					// Refresh the cart display after a successful Ajax request
					container.html(response);
					$('#jcart-buttons').remove();

					$('.notification-counter').html($('#count-cart').html());
				},
				// See: http://www.maheshchari.com/jquery-ajax-error-handling/
				error: function(x, e) {
					var s = x.status,
						m = 'Ajax error: ' ;
					if (s === 0) {
						m += 'Check your network connection.';
					}
					if (s === 404 || s === 500) {
						m += s;
					}
					if (e === 'parsererror' || e === 'timeout') {
						m += e;
					}
					//alert(m);
					console.log(x);
				}
			});
		}());

		// Check hidden input value
		// Sent via Ajax request to jcart.php which decides whether to display the cart checkout button or the PayPal checkout button based on its value
		// We normally check against request uri but Ajax update sets value to relay.php

		// If this is not the checkout the hidden input doesn't exist and no value is set
		var isCheckout = $('#jcart-is-checkout').val();




		function add(form) {
			// Input values for use in Ajax post
			var itemQty = form.find('[name=' + config.item.qty + ']'),

				itemAdd = form.find('[name=' + config.item.add + ']');

			// Add the item and refresh cart display
			$.ajax({
				data: form.serialize() + '&' + config.item.add + '=' + itemAdd.val(),
				success: function(response) {
					  $(".tab_carrinho").animate({width: '0px'}, function(){
						$(".tab_carrinho2").animate({width: '400px'});
						$('.tab_carrinho2').css('z-index','9999');
					  });

					  $(".added_"+form.find('[name=' + config.item.id + ']').val()+"").show();

					// Momentarily display tooltip over the add-to-cart button
					if (itemQty.val() > 0 && tip.css('display') === 'none') {
						tip.fadeIn('100').delay('400').fadeOut('100');
					}

					container.html(response);
					$('#jcart-buttons').remove();

					$('.notification-counter').html($('#count-cart').html());
				}
			});
		}

		function update(input) {
			// The id of the item to update
			var updateId = input.parent().find('[name="jcartItemId[]"]').val();

			var Color = $('#jcartItemColor-'+updateId).val();

			// The new quantity
			var newQty = input.val();

			// As long as the visitor has entered a quantity
			if (newQty) {

				var nome = $('#nome').val();
				var tel = $('#tel').val();
				var email = $('#email').val();

				$(".tel").focusout(function(){
			        var phone, element;
			        element = $(this);
			        element.unmask();
			        phone = element.val().replace(/\D/g, '');
			        if(phone.length > 10)
			        {
			            element.mask('(99)99999-999?9');
			        }
			        else
			        {
			            element.mask('(99)9999-9999?9');
			        }
			    }).trigger('focusout');

				// Update the cart one second after keyup
				var updateTimer = window.setTimeout(function() {

					// Update the item and refresh cart display
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
						}
					});
				}, 1000);
			}

			// If the visitor presses another key before the timer has expired, clear the timer and start over
			// If the timer expires before the visitor presses another key, update the item
			input.keydown(function(e){
				if (e.which !== 9) {
					window.clearTimeout(updateTimer);
				}
			});
		}

		function updateColor(input) {
			// The id of the item to update
			var updateId = input.parent().parent().find('[name="jcartItemId[]"]').val();
			var Qty = input.parent().parent().find('[name="jcartItemQty[]"]').val();

			// The new quantity
			var newColor = input.val();


			// As long as the visitor has entered a quantity
			if (newColor) {

				var nome = $('#nome').val();
				var tel = $('#tel').val();
				var email = $('#email').val();

				$(".tel").focusout(function(){
			        var phone, element;
			        element = $(this);
			        element.unmask();
			        phone = element.val().replace(/\D/g, '');
			        if(phone.length > 10)
			        {
			            element.mask('(99)99999-999?9');
			        }
			        else
			        {
			            element.mask('(99)9999-9999?9');
			        }
			    }).trigger('focusout');

				// Update the cart one second after keyup
				var updateTimer = window.setTimeout(function() {

					// Update the item and refresh cart display
					$.ajax({
						data: {
							"jcartUpdate": 1, // Only the name in this pair is used in jcart.php, but IE chokes on empty values
							"itemId": updateId,
							"itemColor": newColor,
							"itemQty": Qty,
							"jcartIsCheckout": isCheckout,
							"jcartToken": token,
							"nome": nome,
							"tel": tel,
							"email": email
						}
					});
				}, 1000);
			}

			// If the visitor presses another key before the timer has expired, clear the timer and start over
			// If the timer expires before the visitor presses another key, update the item
			input.keydown(function(e){
				if (e.which !== 9) {
					window.clearTimeout(updateTimer);
				}
			});
		}

		function remove(link) {
			// Get the query string of the link that was clicked
			var queryString = link.attr('href');
			queryString = queryString.split('=');

			// The id of the item to remove
			var removeId = queryString[1];



			// Remove the item and refresh cart display
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

		// Add an item to the cart
		$('.jcart').on('submit',function(e) { //***
			add($(this));
			e.preventDefault();
		});

		// Prevent enter key from submitting the cart
		container.keydown(function(e) {
			if(e.which === 13) {
				e.preventDefault();
			}
		});

		// Update an item in the cart
		container.delegate('[name="jcartItemQty[]"]', 'keyup', function(){
			update($(this));
		});

		// Update an item in the cart
		container.delegate('[name="jcartItemColor[]"]', 'keyup', function(){
			updateColor($(this));
		});

		// Remove an item from the cart
		container.delegate('.jcart-remove', 'click', function(e){
			remove($(this));
			e.preventDefault();
		});

		// adicionado para click externo //***
		$('.jcart-remove2').on('click', function(e){
			remove($(this));
			e.preventDefault();
		});

	}()); // End JCART namespace

}); // End the document ready function
