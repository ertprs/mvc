<section class="section-internas" id="internas-cadastro-cliente">
    <header class="header-section-internas">
        <div class="container">
            <h2 class="text-center">Faça seu cadastro</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <p class="text-center">Faça seus dados para concluir o seu acesso.</p>

            <form id="form-cadastro-cliente" method="post" action="<?=CONFIG_PATH?>/cadastro-cliente/?acao=cadastrar<?=(!empty($_GET['fin']) ? '&fin=1' : ''); ?>">
                <fieldset>
                    <legend>Informações pessoais</legend>

                    <div class="form-group">
                        <input type="text" class="form-control" name="nome" placeholder="Nome completo" value="<?=(!empty($_POST['nome']) ? $_POST['nome'] : '')?>" required>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?=(!empty($_POST['email']) ? $_POST['email'] : '')?>" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control telefone" name="telefone" placeholder="Telefone" value="<?=(!empty($_POST['telefone']) ? $_POST['telefone'] : '')?>" required>
                    </div>
                </fieldset>


                <fieldset>
                    <legend>Senha de acesso</legend>

                    <div class="form-group">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-default">Entrar</button>
            </form>
        </div>
    </div>
</section>