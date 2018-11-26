<section class="section-internas" id="internas-trabalhe-conosco">
    <header class="header-section-internas">
        <div class="container">
            <h2>Trabalhe conosco</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <p class="text-center">Preencha seus dados para concluir o seu acesso.</p>

            <form id="form-trabalhe-conosco" method="post" action="<?php echo CONFIG_PATH;?>/trabalhe_conosco/?acao=enviar" enctype="multipart/form-data">
                <fieldset>
                    <legend>Seus dados</legend>

                    <div class="form-group">
                        <input type="text" class="form-control" name="input_nome" placeholder="* Nome" required>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" name="input_email" placeholder="* E-mail" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control telefone" name="input_telefone" placeholder="* Telefone" required>
                    </div>
                </fieldset>


                <fieldset>
                    <legend>* Anexar Currículo</legend>

                    <input type="file" name="input_curriculo" required>
                </fieldset>


                <fieldset>
                    <legend>Observação</legend>

                    <div class="form-group">
                        <textarea class="form-control" name="input_obs" placeholder="* Mensagem" required></textarea>
                    </div>
                </fieldset>


                <button type="submit" class="btn btn-default">Enviar</button>
            </form>
        </div>
    </div>
</section>