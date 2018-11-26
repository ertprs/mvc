<?php

class Financiamento_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getFinanciamento()
    {
        return $this->db->selectSingle("SELECT id, texto FROM financiamento ORDER BY data_atualizacao DESC LIMIT 3");
    }
}