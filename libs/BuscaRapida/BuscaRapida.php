<?php

class BuscaRapida{
	public $TextoDigitado  = '';
	public $array_tipos_busca = array();
	public $array_valores = array();
	public $array_excecoes = array();
	public $texto_tratado = '';
	public $string_outros = '';
	public $campos_anuncio = array();

	public function removerAcentos($texto){
    	$texto = $texto;
    	$pattern = array("/ã|á|a|â|a|Á|A|Â|A/","/é|e|e|E|É|E/","/í|i|î|I|Í|Î/","/ó|o|ô|o|Ó|O|Ô|O/","/ú|u|u|U|Ú|U/","/Ç|ç/","/['.\]}{\$:\[)(?!;?§*#%@&^~,\/]/");
		$replace = array("a","e","i","o","u","c","");
		$texto = preg_replace($pattern,$replace,$texto);
		return $texto;
	}


	// getBuscaPalavras - Procura as palavras válidas na string informada
	public function getBuscaPalavras($haystack, $needles, $sensitive=false, $offset=0){
		$result2 = array();

		foreach($needles as $key=>$needle){
			$palavra_formatada = $this->removerAcentos($needle);
			$haystack2 = $haystack;
			$haystack = $this->removerAcentos($haystack);

	        $result[$needle] = ($sensitive) ? strpos($haystack, $palavra_formatada, $offset) : stripos($haystack, $palavra_formatada, $offset);

	    	if($result[$needle] === false){
				unset($result[$needle]);

			}else{
				$this->texto_tratado = str_replace($palavra_formatada, '', $this->texto_tratado);
				$result2[] = $key;
			}
	    }
	    return $result2;
	}


	// getBuscaPalavras - Procura as palavras válidas na string informada
	public function removerPalavras($texto, $palavras, $sensitive=false, $offset=0){
	    foreach($palavras as $chave=>$palavra){
			$palavra_formatada = $this->removerAcentos($palavra);

	        $w = ($sensitive) ? strpos($texto, $palavra_formatada, $offset) : stripos($texto, $palavra_formatada, $offset);

	    	if($w === false){
				unset($w);

			}else{
				$texto = str_replace($palavra_formatada, ' ', $texto);
			}
	    }

	    return $texto;
	}


	public function substituirExcecoes(){
		if(!empty($this->array_excecoes)){
	    	foreach($this->array_excecoes as $linha){
				$dados = strpos($this->TextoDigitado, $linha['palavra_falsa'], false);
	    		if($dados !== false){
					$this->TextoDigitado = $this->texto_tratado = str_replace($linha['palavra_falsa'], $linha['palavra_correta'], $this->TextoDigitado);
				}
			}
		}
	}


	// setDados - ADICIONA OS VALORES VÁLIDOS NO VETOR PRINCIPAL
	public function setDados($nome,$valores){
		$this->array_tipos_busca[] = $nome;
		$this->array_valores[$nome] = $valores;
	}


	// setTextoDigitado - INFORMA A STRING QUE FOI PROCURADA
	public function setTextoDigitado($texto){
		$this->TextoDigitado = $this->texto_tratado = strtolower($this->removerAcentos($texto));

	}


	// setExcecao
	/*
	public function setExcecao($palavra_falsa, $palavra_correta){
		$this->array_excecoes[] = array('palavra_falsa' => $palavra_falsa, 'palavra_correta' => $palavra_correta);
	}
	*/

	public function setExcecoes($array){
		$this->array_excecoes = $array;
	}

	public function setCamposTexto($array){
		$this->campos_anuncio = $array;
	}




	public function getOutros(){
		$b = $this->removerPalavras($this->texto_tratado, array(' a ', ' o ', ' e ', ' na ',' no ',' em ',' a ',' o ',' para ',' de ',' do ',' da ', ' com ', ' das ', ' ao '));
		$explode = explode(' ', $b);
		$explode = array_filter($explode);

		$retorno = '';
		if(!empty($explode)){
			$retorno = " AND (";
        	foreach ($this->campos_anuncio as $row) {
        		foreach($explode as $linha){
	            	if(!empty($linha)){
	            		$retorno .= "".$row." LIKE '%".$linha."%' AND ";
	            	}
	            }
	            $retorno = substr($retorno,0,-5)." OR ";
	        }


	        $retorno = substr($retorno,0,-4).") ";
		}

		$this->string_outros .= $retorno;
	}



	// RETORNA TODOS OS RESULTADOS VÁLIDOS PROCURADOS
	public function getResultados($tipo){
		$this->substituirExcecoes();
		$retorno = ($tipo == 'array' ? array() : '');

		if(!empty($this->array_tipos_busca)){
			foreach($this->array_tipos_busca as $linha){

				$retorno_get = '';

				$b = $this->getBuscaPalavras($this->TextoDigitado, $this->array_valores[$linha]);

				if(!empty($b)){
					if($tipo == 'array'){
						$retorno[$linha] = $b;

					}else{
						$retorno .= " and (";
			            foreach($b as $linha_b){
			            	$retorno_get .= $linha_b . ",";
			            	if(!empty($linha_b)){
			            		$retorno .= $linha."='".$linha_b."' or ";
			            	}
			            }
			            $retorno = substr($retorno,0,-4).") ";
					}

					switch ($linha) {
						case 'bairro':
							$get_key = 'bairros';
							break;
						case 'qtos':
							$get_key = 'quartos';
							break;
						default:
							$get_key = $linha;
							break;
					}

					$_GET[$get_key] = rtrim($retorno_get, ",");

				}

			}
		}

		$this->getOutros();

		if(!empty($this->string_outros)){
			if($tipo == 'array'){
				$retorno['outros'] = $this->string_outros;
			}else{
				$retorno .= $this->string_outros;

			}
		}

		return $retorno;
	}



	// RETORNA STRING DE CONDICOES PARA A BUSCA
	public function getCondicoes($palavra_chave, $tabela){

		$retorno = '';

		$this->model = new BuscaRapidaModel();

		if (is_numeric($palavra_chave)) {

			$retorno = " AND id = '".abs($palavra_chave)."' ";

		}else{

			$this->setTextoDigitado($palavra_chave);

		    $this->setDados('cidade',$this->model->setBuscaCidades($tabela));
		    $this->setDados('bairro',$this->model->setBuscaBairros($tabela));

		    $this->setDados('tipo',$this->model->setBuscaTipos());
		    $this->setDados('qtos',$this->model->setBuscaQtos());
		    $this->setDados('sol',$this->model->setBuscaSol());
		    $this->setDados('suites',$this->model->setBuscaSuites());
		    $this->setDados('varandas',$this->model->setBuscaVarandas());
		    $this->setDados('garagem',$this->model->setBuscaGaragem());
		    $this->setDados('piscina',$this->model->setBuscaPiscina());
		    $this->setDados('banheiros',$this->model->setBuscaBanheiros());
		    $this->setDados('iptu',$this->model->setBuscaIptu());
		    $this->setExcecoes($this->model->setBuscaExcecoes());
		    $this->setCamposTexto(array('apresentacao','imovel'));

		    $retorno = $this->getResultados('string');
		}

		return $retorno;
	}


}
?>