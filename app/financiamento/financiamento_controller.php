<?php

	/**
	* Financiamento
	*/
	class Financiamento extends Controller
	{

		function __construct()
		{
			parent::__construct();
		}

	    function index()
	    {
	        $this->view->title = 'Financiamento | FV Imóveis';

	        $this->view->getFinanciamento = $this->model->getFinanciamento();

	        $this->view->render('_includes/header_internas');
	        $this->view->render('financiamento/views/financiamento.tpl');
	        $this->view->render('_includes/footer');
	    }
	}