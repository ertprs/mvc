<section class="section-internas">
    <header class="header-internas">
        <div class="container">
            <h2>Imóveis</h2>

            <div id="envolve-filtro-mob" class="visible-xs visible-sm">
            	<center>
            		<button onClick="exibeBuscaAvancada();" class="btn btn-danger">Filtrar</button>
            	</center>
            </div>
        </div>
    </header>


    <div id="envolve-listagem-empreendimentos">
        <div class="container">
        	<div class="row">
        		<div class="col-md-3">
        			<?php include 'libs/BuscaAvancada/template_base.php'; ?>
                </div>

        		<div class="col-md-9">
        			<div class="row">
        				<?php if(count($this->registros) > 0){ ?>
        					<?php foreach($this->registros as $linha){ ?>
			                    <article class="reg-empreendimentos-list">
	        						<div class="col-md-8 col-sm-12">
	        							<div class="row">
		        							<div class="esquerda">
		        								<div class="col-md-6 col-sm-5">
			        								<?php if($linha['status_obra'] == 1){ ?>
			                                            <div class="box-status vermelho">
			                                                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/imovel-lancamento.png" alt="">
			                                                <div>Lançamentos</div>
			                                            </div>

			                                        <?php }elseif($linha['status_obra'] == 2){ ?>
			                                            <div class="box-status laranja">
			                                                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/imovel-em-obra.png" alt="">
			                                                <div>Em obras</div>
			                                            </div>

			                                        <?php }elseif($linha['status_obra'] == 3){ ?>
			                                            <div class="box-status verde">
			                                                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/imovel-pronto.png" alt="">
			                                                <div>Pronto</div>
			                                            </div>
			                                        <?php } ?>

				                                    <div class="img">
				                                        <a href="<?php echo CONFIG_PATH; ?>/<?=$linha['url']?>/">
				                                        	<img src="<?php echo CONFIG_PATH; ?>/painel/arquivos/empreendimentos/<?=$linha['fachada']?>" class="img-responsive" alt="">
				                                        </a>
				                                    </div>

				                                    <br clear="all">

				                                    <a href="<?php echo CONFIG_PATH; ?>/<?=$linha['url']?>/" class="btn-saiba-mais hidden-xs">Saiba Mais</a>
				                                </div>

				                                <div class="col-md-6 col-sm-7">
				                                	<div class="dados">
					                                	<a href="<?php echo CONFIG_PATH; ?>/<?=$linha['url']?>/">
					                                        <span><?=$linha['cidade_nome']?>/<?=$linha['estado_sigla']?></span>
				                                            <h3><?=$linha['nome']?></h3>
				                                            <h4><?=$linha['bairro_nome']?></h4>
				                                        </a>

					                                	<div class="icones hidden-xs">
				                                            <?php if($linha['empreendimento_tipo_id'] == 1){ ?>
					                                            <div>
					                                                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/salas-comerciais.png" alt="Salas Comerciais">
					                                                <span><?=$linha['salas']?></span>
					                                            </div>

					                                            <div>
					                                                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/metragem.png" alt="Metragem">
					                                                <span><?=$linha['tamanho']?></span>
					                                            </div>

					                                        <?php }else{ ?>
					                                        	<div>
					                                                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/dormitorios.png" alt="Salas Comerciais">
					                                                <span><?=$linha['qtos']?></span>
					                                            </div>

					                                            <div>
					                                                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/metragem.png" alt="Metragem">
					                                                <span><?=$linha['tamanho']?></span>
					                                            </div>

					                                            <div>
					                                                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/garagem.png" alt="Garagem">
					                                                <span><?=$linha['vagas']?></span>
					                                            </div>
					                                        <?php } ?>
				                                        </div>

				                                        <div class="texto-empreendimento hidden-xs">
				                                        	<p>
				                                        	<?=substr(strip_tags($linha['descricao']),0,200)?>...
				                                        	</p>
				                                        </div>

				                                        <div class="preco visible-sm visible-xs">
															<?php if($linha['vendas'] == 1){ ?>
		                                                        <span>A partir de</span>
																<b>R$</b>
																<strong><?=number_format($linha['valor'], 2, ',', '.')?></strong>

		                                                    <?php }else{ ?>
		                                                        <span>100%</span>
		                                                        <strong>Vendido</strong>
		                                                    <?php } ?>

														</div>

													    <a href="<?php echo CONFIG_PATH; ?>/<?=$linha['url']?>/" class="btn-saiba-mais visible-xs">Saiba Mais</a>

				                                    </div>
				                                </div>
		        							</div>
		        						</div>
	        						</div>

									<div class="col-md-4 hidden-sm hidden-xs">
										<div class="direita">
											<div class="preco">
												<?php if($linha['vendas'] == 1){ ?>
                                                    <span><?=$linha['valor_label']?></span>
													<b>R$</b>
													<strong><?=number_format($linha['valor'], 2, ',', '.')?></strong>

                                                <?php }else{ ?>
                                                    <span>100%</span>
                                                    <strong>Vendido</strong>
                                                <?php } ?>
											</div>

											<div class="link">
												<a href="javascript:;" data-toggle="modal" data-target="#modal_atendimento_online" onClick="corretor_online('<?=$linha['atendimento_online_id']?>','<?=$_SESSION['sigla_estado']?>');">
									                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/atendimento.png" alt="Atendimento Online">
									                <div>
									                    <span>Atendimento</span>
									                    <strong>Online</strong>
									                </div>
									            </a>
											</div>

											<div class="link">
												<a href="javascript:;" data-toggle="modal" data-target="#modal_atendimento_email">
									                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/email.png" alt="Atendimento por email">
									                <div>
									                    <span>Atendimento</span>
									                    <strong>Por E-mail</strong>
									                </div>
									            </a>
											</div>

											<div class="link">
												<a href="tel:+55<?=$this->configuracoes['telefone2']?>">
									                <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/icons/telefone.png" alt="Ligue agora">
									                <div>
									                    <span>Ligue agora</span>
									                    <strong><?=$this->configuracoes['telefone']?></strong>
									                </div>
									            </a>
									        </div>
										</div>
	        						</div>
		        				</article>
	        				<?php } ?>

	        			<?php }else{ ?>
	        				<div id="box-sem-imovel">
	        					<i class="glyphicon glyphicon-alert"></i><br />
	        					<strong>Nenhum imóvel encontrado com os termos buscados.</strong><br />
	        					<p>Entre em contato conosco através dos nossos canais de venda e ajudaremos a encontrar o imóvel que procura.</p>
	        				</div>
	        			<?php } ?>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</section>
