<?php

// CONFIG
if($_GET['secao'] == 'comprar'){
    $tabela = "imoveis";
    $condicao2 = " aprovado = 's' AND status = 'disponivel' AND apresentacao <> '' AND  site='sim' AND EXISTS (SELECT 1 FROM imagens WHERE imagens.qual = i.id and imagens.site='sim') ";

}elseif($_GET['secao'] == 'alugar'){
    $tabela = "aluguel";
    $condicao2 = " aprovado = 's' AND status = 'disponivel' AND  apresentacao <> '' AND  site='sim' AND EXISTS (SELECT 1 FROM aluguel_imagens WHERE aluguel_imagens.qual = i.id and aluguel_imagens.site='sim') ";

}elseif($_GET['secao'] == 'lancamentos'){
    $tabela = "lancamentos";
    $condicao2 = " aprovado = 's' AND status = 'disponivel' AND site='sim' AND EXISTS (SELECT 1 FROM lancamentos_imagens WHERE lancamentos_imagens.qual = i.id and lancamentos_imagens.site='sim') ";
}


$num_por_pagina = 9999;


if(is_numeric($_GET['palavra_chave'])){

    $condicoes_palavra_chave = " and id='".abs($_GET['palavra_chave'])."' ";

}else{
    // TIPOS
    $tipos = array();
    $sql_tipos = mysql_query("SELECT id,nome FROM tipos");
    while($linha_tipos = mysql_fetch_assoc($sql_tipos)){
        $tipos[$linha_tipos['id']] = strtolower($linha_tipos['nome']);
    }

    // CIDADES
    $cidades = array();
    echo "SELECT c.id,c.nome FROM ".$tabela." i LEFT JOIN cidades c ON c.id=i.cidade WHERE ".$condicao2." group by c.id ORDER BY c.nome ASC";
    $sql_cidades = mysql_query("SELECT c.id,c.nome FROM ".$tabela." i LEFT JOIN cidades c ON c.id=i.cidade WHERE ".$condicao2." group by c.id ORDER BY c.nome ASC") or die ("Erro 1: ".mysql_error());
    while($linha_cidades = mysql_fetch_assoc($sql_cidades)){
        $cidades[$linha_cidades['id']] = strtolower($linha_cidades['nome']);
    }

    // BAIRROS
    $bairros = array();
    $sql_bairros = mysql_query("SELECT b.id,b.nome FROM ".$tabela." i LEFT JOIN bairros b ON b.id=i.bairro WHERE ".$condicao2." group by b.id ORDER BY b.nome ASC") or die ("Erro 2: ".mysql_error());
    while($linha_bairros = mysql_fetch_assoc($sql_bairros)){
        $bairros[$linha_bairros['id']] = strtolower($linha_bairros['nome']);
    }

    // QUARTOS
    $qtos = array('01' => "1 quarto", '02' => "2 quartos", '03' => "3 quartos", '04' => "4 quartos", '05' => "5 quartos", '06' => "6 quartos", '07' => "7 quartos", '08' => "8 quartos", '09' => "9 quartos");


    // SOL
    $sol = array('manha' => "sol da manha", 'tarde' => "sol da tarde");


    // SUITES
    $suites = array('01' => "1 suite", '02' => "2 suites", '03' => "3 suites", '04' => "4 suites");


    // VARANDAS
    $varandas = array('01' => "1 varanda", '02' => "2 varandas", '03' => "3 varandas");


    // GARAGEM
    $garagem = array('01' => "1 vaga de garagem", '02' => "2 vagas de garagem", '03' => "3 vagas de garagem", '04' => "4 vagas de garagem");


    // PISCINA
    $piscina = array('x' => "piscina");

    // IPTU
    $iptu = array('1' => "iptu");


    // BANHEIROS
    $banheiros = array('01' => "1 banheiro", '02' => "2 banheiros", '03' => "3 banheiros", '04' => "4 banheiros");


    // EXCEÇÕES
    $excecoes = array();
    $sql_excecoes = mysql_query("SELECT palavra,correcao FROM busca_rapida_parametros");
    while($linha_excecoes = mysql_fetch_assoc($sql_excecoes)){
        $excecoes[] = array('palavra_falsa' => $linha_excecoes['palavra'], 'palavra_correta' => $linha_excecoes['correcao']);
    }


    $palavra_chave = $_GET['palavra_chave'];

    // $busca_rapida = new new \BuscaRapida\BuscaRapida();
    $busca_rapida->setTextoDigitado($palavra_chave);
    $busca_rapida->setDados('tipo',$tipos);
    $busca_rapida->setDados('cidade',$cidades);
    $busca_rapida->setDados('bairro',$bairros);
    $busca_rapida->setDados('qtos',$qtos);
    $busca_rapida->setDados('sol',$sol);
    $busca_rapida->setDados('suites',$suites);
    $busca_rapida->setDados('varandas',$varandas);
    $busca_rapida->setDados('garagem',$garagem);
    $busca_rapida->setDados('piscina',$piscina);
    $busca_rapida->setDados('banheiros',$banheiros);
    $busca_rapida->setDados('iptu',$iptu);
    $busca_rapida->setExcecoes($excecoes);
    $busca_rapida->setCampoTexto('anuncio');

    echo $condicoes_palavra_chave = $busca_rapida->getResultados('string');
}

?>