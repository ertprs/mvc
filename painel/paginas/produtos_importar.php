<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$mensagem = null;

function verifica_xls($file) {
	$mime_type = array("xls" => "application/vnd.ms-excel");
	$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
	if (isset($mime_type[$extension])) {
		return true;
	}
	return false;
}

if($_GET['acao'] == 'cadastrar') {
	/** Include PHPExcel_IOFactory */
	require_once dirname( __FILE__ ) . '/../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';

	$arquivo_tmp  = $_FILES['input_arquivo']['tmp_name'];
	$arquivo_name = $_FILES['input_arquivo']['name'];
	if(!empty($arquivo_name)){
		$arquivo_name = removercaracteres(date('dmYHis').$arquivo_name);
	}
	$arquivo = 'arquivos/produtos_importacao/'.$arquivo_name;
	move_uploaded_file($arquivo_tmp, $arquivo);

    if(strpos($arquivo, '.xls') !== false && verifica_xls($arquivo)) {
	    $inputFileName = __DIR__ . '/../' . $arquivo;
	    $spreadsheet   = PHPExcel_IOFactory::load( $inputFileName );
	    $sheetData     = $spreadsheet->getActiveSheet()->toArray( null, true, true, true );

	    //var_dump($sheetData);

	    //apaga a primeira linha para remover os títulos
	    unset($sheetData[1]);

	    $i = 0;
	    foreach ($sheetData as $v){
	        $codigo = $v['A'];
	        $nome = $v['B'];
	        $categoria_nome = $v['C'];
	        $parceiro_nome = $v['D'];

	        ////////////////////////////////
	        //verifica se categoria existe//
		    ////////////////////////////////
            $categoria = mysql_fetch_assoc(mysql_query("SELECT id FROM produtos_categorias WHERE nome = '{$categoria_nome}'"));
		    $categoria_id = $categoria['id'];
            if(empty($categoria['id'])){
	            $sql_categoria = "INSERT INTO produtos_categorias (usuario_cadastro, nome, data_cadastro) VALUES ('".$_SESSION['usuario_online']."', '{$categoria_nome}', NOW())";
	            $result = mysql_query($sql_categoria);
	            $categoria_id = mysql_insert_id();
            }

		    ////////////////////////////////
		    //verifica se parceiro existe///
		    ////////////////////////////////
		    $parceiro_count = mysql_fetch_assoc(mysql_query("SELECT COUNT(1) num FROM parceiros"));
		    $parceiro = mysql_fetch_assoc(mysql_query("SELECT id FROM parceiros WHERE nome = '{$parceiro_nome}'"));
		    $parceiro_id = $parceiro['id'];
		    if(empty($parceiro['id'])){
			    $sql_parceiro = "INSERT INTO parceiros 
			    (usuario_cadastro, nome, link, data_cadastro, ordem) VALUES 
			    ('".$_SESSION['usuario_online']."', '{$parceiro_nome}', '".str_replace('.html','',url_amigavel($parceiro_nome))."', NOW(), ".$parceiro_count['num'].")";
			    $result = mysql_query($sql_parceiro);
			    $parceiro_id = mysql_insert_id();
		    }

		    ////////////////////////////////
		    //cadastrando o produto/////////
		    ////////////////////////////////
            $produtos_count = mysql_fetch_assoc(mysql_query("SELECT COUNT(1) num FROM produtos WHERE cod_venda = '{$codigo}'"));
		    if($produtos_count['num'] == 0 && !empty($nome) && !empty($categoria_id) && !empty($parceiro_id) && !empty($codigo)){
		        $produto_sql = "INSERT INTO produtos
		        (data_cadastro, usuario_cadastro, nome, categoria, parceiro_id, cod_venda, `status`) VALUES 
		        (NOW(), '".$_SESSION['usuario_online']."', \"$nome\", '{$categoria_id}', '{$parceiro_id}', '{$codigo}', '1')";
			    $result = mysql_query($produto_sql);
			    if($result){
			        $i++;
                }
            }
        }
        echo '<script>location.href = "?secao=produtos_importar&msg=1&num='.$i.'";</script>';
    }else{
	    echo '<script>location.href = "?secao=produtos_importar&msg=2";</script>';
    }
    exit();
}

if(isset($_GET['msg'])){
    if($_GET['msg'] == 1){
	    $mensagem = '<br><div class="alert alert-success" role="alert">Arquivo importado - '.$_GET['num'].' produto(s) cadastrado(s)!</div>';
    }
	if($_GET['msg'] == 2){
		$mensagem = '<br><div class="alert alert-warning" role="alert">Formato de arquivo inválido!</div>';
	}
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Produtos
            <small>Importar</small>
        </h1>

        <div class="pull-right">
			<?php include "paginas/produtos_menu.php"; ?>
        </div>
    </section>

    <section class="content">
        <div class="row">

			<?=$mensagem?>

            <form role="form" id="form" action="?secao=produtos_importar&acao=cadastrar" method="post"  enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="box box-primary" style="border-top-color:<?=$cor1?>;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>

                        <div class="box-body">

                            <div class="form-group">
                                <label for="input-arquivo" class="col-sm-3 control-label text-right">Arquivo * <br>(Aceita somente arquivos .XLS)</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="input-arquivo" name="input_arquivo" style="width:auto;" required accept="application/vnd.ms-excel">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <strong>Modelo de arquivo para importação:</strong><br>
                                    <a href="arquivos/modelo.xls" target="_blank"><img src="../painel/imagens/excel.png" alt="modelo.xls" style="width: 24px;"> modelo.xls</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br clear="all">

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="color:<?=$cor3?> !important">Importar</button>
                </div>
            </form>
        </div>
    </section>
</div>

<style>
    .form-group{
        width:100%;
        float:left;
    }

    #form label{
        padding-top:6px;
    }
</style>