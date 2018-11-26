<?php

class Cadastro_Cliente extends Controller{

	public function __construct(){
		parent::__construct();
	}

    public function index(){
    	if(!empty($_SESSION['cliente'])){
    		header('Location: '.CONFIG_PATH.'/area-do-cliente/');
    	}

        if(!empty($_POST) && $_GET['acao'] == 'cadastrar'){
            $insert = $this->model->cadastrar($_POST);
            if($insert){
                $dados_cliente = $this->model->getInfo($insert);

                $_SESSION['cliente'] = $dados_cliente;

                if(!empty($_GET['fin']) && $_GET['fin'] == 1){
                    header('Location: '.CONFIG_PATH.'/finalizar/');

                }else{
                    header('Location: '.CONFIG_PATH.'/area-do-cliente/?msg=1');
                }

            }else{
                if(!empty($this->model->log)){
                    $this->view->notificacao = $this->model->log;
                }
            }
        }

        $this->view->title = 'Cadastro de cliente | Dal Col Carnes';

        $this->view->render('_includes/header');
        $this->view->render('cadastro_cliente/views/cadastro_cliente.tpl');
        $this->view->render('_includes/footer');
    }
}