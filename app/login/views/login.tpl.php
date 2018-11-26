<section class="section-internas" id="internas-acesso-cliente">
    <header class="header-section-internas">
        <div class="container">
            <h2>Acessar minha conta</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <form id="form-login" method="post" action="<?=CONFIG_PATH?>/login/<?=(!empty($_GET['fin']) ? '?fin=1' : ''); ?>">
                        <strong>Entre com seu usuário e senha</strong>

                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                        </div>

                        <a href="<?=CONFIG_PATH?>/esqueci-minha-senha/">Esqueci minha senha</a>

                        <button type="submit" class="btn btn-default">Entrar</button>
                    </form>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <form id="form-pre-cadastro" method="post" action="<?=CONFIG_PATH?>/cadastro-cliente/<?=(!empty($_GET['fin']) ? '?fin=1' : ''); ?>">
                        <strong>Ainda não tem seu cadastro?</strong>

                        <div class="form-group">
                            <input type="text" class="form-control" name="nome" placeholder="Nome completo" required>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                        </div>

                        <button type="submit" class="btn btn-default">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>