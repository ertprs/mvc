<ul class="nav nav-pills">
    <li role="presentation"><a href="?secao=noticias">Listar</a></li>

    <?php if(checa_permissao($_SESSION['nivel_online'],'noticias_cadastrar')){ ?>
    	<li role="presentation"><a href="?secao=noticias_cadastrar">Cadastrar</a></li>
    <?php } ?>
</ul>