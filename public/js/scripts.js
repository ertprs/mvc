$(function(){
	let headerSize = $('#header').height();
	$('#header-back').height(headerSize);
	
	$( window ).resize(function() {
		let headerSize = $('#header').height();
		$('#header-back').height(headerSize);
	});
});