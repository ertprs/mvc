<?php

class Area_Do_Cliente extends Controller{

	function __construct(){
		parent::__construct();

        if(empty($_SESSION['cliente'])){
            header('Location: '.CONFIG_PATH.'/login/'.(!empty($_GET['fin']) ? '?fin=1' : ''));
        }
	}

    function index(){
        if($_GET['msg'] == 1){
            $this->view->notificacao = array(
                'type' => 'success',
                'title' => 'Bem vindo(a)',
                'description' => 'Seu cadastro foi realizado com sucesso!'
            );
        }

    	$this->view->orcamentos = $this->model->getOrcamentos();

        $this->view->title = 'Área do cliente | Dal Col Carnes';

        $this->view->render('_includes/header');
        $this->view->render('area_do_cliente/views/area_do_cliente.tpl');
        $this->view->render('_includes/footer');
    }

    function detalhes(){
        $this->view->info = $this->model->getInfoOrcamento($_GET['parametros'][2]);

        $this->view->title = 'Área do cliente | Dal Col Carnes';

        $this->view->render('_includes/header');
        $this->view->render('area_do_cliente/views/orcamento_detalhes.tpl');
        $this->view->render('_includes/footer');

    }
}