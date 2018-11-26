<?php

class Login_Model extends Model{
    public $log = array();

    public function __construct(){
    	parent::__construct();
    }

    /* #### LOGIN #### */
	public function logar($dados){
    	$email	= addslashes($dados['email']);
		$senha	= addslashes($dados['senha']);


		if(empty($email)){
			$this->log = array(
				'type' => 'error',
				'title' => "",
				'description' => "O campo 'E-mail' deve ser preenchido!"
			);

			return false;

		}else if(empty($senha)){
			$this->log = array(
				'type' => 'error',
				'title' => "",
				'description' => "O campo 'Senha' deve ser preenchido!"
			);

			return false;

		}else{
			$dados_cliente = $this->db->selectSingle("SELECT id,nome,email,telefone,senha FROM clientes WHERE email = '".$email."' AND status='1'");

			if(empty($dados_cliente)){
				$this->log = array(
					'type' => 'error',
					'title' => "",
					'description' => "Usuário não encontrado!"
				);

				return false;

			}else{
				if($dados_cliente['senha'] == md5($senha)){
					$_SESSION['cliente'] = $dados_cliente;

					return true;

				}else{
					$this->log = array(
						'type' => 'error',
						'title' => "",
						'description' => "Senha inválida!"
					);

					return false;
				}
			}
		}
    }
}