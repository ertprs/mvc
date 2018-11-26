<section class="section-internas" id="internas-acesso-cliente">
    <header class="header-section-internas">
        <div class="container">
            <h2 class="text-center">Esqueci minha senha</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <div class="row">
                <form id="form-login" method="post" action="<?=CONFIG_PATH?>/esqueci-minha-senha/">
                    <strong>Digite seu email para receber uma nova senha</strong>

                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>

                    <button type="submit" class="btn btn-default">Recuperar</button>
                </form>
            </div>
        </div>
    </div>
</section>