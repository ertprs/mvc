<?php

class Trabalhe_conosco extends Controller{

	public function __construct(){
		parent::__construct();
	}

    public function index(){
    	$this->view->title = 'Trabalhe Conosco | Dal Col Carnes';

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST)) {
        	$this->view->notificacao = $this->model->run($_POST, $_FILES["input_curriculo"]);
        }

        $this->view->render('_includes/header');
        $this->view->render('trabalhe_conosco/views/trabalhe_conosco.tpl');
        $this->view->render('_includes/footer');
    }
}