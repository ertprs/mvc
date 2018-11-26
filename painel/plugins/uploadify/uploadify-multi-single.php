
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.uploadify.js"></script>

<script type="text/javascript">

$(document).ready(function() {
	$("#fileUpload").fileUpload({
		'uploader': 'uploadify/uploader.swf',
		'cancelImg': 'uploadify/cancel.png',
		'script': 'uploadify/upload.php',
		'folder': 'files',
		'multi': false,
		'displayData': 'speed'
	});

	$("#fileUpload2").fileUpload({
		'uploader': 'uploadify/uploader.swf',
		'cancelImg': 'uploadify/cancel.png',
		'script': 'uploadify/upload.php',
		'folder': 'files',
		'multi': true,
		'buttonText': 'procurar',
		'checkScript': 'uploadify/check.php',
		'displayData': 'speed',
		'simUploadLimit': 2
	});


});

</script>
</head>

<body>

		<p>Selecione as fotos que deseja</p>
		<div id="fileUpload2">Voce está com problema de javascript no navegador</div>
		<a href="javascript:$('#fileUpload2').fileUploadStart()">Começar envio</a> |  <a href="javascript:$('#fileUpload2').fileUploadClearQueue()">apagar lista</a>
    	<p></p>

</body>
</html>