<section class="section-internas" id="internas-contato">
    <header class="header-section-internas">
        <div class="container">
            <h2>Fale conosco</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div id="mapa"></div>

        <div class="container">
            <div class="bg-branco">
                <h3>Fale conosco</h3>

                <form action="<?=CONFIG_PATH?>/fale-conosco/" method="post" id="form-contato">
                    <div class="form-group">
                        <select class="form-control" id="input-assunto" name="input_assunto" required>
                            <option value=''>* Escolha um assunto</option>
                            <?php if(count($this->assuntos) > 0){ ?>
                                <?php foreach($this->assuntos as $linha){ ?>
                                    <option value='<?=$linha['id']?>'><?=($linha['nome'])?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="input-nome" name="input_nome" placeholder="* Seu nome" required>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" id="input-email" name="input_email" placeholder="* Seu e-mail" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control telefone" id="input-telefone" name="input_telefone" placeholder="* Seu Telefone" required>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" id="input-mensagem" name="input_mensagem" placeholder="* Mensagem" required></textarea>
                    </div>

                    <button type="submit" id="btn-contato">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>