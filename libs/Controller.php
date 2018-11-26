<?php

/**
* Controller
*/
class Controller {

    public function __construct(){
        $this->view = new View();
    }

    /**
     *
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name){
        $path = 'app/'.$name .'/'. $name.'_model.php';

        if(file_exists($path)){
            require $path;

            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }
    }

    public function setPaginacao($pagina_atual, $num_paginas, $total_registros, $num_por_pagina, $parametrosGet){

        if (!empty($parametrosGet)) {
            $parametrosGet = $parametrosGet . '&';
        }else{
            $parametrosGet = '?';
        }

        $ultima_pagina = ceil($total_registros / $num_por_pagina);

        $paginacao = '';

        if ($ultima_pagina > 1) {

            if ($this->pagina == 1) {
                $paginacao .= '<li class="page-item disabled">
                                    <a class="page-link" href="javascript:;">&laquo;</a>
                                </li>';
            }else{
                $paginacao .= '<li class="page-item">
                                    <a class="page-link" href="'.$parametrosGet.'pagina='.($pagina_atual-1).'">&laquo;</a>
                                </li>';
            }


            if ($ultima_pagina < 5) {
                $loop_first = 1;
            }else{
                if ($pagina_atual <= 2) {
                    $loop_first = 1;
                }else{
                    if (($ultima_pagina - $pagina_atual) == 0) {
                        $loop_first = $pagina_atual - 4;
                    }elseif (($ultima_pagina - $pagina_atual) == 1) {
                        $loop_first = $pagina_atual - 3;
                    }else{
                        $loop_first = $pagina_atual - 2;
                    }
                }
            }

            if ($pagina_atual >= ($ultima_pagina - 2)) {
                $loop_last = $ultima_pagina;
            }else{
                if ($pagina_atual < 4) {
                    if ($ultima_pagina > 5) {
                        $loop_last = 5;
                    }else{
                        $loop_last = $ultima_pagina;
                    }
                }else{
                    $loop_last = $pagina_atual + 2;
                }
            }

            for ($i=$loop_first; $i <= $loop_last; $i++) {

                $paginacao .= '<li class="page-item '.($i == $pagina_atual ? 'active' : '').'"><a class="page-link" href="'.$parametrosGet.'pagina='.$i.'">'.$i.'</a></li>';

            }


            if ($ultima_pagina == $pagina_atual) {
                $paginacao .= '<li class="page-item disabled">
                                    <a class="page-link" href="javascript:;">&raquo;</a>
                                </li>';
            }else{
                $paginacao .= '<li class="page-item">
                                    <a class="page-link" href="'.$parametrosGet.'pagina='.($pagina_atual+1).'">&raquo;</a>
                                </li>';
            }
        }

        return $paginacao;

    }

}