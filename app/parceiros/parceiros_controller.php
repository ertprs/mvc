<?php


class Parceiros extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->view->title = 'Parceiros | Dal Col Carnes';

		$this->view->registros = $this->model->getList();

		$this->view->render('_includes/header');
        $this->view->render('parceiros/views/parceiros.tpl');
        $this->view->render('_includes/footer');
	}
}