<?php

	/**
	* Grupo Sa Cavalcante
	*/
	class Videos extends Controller{

		function __construct(){
			parent::__construct();
		}

	    function index(){
	        $this->view->title = 'Vídeos | Sá Cavalcante';

	        $this->view->videos = $this->model->getVideos();

            // $this->view->css = array('public/js/slick/slick.css');
            // $this->view->js  = array('public/js/slick/slick.min.js');

	        $this->view->render('_includes/header');
	        $this->view->render('videos/views/videos.tpl');
	        $this->view->render('_includes/footer');
	    }
	}