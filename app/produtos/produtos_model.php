<?php

class Produtos_Model extends Model{
    public $filtro = '';

    public function __construct(){
        parent::__construct();
    }

    public function filtroBusca($busca){ 
    	$this->filtro .= $busca;
    }

    public function getList($limite = 10){
        if(empty($_GET['secao'])){
            $destaque = " AND destaque = '1' ";
        }else{
            $destaque = "";
        }

        $sql = "SELECT id,foto,nome,preco FROM produtos WHERE id=id AND status='1' ".$destaque." ".$this->filtro." ORDER BY status DESC,id DESC LIMIT ".$limite;
        return $this->db->select($sql);
    }

    public function getOutrosProdutos($id){
        return $this->db->select("SELECT id,foto,nome FROM produtos WHERE id<>'".$id."' AND status='1' ORDER BY status DESC,id DESC LIMIT 3");
    }

    public function getCategorias(){
        $sql = "
        SELECT
            id,
            nome,
            (SELECT count(id) FROM produtos WHERE produtos.categoria=produtos_categorias.id AND produtos.status='1') as num_produtos
        FROM
            produtos_categorias
        WHERE

            EXISTS (SELECT 1 FROM produtos WHERE produtos.categoria=produtos_categorias.id AND produtos.status='1')
        ORDER BY
            nome ASC
        ";

        return $this->db->select($sql);
    }

    public function getInfo($id_produto){
        $sql = "
        SELECT
            id,
            foto,
            nome,
            preco,
            descricao,
            categoria,
            parceiro_id,
            (SELECT nome FROM produtos_categorias WHERE produtos_categorias.id=produtos.categoria) as categoria_nome,
            (SELECT nome FROM parceiros WHERE parceiros.id=produtos.parceiro_id) as parceiro_nome
        FROM
            produtos
        WHERE
            status='1' AND
            id='".$id_produto."'
        LIMIT 1";

        return $this->db->selectSingle($sql);
    }
}