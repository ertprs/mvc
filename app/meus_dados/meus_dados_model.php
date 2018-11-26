<?php

class Meus_Dados_Model extends Model{
	public $log = array();

    public function __construct(){
        parent::__construct();
    }


    /* #### CADASTRAR #### */
	public function atualizar($dados){
    	$nome		= addslashes($dados['nome']);
		$email		= addslashes($dados['email']);
		$cpf		= addslashes($dados['cpf']);
		$telefone	= addslashes($dados['telefone']);

		if(empty($nome)){
			$this->log = array(
				'type' => 'danger',
				'title' => "",
				'description' => "O campo 'Nome' deve ser preenchido!"
			);

			return false;

		}else if(empty($email)){
			$this->log = array(
				'type' => 'danger',
				'title' => "",
				'description' => "O campo 'E-mail' deve ser preenchido!"
			);

			return false;

		}else if(empty($telefone)){
			$this->log = array(
				'type' => 'danger',
				'title' => "",
				'description' => "O campo 'Telefone' deve ser preenchido!"
			);

			return false;

		}else{
			$campos_atualizar = array(
		        'nome'      => $dados['nome'],
		        'email'     => $dados['email'],
		        'telefone'  => $dados['telefone']
			);

			if(!empty($dados['senha'])){
				$campos_atualizar['senha'] = md5($dados['senha']);
			}

			if($this->db->update('clientes', $campos_atualizar, " id='".$_SESSION['cliente']['id']."'")){
				$this->log = array(
					'type' 	=> 'success',
					'title' => "",
					'description' => "Seus dados foram alterados com sucesso!"
				);

				return true;

			}else{
				$this->log = array(
					'type' => 'danger',
					'title' => "",
					'description' => "Ocorreu um problema ao atualizar seus dados!"
				);

				return false;
			}
		}
    }
}