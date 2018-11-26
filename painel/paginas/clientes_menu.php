<ul class="nav nav-pills">
    <li role="presentation"><a href="?secao=clientes">Listar</a></li>
    
    <?php if(checa_permissao($_SESSION['nivel_online'],'clientes_cadastrar')){ ?>
	    <li role="presentation"><a href="?secao=clientes_cadastrar">Cadastrar</a></li>
	<?php } ?>

    <li role="presentation">
    	<a href="javascript:;" data-toggle="modal" data-target="#modal_busca">Buscar</a>
    </li>
</ul>


<?php include "paginas/clientes_buscar.php"; ?>