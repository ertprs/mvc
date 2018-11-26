<?php

class Parceiros_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getList(){
        return $this->db->select("SELECT id,nome,link,logo FROM parceiros WHERE logo<>'' ORDER BY ordem ASC");
    }

    public function getListHome(){
        return $this->db->select("SELECT id,nome,link,logo FROM parceiros WHERE logo<>'' ORDER BY ordem ASC");
    }

    public function getInfo($url){
        return $this->db->selectSingle("SELECT id,nome,link,logo FROM parceiros WHERE link='".$url."' LIMIT 1");
    }
}