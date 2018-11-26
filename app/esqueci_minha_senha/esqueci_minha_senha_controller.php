<?php

class Esqueci_Minha_Senha extends Controller{

	public function __construct(){
		parent::__construct();
	}

    public function index(){
    	if(!empty($_POST)){
    		if($this->model->enviarNovaSenha($_POST)){
				header('Location: '.CONFIG_PATH.'/login/?success=1');

			}else{
				$this->view->notificacao = array(
					'title' => "",
					'description' => "Nenhum cliente foi encontrado com esse email.",
					'type' => "warning"
				);;
			}
		}

        $this->view->title = 'Esqueci minha senha | Dal Col Carnes';

        $this->view->render('_includes/header');
        $this->view->render('esqueci_minha_senha/views/esqueci_minha_senha.tpl');
        $this->view->render('_includes/footer');
    }
}