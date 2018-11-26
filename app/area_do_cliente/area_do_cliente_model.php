<?php

class Area_Do_Cliente_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getOrcamentos(){
    	return $this->db->select("SELECT id,data,status FROM pedidos WHERE cliente_id = '".$_SESSION['cliente']['id']."' ORDER BY data ASC");
    }

    public function getInfoOrcamento($id){
    	$orcamentos = $this->db->select("SELECT id,data,status FROM pedidos WHERE id = '".$id."' ORDER BY data ASC");

		if(count($orcamentos) > 0){
			foreach($orcamentos as $k => $v){
				$itens = $this->db->select("SELECT (SELECT p.nome FROM produtos p WHERE p.id = itens.produtoId ) AS nome_produto,quantidade FROM itens WHERE PedidoId = ".$orcamentos[$k]['id']." ORDER BY id ASC");

				$orcamentos[$k]['itens'] = $itens;
			}
		}

		return $orcamentos[0];
    }
}