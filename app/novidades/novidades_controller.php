<?php

/**
* Dicas
*/

class Novidades extends Controller{
	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		$explode = explode('/',$_GET['url']);
		
		if(abs($explode[1]) > 0){
			$this->detalhes($explode[1]);
			return false;
		}

		$this->view->title = 'Novidades | Dal Col Carnes';

		$this->view->registros = $this->model->getList();

		$this->view->render('_includes/header');
        $this->view->render('novidades/views/novidades.tpl');
        $this->view->render('_includes/footer');
	}

	public function detalhes($id){
		$info = $this->model->getInfo($id);
		$this->view->info = $info;
		$this->view->outras_noticias = $this->model->getOutrasNoticias($id);


		$this->view->title = $info['titulo'].' | Dal Col Carnes';

		$this->view->SEO['title'] = $info['titulo'].' | Dal Col Carnes';
		$this->view->SEO['description'] = substr(strip_tags($info['texto']),0,200);
		$this->view->SEO['image'] = CONFIG_PATH.'/painel/arquivos/noticias/'.$info['arquivo'];


        $this->view->render('_includes/header');
        $this->view->render('novidades/views/novidades_detalhes.tpl');
        $this->view->render('_includes/footer');

        if(!empty($this->view->notificacao)){
    		$this->view->render('_includes/notificacao');
	    }
	}
}