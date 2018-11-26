<?php

if($_GET['acao'] == 'logar'){
	$login = mysql_real_escape_string($_POST['login']);
	$senha = mysql_real_escape_string($_POST['senha']);

	if(!empty($login) && !empty($senha)){
		$sql_login = mysql_query("SELECT *,(SELECT nome FROM nivel WHERE id=usuario.nivel_id) as nome_nivel FROM usuario WHERE login='".$login."' and status='1'");

		if(mysql_num_rows($sql_login) == 1){
			$dados_login = mysql_fetch_assoc($sql_login);

			if($dados_login['senha'] == md5($senha)){
				$_SESSION['usuario_online'] = $dados_login['id'];
				$_SESSION['nivel_online'] = $dados_login['nivel_id'];
				$_SESSION['dados_usuario_online'] = $dados_login;

				if($dados_login['nivel_id'] != 1 && $dados_login['nivel_id'] != 2){
					$_SESSION['painel_estado'] = $dados_login['estado_id'];
				}

				$permissoes = array();
				$sql_permissoes = "SELECT pagina FROM nivel_permissao WHERE nivel='".$dados_login['nivel_id']."'";
				$sql_permissoes = mysql_query($sql_permissoes);
				while($linha_permissoes = mysql_fetch_assoc($sql_permissoes)){
					$permissoes[$linha_permissoes['pagina']] = 1;
				}

				$_SESSION['permissoes'] = $permissoes;

				echo "<script>location.href = '?secao=orcamentos';</script>";
			}

		}else{
			$mensagem = array(
				'tipo' =>'error',
				'texto' => 'Usuário não encontrado!'
			);
		}

	}else{
		$mensagem = array(
			'tipo' =>'info',
			'texto' => 'Preencha os campos corretamente'
		);
	}
}

?>

<div class="login-box">
	<div class="login-logo">
		<a href="?secao=">
			<img src="<?=$path_painel?>/imagens/logo-login.png" alt="Dal Col Carnes">
			</a>
	</div>

	<div class="login-box-body">
		<p class="login-box-msg">Preencha os campos para iniciar a sessão</p>
		<form action="?acao=logar" method="post">
			<div class="form-group has-feedback">
				<input type="text" name="login" class="form-control" placeholder="Login">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>

			<div class="form-group has-feedback">
				<input type="password" name="senha" class="form-control" placeholder="Senha">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>

			<div class="row">

				<div class="pull-right">
					<div class="col-xs-12">
						<button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat" style="color:<?=$cor3?> !important">Entrar</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="<?=$path_painel?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?=$path_painel?>/bootstrap/js/bootstrap.min.js"></script>

<style>

.login-page, .register-page {
    background: <?=$cor1?>;
}

#btn-login{
	background-color: <?=$cor2?>;
    border-color: <?=$cor2?>;
    color:#000;
}
</style>