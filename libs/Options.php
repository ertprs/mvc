<?php

/**
* Options
*/
class Options{

    function __construct()
    {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    /**
     *
     * @param int Id da cidade, padrao = 2044
     * @return array Array dos bairros
     */
    public function getOptionsBairros($cidade = 2044)
    {
        return $this->db->select("SELECT id,nome FROM bairros WHERE cidade = {$cidade} ORDER BY nome ASC");
    }

    /**
     *
     * @param int Id do estado, padrao = 2044
     * @return array Array das cidades
     */
    public function getOptionsCidades($estado = '1')
    {
        return $this->db->select("SELECT id,nome FROM cidade WHERE estado_id = {$estado} ORDER BY nome ASC");
    }


    public function getOptionsCidadesImoveis($estado,$tipo)
    {
        $sql = "
        SELECT
            id,
            nome
            ".(!empty($estado) ? ",(SELECT sigla FROM estado WHERE estado.id=cidade.estado_id) as sigla " : "")."
        FROM
            cidade
        WHERE
            ".(!empty($estado) ? " estado_id = {$estado} AND " : "")."
            EXISTS(SELECT 1 FROM empreendimento WHERE status='1' AND empreendimento.cidade_id=cidade.id AND empreendimento_tipo_id='".$tipo."')
        ORDER BY nome ASC";

        return $this->db->select($sql);
    }





    /**
     *
     * @return array Array dos estados
     */
    public function getOptionsEstados()
    {
        return $this->db->select("SELECT id,nome,sigla FROM estados ORDER BY nome ASC");
    }

    /**
     *
     * @return array Array dos tipos dos imóveis existentes nas views
     */
    public function getOptionsTipos()
    {
        return $this->db->select("SELECT DISTINCT t.id,t.nome FROM view_prontos p LEFT JOIN tipos t ON t.id = p.tipo
                                  UNION
                                  SELECT DISTINCT t.id,t.nome FROM view_lancamentos l LEFT JOIN tipos t ON t.id = l.tipo");
    }

    /**
     *
     * @return array Array dos quartos dos imóveis (prontos) existentes na view
     */
    public function getOptionsQuartos()
    {
        return $this->db->select("SELECT DISTINCT qtos FROM view_prontos WHERE qtos > 0 ORDER BY qtos ASC");
    }

    /**
     *
     * @return array Array dos assuntos de contato
     */
    public function getOptionsAssuntos($estado_id)
    {
        return $this->db->select("SELECT id,nome,email FROM fale_conosco_assuntos WHERE estado_id = :estado_id", array('estado_id'=>$estado_id));
    }

}