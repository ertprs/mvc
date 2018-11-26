<?php

class Videos_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getVideos(){
    	$condicao = '';

        if(!empty($_SESSION['estado'])){
            $condicao .= " AND (estado_id='".$_SESSION['estado']."' || estado_id='0') ";
        }else{
            $condicao .= " AND estado_id='0' ";
        }

        return $this->db->select("SELECT id,arquivo,titulo,link FROM video WHERE status='1' ".$condicao." ORDER BY id DESC");
    }
}