<?php

class Finalizar extends Controller{
	public function __construct(){
		parent::__construct();

        if(empty($_SESSION['cliente'])){
            header('Location: '.CONFIG_PATH.'/login/?fin=1');
        }
	}

    public function index(){
        if(!empty($_GET['acao']) && $_GET['acao'] == 'final'){
            $this->view->notificacao = $this->model->finalizarPedido($_POST);
        }

    	$this->view->title = 'Finalizar pedido | Dal Col Carnes';

        $this->view->render('_includes/header');
        $this->view->render('finalizar/views/finalizar.tpl');
        $this->view->render('_includes/footer');
    }
}