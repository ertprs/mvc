<?php

class A_Empresa_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getTexto(){
        return $this->db->selectSingle("SELECT id,texto FROM a_empresa WHERE id='1'");
    }
}