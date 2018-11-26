<?php

/**
* Model
*/
class Model{
	public function __construct(){
		$this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
	}

	public function getEstados(){
		return $this->db->select("SELECT id,nome,slug_nome FROM estado WHERE exists(SELECT 1 FROM view_empreendimento WHERE view_empreendimento.estado_id=estado.id) ORDER BY nome ASC");
	}

	public function getEnderecos(){
		return $this->db->select("SELECT id,localizacao,endereco,bairro,cidade,estado,cep,telefone,fax FROM endereco WHERE status='1' ORDER BY ordem ASC");
	}

	public function getConfiguracoes(){
		return $this->db->selectSingle("SELECT id,telefone,telefone2,whatsapp,email,codigo FROM codigos_site WHERE estado_id='".$_SESSION['estado']."'");
	}

	public function verificaURL($url){
		$info 	= $this->db->selectSingle("SELECT id,tipo,destino FROM view_url WHERE slug_nome=:url LIMIT 1",array(':url' => $url));
		$estado = $this->db->selectSingle("SELECT nome,sigla FROM estado WHERE id=:id LIMIT 1",array(':id' => $info['id']));

		if(empty($info)){
			if($url == 'todos-estados'){
				$_SESSION['estado'] = 0;
				$_SESSION['nome_estado'] = 'Todos estados';
				$_SESSION['sigla_estado'] = '';
				return 'home';

			}else{
				return false;
			}

		}else{
			if($info['tipo'] == 'estado'){
				$_SESSION['estado'] = $info['id'];
				$_SESSION['nome_estado'] = $estado['nome'];
				$_SESSION['sigla_estado'] = $estado['sigla'];

			}elseif($info['tipo'] == 'empreendimento'){
				$_GET['id_imovel'] = $info['id'];
			}

			return $info['destino'];
		}
	}
}