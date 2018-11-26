<header class="main-header">
    <a href="?secao=main" class="logo">
        <span class="logo-mini"><center><img src="imagens/logo3.jpg" class="img-responsive" alt=""></center></span>
        <span class="logo-lg" style="padding-top: 12px;"><img src="imagens/logo.png" class="img-responsive" alt=""></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="imagem.php?img=arquivos/usuarios/<?=$_SESSION['dados_usuario_online']['perfil']?>&w=120&h=120&q=90" class="user-image" alt="<?=$_SESSION['dados_usuario_online']['nome']?>">
                        <span class="hidden-xs"><?=$_SESSION['dados_usuario_online']['nome']?></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="user-header" style="background-color:<?=$cor1?>;">
                            <img src="imagem.php?img=arquivos/usuarios/<?=$_SESSION['dados_usuario_online']['perfil']?>&w=160&h=160&q=90" class="img-circle" alt="<?=$_SESSION['dados_usuario_online']['nome']?>">

                            <p>
                                <?=$_SESSION['dados_usuario_online']['nome']?>
                                <small><?=$_SESSION['dados_usuario_online']['nome_nivel']?></small>
                            </p>
                        </li>

                        <li class="user-footer"  style="background-color:<?=$cor1?>;color:<?=$cor3?>;">
                            <a href="?secao=main&acao=logout" class="btn btn-default btn-block" style="background-color:<?=$cor3?>;">Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>