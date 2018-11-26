<?php

/**
* Imoveis
*/

class Imoveis extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if(!empty($_GET['id_imovel'])){
			$this->detalhes();
			return false;
		}

		if(!empty($_POST)){
			$this->model->runLocationPost($_POST);
		}

		$this->view->title = 'Imóveis | Sá Cavalcante';

		if(!empty($_GET['palavra_chave'])){
			$this->model->setPalavraChave($_GET['palavra_chave']);
		}

		$condicoes = $this->model->getCondicaoFiltro($_GET['url']);

		$this->view->array_filtros = $this->model->getArrayFiltros();
		$this->view->registros = $this->model->getList($condicoes);

		$this->view->render('_includes/header');
        $this->view->render('imoveis/views/imoveis.tpl');
        $this->view->render('_includes/footer');
	}

	public function detalhes(){
		$info = $this->model->getInfo($_GET['id_imovel']);
		$this->model->setViewImovel($_GET['id_imovel']);
		$this->view->info = $info;
		$this->view->fotos = $this->model->getFotos($_GET['id_imovel']);
		$this->view->plantas = $this->model->getPlantas($_GET['id_imovel']);

		$_SESSION['id_imovel'] = $info['atendimento_online_id'];

		$this->view->title = $info['nome'].' | Sá Cavalcante';

        $this->view->render('_includes/header');
        $this->view->render('imoveis/views/imoveis_detalhes.tpl');
        $this->view->render('_includes/footer');

        if(!empty($this->view->notificacao)){
    		$this->view->render('_includes/notificacao');
	    }
	}
}