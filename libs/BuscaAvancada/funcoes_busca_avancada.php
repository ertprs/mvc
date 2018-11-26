<?php

function html_box_opcoes_busca($dados,$array,$tipo='checkbox'){
	$fechar_div_mais_opcoes = 0;

	$retorno = "
	<div class='box-busca'>
		<strong>".$dados['title']."</strong>

		<div class='container-busca'>";

		if($tipo == 'radio'){
			$retorno .= "
			<label for='".$dados['name']."0'>
				<input id='".$dados['name']."0' name='".$dados['name']."[]' value='' class='checkbox' type='".$tipo."' />
				<span>Todos</span>
			</label>
			";
		}

		$i = 1;
			foreach($dados['content'] as $linha){

				if(!empty($array)){
					if(in_array($linha['url'], $array)) {
						$checked = 'checked';
					}else{
						$checked = '';
					}
				}else{
					$checked = '';
				}

				$retorno .= "
				<label for='".$dados['name'].$linha['id']."'>
					<input id='".$dados['name'].$linha['id']."' name='".$dados['name']."[]' value='".$linha['value']."' class='checkbox' type='".$tipo."' ".$checked." />
					<span>".$linha['label']."</span>
				</label>
				";

				if($i == $dados['num_options']){
					$fechar_div_mais_opcoes = 1;
					$retorno .= "<div class='container-mais-opcoes f-close' id='container-opcoes-".$dados['name']."'>";
				}

				$i++;
			}

			if($fechar_div_mais_opcoes == 1){
				$retorno .= "</div>";
			}

			$retorno .= "
		</div>
		";

		if(count($dados['content']) > $dados['num_options']){
			$retorno .= "<a href='javascript:;' data-container='container-opcoes-".$dados['name']."' class='btn btn-mais-opcoes f-close' onClick='exibeMaisOpcoesBusca(this);'>+ Mais opções</a>";
		}

	$retorno .= "
	</div>
	";

	return $retorno;
}

?>