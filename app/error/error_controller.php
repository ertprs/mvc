<?php

	/**
	* Error
	*/
	class Error extends Controller
	{

	    function __construct() {
	        parent::__construct();
	    }

	    function index() {
	        $this->view->title = '404 Error';

	        $this->view->render('error/views/error.tpl');
	    }
	}