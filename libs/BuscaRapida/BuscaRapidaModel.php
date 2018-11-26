<?php

class BuscaRapidaModel
{
    public function __construct()
    {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    // Tipos
    public function setBuscaTipos(){
        $retorno = array();
        $array = array();
        $array = $this->db->select("SELECT id,nome FROM tipos");
        foreach($array as $linha){
            $retorno[$linha['id']] = strtolower($linha['nome']);
        }
        return $retorno;
    }

    // Cidades
    public function setBuscaCidades($tabela){
        $retorno = array();
        $array = array();
        $array = $this->db->select("SELECT c.id,c.nome FROM ".$tabela." i LEFT JOIN cidades c ON c.id=i.cidade GROUP BY c.id ORDER BY c.nome ASC");
        foreach($array as $linha){
            $retorno[$linha['id']] = strtolower($linha['nome']);
        }
        return $retorno;
    }

    // Bairros
    public function setBuscaBairros($tabela){
        $retorno = array();
        $array = array();

        if (is_array($tabela)) {
            foreach ($tabela as $row) {
                $array += $this->db->select("SELECT b.id,b.nome FROM ".$row." i LEFT JOIN bairros b ON b.id=i.bairro GROUP BY b.id ORDER BY b.nome ASC");
            }
        }else{
            $array = $this->db->select("SELECT b.id,b.nome FROM ".$tabela." i LEFT JOIN bairros b ON b.id=i.bairro GROUP BY b.id ORDER BY b.nome ASC");
        }

        foreach($array as $linha){
            $retorno[$linha['id']] = strtolower($linha['nome']);
        }

        return $retorno;
    }

    // Excecoes
    public function setBuscaExcecoes(){
        $retorno = array();
        $array = array();
        $array = $this->db->select("SELECT palavra,correcao FROM busca_rapida_parametros");
        foreach($array as $linha){
            $retorno[] = array('palavra_falsa' => $linha['palavra'], 'palavra_correta' => $linha['correcao']);
        }
        return $retorno;
    }

    // Qtos
    public function setBuscaQtos(){
        return array('01' => "1 quarto", '02' => "2 quartos", '03' => "3 quartos", '04' => "4 quartos", '05' => "5 quartos", '06' => "6 quartos", '07' => "7 quartos", '08' => "8 quartos", '09' => "9 quartos");
    }

    // Sol
    public function setBuscaSol(){
        return array('manha' => "sol da manha", 'tarde' => "sol da tarde");
    }

    // Suites
    public function setBuscaSuites(){
        return array('01' => "1 suite", '02' => "2 suites", '03' => "3 suites", '04' => "4 suites");
    }

    // Varandas
    public function setBuscaVarandas(){
        return array('01' => "1 varanda", '02' => "2 varandas", '03' => "3 varandas");
    }

    // Garagem
    public function setBuscaGaragem(){
        return array('01' => "1 vaga de garagem", '02' => "2 vagas de garagem", '03' => "3 vagas de garagem", '04' => "4 vagas de garagem");
    }

    // Piscina
    public function setBuscaPiscina(){
        return array('x' => "piscina");
    }

    // Iptu
    public function setBuscaIptu(){
        return array('1' => "iptu");
    }

    // Banheiros
    public function setBuscaBanheiros(){
        return array('01' => "1 banheiro", '02' => "2 banheiros", '03' => "3 banheiros", '04' => "4 banheiros");
    }

}