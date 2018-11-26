<?php

/**
* CSRF
*/
class CSRF {

	private $_token = '';
	private $_csrf = '';

    function __construct($token, $csrf) {

    	$this->_token = $token;
    	$this->_csrf  = $csrf;

        $this->csrf_check();

        if (($_SERVER['REQUEST_METHOD'] == "POST") || empty($this->_csrf)) {
            $this->_csrf = $this->csrf_set();
        }
    }

    /**
     * Generate CSRF
     */
    public function csrf_set() {
            $session = new Session();
            $code = md5(uniqid());
            $session->set('csrf_token', $code);
            return $code;
    }


    /**
     * csrf_check
     *
     * Checa se foi enviado algum Post de Token e o valida com a Sessão atual
     *
     * @param string $token Token
     */
    public function csrf_check() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->_token != $this->_csrf) {
		        header("Location: " . CONFIG_PATH . $_GET['secao']);
		    }
		}

	}

}