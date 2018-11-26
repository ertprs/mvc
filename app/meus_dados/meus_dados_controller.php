<?php

class Meus_Dados extends Controller{

	public function __construct(){
		parent::__construct();

        if(empty($_SESSION['cliente'])){
            header('Location: '.CONFIG_PATH.'/login/'.(!empty($_GET['fin']) ? '?fin=1' : ''));
        }
	}


    public function index(){
        if(!empty($_POST) && $_GET['acao'] == 'atualizar'){
            $this->model->atualizar($_POST);
            $this->view->notificacao = $this->model->getLog();
        }

        include "app/cadastro_cliente/cadastro_cliente_model.php";
        $cliente = new Cadastro_Cliente_Model();
        $dados_cliente = $cliente->getInfo($_SESSION['cliente']['id']);

        $this->view->dados_cliente = $dados_cliente;

        $this->view->title = 'Cadastro de cliente | Dal Col Carnes';

        $this->view->render('_includes/header');
        $this->view->render('meus_dados/views/meus_dados.tpl');
        $this->view->render('_includes/footer');
    }
}