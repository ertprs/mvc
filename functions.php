<?php

function tratar_string($string) {
    $string = str_replace(' ', '-', $string);
    $pattern = array("/ã|á|a|â|a|Á|A|Â|A/", "/é|e|e|E|É|E/", "/í|i|î|I|Í|Î/", "/ó|o|ô|o|Ó|O|Ô|O/", "/ú|u|u|U|Ú|U/", "/Ç|ç/", "/['\]}{\$:\[)(?!;?§*#%@&^~,\/]/");
    $replace = array("a", "e", "i", "o", "u", "c", "");
    $string = preg_replace($pattern, $replace, $string);
    $string = strtolower($string);
    return $string;
}


function url_amigavel($string) {
    $string = str_replace(' ', '-', $string);
    $pattern = array("/ã|á|a|â|a|Á|A|Â|A/", "/é|e|e|E|É|E/", "/í|i|î|I|Í|Î/", "/ó|o|ô|o|Ó|O|Ô|O/", "/ú|u|u|U|Ú|U/", "/Ç|ç/", "/['.\]}{\$:\[)(?!;?§*#%@&^~,\/]/");
    $replace = array("a", "e", "i", "o", "u", "c", "");
    $string = preg_replace($pattern, $replace, $string);
    $string = strtolower($string);
    return $string . '.html';
}

function limitarTexto($texto, $limite, $quebra = true) {
    $tamanho = strlen($texto);

    // Verifica se o tamanho do texto é menor ou igual ao limite
    if ($tamanho <= $limite) {
        $novo_texto = $texto;
        // Se o tamanho do texto for maior que o limite
    } else {
        // Verifica a opção de quebrar o texto
        if ($quebra == true) {
            $novo_texto = trim(substr($texto, 0, $limite)) . '...';
            // Se não, corta $texto na última palavra antes do limite
        } else {
            // Localiza o útlimo espaзo antes de $limite
            $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
            // Corta o $texto até a posiçãгo localizada
            $novo_texto = trim(substr($texto, 0, $ultimo_espaco)) . '...';
        }
    }

    // Retorna o valor formatado
    return $novo_texto;
}

function converte_data($dataz){
    if(strstr($dataz, "/")){
        $A = explode("/",$dataz);
        $V_dataz = $A[2]."-".$A[1]."-".$A[0];
    }else{
        $A = explode("-",$dataz);
        $V_dataz = $A[2]."/".$A[1]."/".$A[0];
    }
    return $V_dataz;
}

function codigo_youtube($url_video){
    $retorno = explode('?v=',$url_video);
    $retorno = reset(explode('&',$retorno[1]));
    return $retorno;
}