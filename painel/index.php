<?php
ini_set('display_errors',false);
header('Content-Type: text/html; charset=utf-8');

session_start();

include "conecta.php";

mysql_query("SET CHARACTER SET utf8");

include "funcoes.php";
include_once('../PHPMailer_v5.1/class.phpmailer.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Dal Col Carnes | Painel de Constrole</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">



<style>
.btn-primary{
    background-color: <?=$cor1?> !important;
    border-color: <?=$cor1?> !important;
}

.btn-primary:hover{
    background-color:<?=$cor2?> !important;
}

.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    background-color: <?=$cor1?> !important;
    border-color: <?=$cor1?> !important;
}

.main-header .logo, .main-header .logo:hover{
    background-color: <?=$cor3?> !important;
}

.main-header .navbar {
    background-color: <?=$cor3?> !important;
}


.sidebar-toggle:hover{
    background-color:<?=$cor1?> !important;
    color:<?=$cor3?> !important;
}


.sidebar-toggle,
.skin-red .main-header .navbar .nav>li>a,
.btn-primary{
    color:<?=$cor1?> !important;
}

</style>

<?php if(!empty($_SESSION['usuario_online'])){ ?>
    <link rel="stylesheet" href="css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
<!--
    <link rel="stylesheet" href="plugins/morris/morris.css">
-->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link href="plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="plugins/tag-it/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="js/sweetalert2.min.css">
<?php } ?>

<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="css/estilo.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="plugins/tag-it/js/tag-it.js" type="text/javascript" charset="utf-8"></script>




<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="<?php if(empty($_SESSION['usuario_online'])){ ?>hold-transition login-page<?php }else{ ?>hold-transition skin-red sidebar-mini<?php } ?>">

<?php
if(empty($_SESSION['usuario_online'])){
    include "paginas/login.php";

}else{ ?>
    <?php include "modal/templates_campos_cadastrar.php"; ?>
    <?php include "modal/exibir_contato.php"; ?>

    <div class="wrapper">
        <?php include "includes/header.php"; ?>

        <?php include "includes/aside_left.php"; ?>

        <?php
        if(empty($_GET['secao'])){
            include "paginas/main.php";
        }else{
            include "paginas/".$_GET['secao'].".php";
        }
        ?>

        <?php include "includes/footer.php"; ?>

        <?php include "includes/aside_right.php"; ?>

        <div class="control-sidebar-bg"></div>
    </div><?php
}
?>

<script src="bootstrap/js/bootstrap.min.js"></script>

<?php if(!empty($_SESSION['usuario_online'])){ ?>
    <script>
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>

    <script>$.widget.bridge('uibutton', $.ui.button);</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<!--
    <script src="plugins/morris/morris.min.js"></script>
-->

    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="plugins/knob/jquery.knob.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="js/app.min.js"></script>
    <script src="js/pages/dashboard.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/sweetalert2.min.js" type="text/javascript"></script>

    <!-- InputMask -->
<?php } ?>




<link rel="stylesheet" href="plugins/iCheck/all.css">
<script src="plugins/iCheck/icheck.min.js"></script>

<script>
$(function(){
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });
    
    <?php if(isset($_GET['deletar'])){ ?>
	swal(
	      'Sucesso!',
	      'O registro foi deletado.',
	      'success'
	    )
		<?php } ?>

});

function Deletar(url){
	swal({
	  title: 'Deseja deletar esse registro?',
	  text: "Você não poderá desfazer essa ação!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Sim, deletar!',
	  cancelButtonText: 'Cancelar'
	}).then((result) => {
	  if (result.value) {
	    location.href=url;
	  }
	});
}


</script>





<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script>var Jquery = $.noConflict();</script>

<script src="js/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.min.js" type="text/javascript"></script>

<script type="text/javascript">
Jquery(function(){
    Jquery('.real').maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    Jquery(".data").mask("99/99/9999");
    Jquery(".cpf").mask("999.999.999-99");
    Jquery(".cep").mask("99999-999");
    Jquery(".horario").mask("99:99");
    Jquery(".telefone").mask("(99) 99999-999?9");
    Jquery(".telefone2").mask("(99) 9999-9999");
});
</script>


</body>
</html>
