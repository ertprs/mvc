<?php

/**
* Noticias
*/

class Produtos extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){ 

		// PARCEIROS
		if(!empty($_GET['parametros'][1])){
			include "app/parceiros/parceiros_model.php";
			$parceiros_model = new Parceiros_Model();
			$dados_parceiro = $parceiros_model->getInfo($_GET['parametros'][1]);
			$this->model->filtroBusca(" AND parceiro_id='".$dados_parceiro['id']."' ");
			$this->view->dados_parceiro = $dados_parceiro;
		}

		$this->view->categorias = $this->model->getCategorias();

		$this->view->title = 'Produtos | Dal Col Carnes';

		if(!empty($_GET['palavra_chave'])){
			$this->model->filtroBusca(" AND nome LIKE '%".addslashes($busca)."%' ");
		}

		if(!empty($_GET['categoria'])){
			$this->model->filtroBusca(" AND categoria = '".abs($_GET['categoria'])."%' ");
		}

		$this->view->registros = $this->model->getList();

		$this->view->render('_includes/header');
        $this->view->render('produtos/views/produtos.tpl');
        $this->view->render('_includes/footer');
	}

	public function detalhes(){
		$info = $this->model->getInfo($_GET['parametros'][1]);

		$this->view->title = $info['nome'].' | Dal Col Carnes';
		$this->view->info = $info;
		$this->view->outros_produtos = $this->model->getOutrosProdutos($_GET['parametros'][1]);


        $this->view->render('_includes/header');
        $this->view->render('produtos/views/produtos_detalhes.tpl');
        $this->view->render('_includes/footer');

        if(!empty($this->view->notificacao)){
    		$this->view->render('_includes/notificacao');
	    }
	}
}