<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="imagem.php?img=arquivos/usuarios/<?=$_SESSION['dados_usuario_online']['perfil']?>&w=120&h=120&q=90" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$_SESSION['dados_usuario_online']['nome']?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>

            <!-- ### PAGINA INICIAL ### -->
           <!--
 <li class="treeview <?php if($_GET['secao'] == 'main' || $_GET['secao'] == ''){ ?>active<?php } ?>">
                <a href="?secao=main">
                    <i class="fa fa-circle-o"></i>
                    <span>Página Inicial</span>
                </a>
            </li>
-->

            <!-- ### BANNERS PRINCIPAIS ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'banners_principais')){ ?>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-circle-o"></i>
                        <span>Banners Principais</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li>
                            <a href="?secao=banners_principais">
                                <i class="fa fa-circle-o"></i>
                                Listar
                            </a>
                        </li>

                        <?php if(checa_permissao($_SESSION['nivel_online'],'banners_principais_cadastrar')){ ?>
                            <li>
                                <a href="?secao=banners_principais_cadastrar">
                                    <i class="fa fa-circle-o"></i>
                                    Cadastrar
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <!-- ### EMPRESA ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'a_empresa')){ ?>
                <li class="treeview <?php if($_GET['secao'] == 'a_empresa'){ ?>active<?php } ?>">
                    <a href="?secao=a_empresa">
                        <i class="fa fa-circle-o"></i>
                        <span>A Empresa</span>
                    </a>
                </li>
            <?php } ?>

            <!-- ### CLIENTES ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'clientes')){ ?>
                <li class="treeview <?php if($_GET['secao'] == 'clientes'){ ?>active<?php } ?>">
                    <a href="?secao=clientes">
                        <i class="fa fa-circle-o"></i>
                        <span>Clientes</span>
                    </a>
                </li>
            <?php } ?>

            <!-- ### CLIENTES ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'orcamentos')){ ?>
                <li class="treeview <?php if($_GET['secao'] == 'orcamentos'){ ?>active<?php } ?>">
                    <a href="?secao=orcamentos">
                        <i class="fa fa-circle-o"></i>
                        <span>Orçamentos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li>
                            <a href="?secao=orcamentos">
                                <i class="fa fa-circle-o"></i>
                                Listar
                            </a>
                        </li>

                        <li>
                            <a href="?secao=status_orcamento">
                                <i class="fa fa-circle-o"></i>
                                Status
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <!-- ### PRODUTOS ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'produtos')){ ?>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-circle-o"></i>
                        <span>Produtos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li>
                            <a href="?secao=produtos">
                                <i class="fa fa-circle-o"></i>
                                Listar
                            </a>
                        </li>

                        <?php if(checa_permissao($_SESSION['nivel_online'],'produtos_cadastrar')){ ?>
                            <li>
                                <a href="?secao=produtos_cadastrar">
                                    <i class="fa fa-circle-o"></i>
                                    Cadastrar
                                </a>
                            </li>
                        <?php } ?>

                        <?php if(checa_permissao($_SESSION['nivel_online'],'produtos_categorias')){ ?>
                            <li>
                                <a href="?secao=produtos_categorias">
                                    <i class="fa fa-circle-o"></i>
                                    Categorias
                                </a>
                            </li>
                        <?php } ?>

	                   <!--
 <?php if(checa_permissao($_SESSION['nivel_online'],'produtos_cadastrar')){ ?>
                            <li>
                                <a href="?secao=produtos_importar">
                                    <i class="fa fa-circle-o"></i>
                                    Importar
                                </a>
                            </li>
	                    <?php } ?>
-->
                    </ul>
                </li>

            <?php } ?>

            <!-- ### NOTICIAS ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'noticias')){ ?>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-circle-o"></i>
                        <span>Novidades</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li>
                            <a href="?secao=noticias">
                                <i class="fa fa-circle-o"></i>
                                Listar
                            </a>
                        </li>

                        <?php if(checa_permissao($_SESSION['nivel_online'],'noticias_cadastrar')){ ?>
                            <li>
                                <a href="?secao=noticias_cadastrar">
                                    <i class="fa fa-circle-o"></i>
                                    Cadastrar
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <!-- ### PARCEIROS ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'parceiros')){ ?>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-circle-o"></i>
                        <span>Parceiros</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li>
                            <a href="?secao=parceiros">
                                <i class="fa fa-circle-o"></i>
                                Listar
                            </a>
                        </li>

                        <?php if(checa_permissao($_SESSION['nivel_online'],'parceiros_cadastrar')){ ?>
                            <li>
                                <a href="?secao=parceiros_cadastrar">
                                    <i class="fa fa-circle-o"></i>
                                    Cadastrar
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>


            <!-- ### TRABALHE CONOSCO ### -->
           <!--
 <?php if(checa_permissao($_SESSION['nivel_online'],'trabalhe_conosco')){ ?>
                <li class="treeview <?php if($_GET['secao'] == 'trabalhe_conosco'){ ?>active<?php } ?>">
                    <a href="?secao=trabalhe_conosco">
                        <i class="fa fa-circle-o"></i>
                        <span>Trabalhe Conosco</span>
                    </a>
                </li>
            <?php } ?>
-->

            <!-- ### FALE CONOSCO ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'fale_conosco')){ ?>
                <li class="treeview <?php if($_GET['secao'] == 'fale_conosco'){ ?>active<?php } ?>">
                    <a href="?secao=fale_conosco">
                        <i class="fa fa-circle-o"></i>
                        <span>Fale Conosco</span>
                    </a>
                </li>
            <?php } ?>

            <!-- ### USUARIOS ### -->
            <?php if(checa_permissao($_SESSION['nivel_online'],'usuarios')){ ?>
                <li class="treeview">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Usuários</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                        <li>
                            <a href="?secao=usuarios">
                                <i class="fa fa-circle-o"></i>
                                Listar
                            </a>
                        </li>

                        <?php if(checa_permissao($_SESSION['nivel_online'],'usuarios_cadastrar')){ ?>
                            <li>
                                <a href="?secao=usuarios_cadastrar">
                                    <i class="fa fa-circle-o"></i>
                                    Cadastrar
                                </a>
                            </li>
                        <?php } ?>

                        <?php if(checa_permissao($_SESSION['nivel_online'],'niveis')){ ?>
                            <li>
                                <a href="?secao=niveis">
                                    <i class="fa fa-circle-o"></i>
                                    Níveis
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="?secao=permissoes_acesso">
                                <i class="fa fa-circle-o"></i>
                                Permissões de acesso
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </section>
</aside>