<?php

class Home_Model extends Model{
    public $log = array();

    public function __construct(){
        parent::__construct();
    }

    public function cadastroEmail($dados){
        $sql = $this->db->insert('email', array(
            'data'      => date('Y-m-d H:i:s'),
            'nome'      => $dados['nome_news'],
            'email'     => $dados['email_news']
        ));

        if($sql){
            $this->log = array(
                'title'       => "",
                'description' => "Contato enviado com sucesso!",
                'type'        => "success"
            );

            return true;

        }else{
            $this->log = array(
                'title'       => "",
                'description' => "Ocorreu um problema ao cadastrar seu email!",
                'type'        => "error"
            );

            return false;
        }
    }

    public function getBannersPrincipais(){
        return $this->db->select("SELECT id, titulo,link,nova_janela,arquivo FROM banner_principal WHERE status='1' AND arquivo <> '' ORDER BY ordem ASC LIMIT 10");
    }

    public function getVideo(){
        return $this->db->selectSingle("SELECT video FROM a_empresa WHERE id=1");
    }
}