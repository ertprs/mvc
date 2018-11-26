<ul class="nav nav-pills">
    <li role="presentation"><a href="?secao=banners_principais">Listar</a></li>
    
    <?php if(checa_permissao($_SESSION['nivel_online'],'banners_principais_cadastrar')){ ?>
    	<li role="presentation"><a href="?secao=banners_principais_cadastrar">Cadastrar</a></li>
    <?php } ?>
</ul>