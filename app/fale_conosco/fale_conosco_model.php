<?php

class Fale_Conosco_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function run($data){
        $notificacao = array();

        $sql = $this->db->insert('fale_conosco', array(
            'data'      => date('Y-m-d H:i:s'),
            'assunto'   => $data['input_assunto'],
            'nome'      => $data['input_nome'],
            'email'     => $data['input_email'],
            'telefone'  => $data['input_telefone'],
            'mensagem'  => $data['input_mensagem']
        ));

        if($sql){
            $assunto = $this->getInfoAssunto($data['input_assunto']);

            include "PHPMailer_v5.1/class.phpmailer.php";
            $mail = new PHPMailer();
            $mail->IsHTML(true);

            $mail->SetFrom($data['input_email'],utf8_decode($data['input_nome']));

            
			if(!DEV){
				//$mail->AddAddress($assunto['email'],$assunto['nome']);
	           /*
 $mail->AddAddress('dalcoladm@gmail.com','ADM - Dal Col Carnes');
	            $mail->AddAddress('elidiovendas@gmail.com','Elidio');
	            $mail->AddBCC('marcus@pixerama.com.br','Marcus');
	            $mail->AddBCC('olyvia@pixerama.com.br','Olyvia');
	            $mail->AddBCC('mariana@pixerama.com.br','Mariana');
	            $mail->AddBCC('andre@rdweb.com.br','André');
	            $mail->AddBCC('thiago@pixerama.com.br','Thiago');
*/
            }else{
	            $mail->AddAddress('thainam@rdweb.com.br','Thainam Zorzal');
            }
            $mail->Subject = utf8_decode("Contato pelo site - Dal Col Carnes");
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
                                                            Contato pelo site - Dal Col Carnes
                                                        </strong><br />
                                                        <br />

                                                        <fieldset style='border:1px solid #ccc; margin-top:20px;'>
                                                            <legend style='font-weight:bold; color:#CE1212;'>Dados</legend>
                                                            <strong>Data: </strong>".date('d/m/Y H:i:s')."<br />
                                                            <br />
                                                            <strong>Assunto: </strong>".$assunto['nome']."<br />
                                                            <strong>Nome:</strong> ".$data['input_nome']." <br />
                                                            <strong>Email:</strong> ".$data['input_email']." <br />
                                                            <strong>Telefone:</strong> ".$data['input_telefone']." <br />
                                                        </fieldset>

                                                        <fieldset style='border:1px solid #ccc; margin-top:20px;'>
                                                            <legend style='font-weight:bold; color:#CE1212;'>Mensagem:</legend>
                                                            ".nl2br($data['input_mensagem'])."
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

            $notificacao['title'] = "";
            $notificacao['description']  = "Contato enviado com sucesso!";
            $notificacao['type'] = "success";

        }else{
            $notificacao['title'] = "";
            $notificacao['description']  = "Ocorreu um erro ao tentar enviar a mensagem!";
            $notificacao['type'] = "error";
        }

        return $notificacao;
    }


    function getAssuntos(){
        return $this->db->select('SELECT id,nome FROM fale_conosco_assuntos ORDER BY nome ASC');
    }


    function getInfoAssunto($id){
        return $this->db->selectSingle('SELECT id,nome,email FROM fale_conosco_assuntos WHERE id = :id', array(':id' => $id));
    }
}