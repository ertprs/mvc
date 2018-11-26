<section class="section-internas" id="internas-cadastro-cliente">
    <header class="header-section-internas">
        <div class="container">
            <h2 class="text-center">Meus Dados</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <form id="form-cadastro-cliente" method="post" action="<?=CONFIG_PATH?>/meus-dados/?acao=atualizar">
                <fieldset>
                    <legend>Informações pessoais</legend>

                    <div class="form-group">
                        <input type="text" class="form-control" name="nome" placeholder="Nome completo" value="<?=$this->dados_cliente['nome']?>" required>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?=$this->dados_cliente['email']?>" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control telefone" name="telefone" placeholder="Telefone" value="<?=$this->dados_cliente['telefone']?>" required>
                    </div>
                </fieldset>


                <fieldset>
                    <legend>Senha de acesso</legend>

                    <div class="form-group">
                        <input type="password" class="form-control" name="senha" placeholder="Nova senha">
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-default">Atualizar</button>
            </form>
        </div>
    </div>
</section>