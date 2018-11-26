<?php

class Novidades_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getList($limite = 10){
        return $this->db->select("SELECT id,data,arquivo,titulo,subtitulo,texto FROM noticia WHERE status='1' AND arquivo<>'' ORDER BY data DESC, id DESC LIMIT ".$limite);
    }

    public function getOutrasNoticias($noticia_atual){
        return $this->db->select("SELECT id,data,arquivo,titulo,subtitulo,texto FROM noticia WHERE status='1' AND arquivo<>'' and id<>:noticia_atual ORDER BY data DESC, id DESC LIMIT 3",array(':noticia_atual' => $noticia_atual));
    }

    public function getInfo($id){
        return $this->db->selectSingle("SELECT * FROM noticia WHERE id=:id AND status='1' AND arquivo<>''",array(':id' => $id));
    }
}