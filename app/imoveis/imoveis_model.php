<?php

class Imoveis_Model extends Model{
    public $array_condicoes = array();
    public $condicao_palavra_chave = '';

    public function __construct(){
        parent::__construct();
    }


    public function getCondicaoFiltro($url){
        $condicao = '';
        $count_tipo = 0;
        $count_cidade = 0;

        $parametros = end(explode('imoveis/',$url));

        $filtros = explode('/',$parametros);
        $filtros = array_filter($filtros);

        $this->array_condicoes = $filtros;

        if(!empty($filtros)){
            foreach($filtros as $linha){
                $dados_filtro = $this->db->selectSingle("SELECT * FROM view_empreendimento_filtro WHERE url=:url",array(':url' => $linha));
                $condicao .= " AND ".$dados_filtro['campo']."='".$dados_filtro['valor']."' ";
            }
        }

        return $condicao;
    }

    public function setPalavraChave($palavra){
        $palavra = addslashes($palavra);

        $this->condicao_palavra_chave = " AND (
            nome LIKE '%".$palavra."%' OR
            descricao LIKE '%".$palavra."%' OR
            detalhes LIKE '%".$palavra."%' OR
            endereco LIKE '%".$palavra."%' OR
            estado_nome LIKE '%".$palavra."%' OR
            cidade_nome LIKE '%".$palavra."%' OR
            tipo_nome LIKE '%".$palavra."%' OR
            qtos LIKE '%".$palavra."%' OR
            suites LIKE '%".$palavra."%' OR
            salas LIKE '%".$palavra."%' OR
            lojas LIKE '%".$palavra."%' OR
            vagas LIKE '%".$palavra."%'
        ) ";
    }

    public function runLocationPost($array){
        $url = '';

        if(!empty($array['input_busca_tipo'])){
            foreach($array['input_busca_tipo'] as $linha){
                $dados = $this->db->selectSingle("SELECT * FROM empreendimento_tipo WHERE id=:id",array(':id' => $linha));
                $url .= $dados['slug_nome'].'/';
            }
        }

        if(!empty($array['input_busca_cidades'])){
            foreach($array['input_busca_cidades'] as $linha){
                $dados = $this->db->selectSingle("SELECT * FROM cidade WHERE id=:id",array(':id' => $linha));
                $url .= $dados['slug_nome'].'/';
            }
        }

        if(!empty($_POST['palavra_chave'])){
            $url .= '?palavra_chave='.$_POST['palavra_chave'];

        }
        header('Location: '.CONFIG_PATH.'/imoveis/'.$url);
    }


    public function getArrayFiltros(){
        return $this->array_condicoes;
    }


    public function getList($condicao = ''){
        if(!empty($_SESSION['estado'])){
            $condicao .= " AND estado_id='".$_SESSION['estado']."' ";
        }

        return $this->db->select("SELECT * FROM view_empreendimento WHERE id=id ".$condicao." ".$this->condicao_palavra_chave." ORDER BY ordem ASC");
    }


    public function getInfo($id){
        return $this->db->selectSingle("SELECT * FROM view_empreendimento WHERE id=:id",array(':id' => $id));
    }


    public function getFotos($id_imovel){
        return $this->db->select("SELECT id,legenda,imagem FROM empreendimento_foto WHERE empreendimento_id=:id ORDER BY ordem ASC",array(':id' => $id_imovel));
    }


    public function getPlantas($id_imovel){
        return $this->db->select("SELECT id,legenda,imagem FROM empreendimento_planta WHERE empreendimento_id=:id ORDER BY ordem ASC",array(':id' => $id_imovel));
    }

    public function setViewImovel($id_imovel){
        $info = $this->getInfo($id_imovel);

        $dados = array(
            'n_visualizacoes' => ($info['n_visualizacoes'] + 1)
        );

        $this->db->update('empreendimento',$dados,"id='".$id_imovel."'");
    }
}