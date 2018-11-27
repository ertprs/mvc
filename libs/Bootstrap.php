<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;

    private $_controller_suffix = '_controller'; // sempre inclui uma barra no final
    private $_model_suffix = '_model'; // sempre inclui uma barra no final
    private $_errorFile = 'app/error/error';
    private $_defaultFile = 'app/home/home';

    /**
    * Inicia o Bootstrap
    *
    * @return boolean
    */
    public function init()
    {
        // Define o $_url protegido
        $this->_getUrl();

        $_GET['parametros'] = $this->_url;

        // Carrega o controlador padrão se nenhum URL estiver definido
        // http://localhost carrega o Controlador Padrão
        if(empty($this->_url[0])){
            $this->_loadDefaultController();
            return false;
        }


        if($this->_loadExistingController() == false){
            require "libs/Model.php";
            $model = new Model();
            $alias_controller = $model->verificaURL($this->_url[0]);

            if($alias_controller){
                $this->_loadExistingController($alias_controller);
                $this->_callControllerMethod();

            }else{
                $this->_error();
                return false;
            }

        }else{
            $this->_callControllerMethod();
        }
    }


    /**
     * (Opcional) Defina um caminho personalizado para o arquivo de erros
     * @param string $path Use o nome do arquivo do seu controlador, por exemplo: error.php
     */
    public function setErrorFile($path)
    {
        $this->_errorFile = trim($path, '/');
    }

    /**
     * (Opcional) Defina um caminho personalizado para o arquivo de erros
     * @param string $path Use o nome do arquivo do seu controlador, por exemplo: error.php
     */
    public function setDefaultFile($path)
    {
        $this->_defaultFile = trim($path, '/');
    }

    /**
     * Busca o $_GET de 'url'
     */
    private function _getUrl()
    {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }

    /**
     * Isso carrega se não houver nenhum parâmetro GET passado
     */
    private function _loadDefaultController()
    {
        require $this->_defaultFile.$this->_controller_suffix.'.php';
        $this->_controller = new Home();
        $this->_controller->loadModel('home');
        $this->_controller->index();
    }

    /**
    * Carrega um controlador existente se houver um parâmetro GET passado
    *
    * @return boolean|string
    */
    private function _loadExistingController($url = false){
        $return = false;

        // Exceção de URL para as páginas de imóveis, listagens e detalhes
        if(!empty($url)){
            $this->_url[0] = $url;
        }

        $url_controller = $this->_url[0];

        $controller_name = str_replace('-', '_', $url_controller);
        $file = 'app/'.$controller_name.'/'.$controller_name.$this->_controller_suffix.'.php';

        if(file_exists($file)){
            require $file;

            $controller_name2 = ucfirst($controller_name);
            $this->_controller = new $controller_name2;
            $this->_controller->loadModel($controller_name);

            $return = true;
        }

        if(empty($url)){
            return $return;
        }
    }

    /**
     * Se um método é passado no parâmetro url GET
     *
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */

    private function _callControllerMethod(){
        $length = count($this->_url);

        // Exceção de URL para as páginas de imóveis, listagens e detalhes

        $_GET['secao'] = $this->_url[0];

        switch ($this->_url[0]) {
            case 'produtos':

                if (isset($this->_url[2]) && !empty($this->_url[2])) {
                    $method = 'detalhes';
                }
            break;

            default:
                if (isset($this->_url[1]) && !empty($this->_url[1])) {
                    $method = $this->_url[1];
                }
            break;
        }

        // Certifica-se de que o método que estamos chamando existe
        if ($length > 1) {
            if(!method_exists($this->_controller, $method)){
                $this->_controller->index();
            }
        }


        // Determina o que carregar
        switch($length){
            case 5:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$method}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;

            case 4:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$method}($this->_url[2], $this->_url[3]);
                break;

            case 3:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$method}($this->_url[2]);
                break;

            case 2:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$method}();
                break;

            default:
                $this->_controller->index();
                break;
        }
    }

    /**
     * Exibe uma página de erro, se nada existir
     *
     * @return boolean
     */
    private function _error() {
        require $this->_errorFile.$this->_controller_suffix.'.php';
        $this->_controller = new Error();
        $this->_controller->index();
        exit;
    }

}