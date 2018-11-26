<section class="section-internas" id="internas-cadastro-cliente">
    <header class="header-section-internas">
        <div class="container">
            <h2 class="text-center">Finalizar Orçamento</h2>
        </div>
    </header>

    <div class="conteudo-section-internas">
        <div class="container">
            <strong>Nome: </strong>
            <span><?=$_SESSION['cliente']['nome']?></span>

            <br />

            <strong>Email: </strong>
            <span><?=$_SESSION['cliente']['email']?></span>

            <br />

            <strong>Telefone: </strong>
            <span><?=$_SESSION['cliente']['telefone']?></span>

            <div id="finalizar">
                <div id="jcart">
                    <?php $_SESSION['jcart']->display_cart(); ?>
                </div>
            </div>
        </div>
    </div>
</section>