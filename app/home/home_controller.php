<?php

/**
* Home
*/
class Home extends Controller{

	public function __construct(){
		parent::__construct();
	}

    public function index(){
    	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST)){
			$this->model->cadastroEmail($_POST);
			$this->view->notificacao = $this->model->log;
		}

    	$this->view->title = 'Dal Col Carnes';

        // BANNERS PRINCIPAIS
		$this->view->BannersPrincipais = $this->model->getBannersPrincipais();

		// PARCEIROS
		include "app/parceiros/parceiros_model.php";
		$parceiros_model = new Parceiros_Model();
		$this->view->Parceiros = $parceiros_model->getListHome();

		// PRODUTOS
		include "app/produtos/produtos_model.php";
		$produtos_model = new Produtos_Model();
		$this->view->Produtos = $produtos_model->getList();

		// VIDEO
		$video = $this->model->getVideo();
		$this->view->video = $video['video'];

        $this->view->render('_includes/header');
        $this->view->render('home/views/home.tpl');
        $this->view->render('_includes/footer');
    }
}