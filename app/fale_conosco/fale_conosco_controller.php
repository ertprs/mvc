<?php

class Fale_conosco extends Controller{

	public function __construct(){
		parent::__construct();
	}

    public function index(){
    	$this->view->title = 'Fale Conosco | Dal Col Carnes';

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST)) {
        	$this->view->notificacao = $this->model->run($_POST);
        }

        $this->view->assuntos = $this->model->getAssuntos();

        $this->view->render('_includes/header');
        $this->view->render('fale_conosco/views/fale_conosco.tpl');
        $this->view->render('_includes/footer');
    }
}