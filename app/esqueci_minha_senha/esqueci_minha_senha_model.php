<?php

class Esqueci_Minha_Senha_Model extends Model{
    public $log = array();

    public function __construct(){
    	parent::__construct();
    }

    /* #### LOGIN #### */
	public function enviarNovaSenha($dados){
		$email = addslashes($dados['email']);

		$verifica_cliente = $this->db->selectSingle("SELECT id,email,nome FROM clientes WHERE email='".$email."'");

		if(empty($verifica_cliente)){
			return false;

		}else{
	    	$nova_senha = rand(111111,999999);

    		$dados_update = array('senha' => md5($nova_senha));

	    	$this->db->update('clientes', $dados_update, " id='".$verifica_cliente['id']."'");

    		include "PHPMailer_v5.1/class.phpmailer.php";
            $mail = new PHPMailer();
            $mail->IsHTML(true);

            $mail->SetFrom('dalcoladm@gmail.com','Dal Col Carnes');
			
            if(!DEV){
	            $mail->AddAddress($verifica_cliente['email'],$verifica_cliente['nome']);
            }else{
	            $mail->AddAddress('thainam@rdweb.com.br','Thainam Zorzal');
            }

            $mail->Subject = utf8_decode("Nova senha de cliente - Dal Col Carnes");
            $mail->Body = utf8_decode("
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
            <title>Dal Col Carnes</title>
            </head>
            <body bgcolor='#272727'>
                <table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'  bgcolor='#272727'>
                    <tr>
                        <td align='center' valign='middle'>
                            <table width='600' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' >
                                <tr>
                                    <td>
                                        <a href='".CONFIG_PATH."' target='_blank'>
                                            <img src='".CONFIG_PATH_PUBLIC."/img/carta/topo.jpg' width='600' height='124' border='0' />
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td background='".CONFIG_PATH_PUBLIC."/img/carta/meio.jpg'>
                                        <table width='100%' border='0' cellspacing='0' cellpadding='35'>
                                            <tr>
                                                <td>
                                                    <font size='2' face='Tahoma' color='#000000'>

                                                        <strong>
                                                            Nova senha de cliente - Dal Col Carnes
                                                        </strong><br />
                                                        <br />

                                                        <fieldset style='border:1px solid #ccc; margin-top:20px;'>
                                                            <legend style='font-weight:bold; color:#000;'>Dados</legend>

                                                            Uma nova senha foi gerada para seu acesso de cliente ao site da Dal Col Carnes.<br />
                                                            <br />
                                                            <strong>Link: </strong>".CONFIG_PATH_PUBLIC."/login/<br />
                                                            <br />
                                                            <strong>Email: </strong>".$verifica_cliente['email']."<br />
                                                            <strong>Senha:</strong> ".$nova_senha." <br />
                                                        </fieldset>
                                                        <br />
                                                    </font>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td valign='bottom'>
                                        <img src='".CONFIG_PATH_PUBLIC."/img/carta/rodape.jpg'
                                         width='600' height='30' />
                                    </td>
                                </tr>
                            </table>
                            <br>
                        </td>
                    </tr>
                </table>
            </body>
            </html>");

            $mail->Send();
    	}

		return true;
    }
}