<?php

class Login extends Controller{

	public function __construct(){
		parent::__construct();
	}

    public function index(){
        if(!empty($_GET['success'])){
            $this->view->notificacao = array(
                'type' => 'success',
                'title' => "",
                'description' => "Uma nova senha foi enviada para o seu email!"
            );
        }

    	if(!empty($_SESSION['cliente'])){
    		header('Location: '.CONFIG_PATH.'/area-do-cliente/');
    	}

    	if(!empty($_POST)){
    		if($this->model->logar($_POST)){
				if(!empty($_GET['fin'])){
					header('Location: '.CONFIG_PATH.'/finalizar/');

				}else{
					header('Location: '.CONFIG_PATH.'/area-do-cliente/');
				}

			}else{
				$this->view->notificacao = $this->model->log;
			}
		}

        $this->view->title = 'Acesso do cliente | Dal Col Carnes';

        $this->view->render('_includes/header');
        $this->view->render('login/views/login.tpl');
        $this->view->render('_includes/footer');
    }

    public function logout(){
    	unset($_SESSION['cliente']);
    	header('Location: '.CONFIG_PATH);
    }
}