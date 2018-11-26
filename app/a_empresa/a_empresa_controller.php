<?php

	/**
	* Grupo Sa Cavalcante
	*/
	class A_Empresa extends Controller{

		function __construct(){
			parent::__construct();
		}

	    function index(){
	        $this->view->title = 'A empresa | Dal Col Carnes';

	        $this->view->texto = $this->model->getTexto();

	        $this->view->render('_includes/header');
	        $this->view->render('a_empresa/views/a_empresa.tpl');
	        $this->view->render('_includes/footer');
	    }
	}