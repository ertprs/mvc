<?php

class Trabalhe_Conosco_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function run($data, $arquivo){
        $notificacao = array();

        $curriculo_temp = $arquivo["tmp_name"];
        $curriculo_name = tratar_string($arquivo["name"]);

        copy($curriculo_temp, "painel/arquivos/trabalhe_conosco/".$curriculo_name);

        $sql = $this->db->insert('trabalhe_conosco', array(
            'data' => date('Y-m-d H:i:s'),
            'nome'          => $data['input_nome'],
            'email'         => $data['input_email'],
            'telefone'      => $data['input_telefone'],
            'curriculo'     => $curriculo_name,
            'obs'           => $data['input_telefone']
        ));

        if($sql){
            include "PHPMailer_v5.1/class.phpmailer.php";
            $mail = new PHPMailer();
            $mail->IsHTML(true);
            $mail->setFrom($data['input_email'], $data['input_nome']);
            
            if(!DEV){
	            $mail->AddAddress('dalcoladm@gmail.com','ADM - Dal Col Carnes');
	            $mail->AddAddress('elidiovendas@gmail.com','Elidio');
	            $mail->AddBCC('marcus@pixerama.com.br','Marcus');
	            $mail->AddBCC('olyvia@pixerama.com.br','Olyvia');
	            $mail->AddBCC('mariana@pixerama.com.br','Mariana');
	            $mail->AddBCC('andre@rdweb.com.br','André');
	            $mail->AddBCC('thiago@pixerama.com.br','Thiago');
            }else{
	            $mail->AddAddress('thainam@rdweb.com.br','Thainam Zorzal');
            }
            
            $mail->Subject = utf8_decode("Trabalhe conosco pelo site - Dal Col Carnes");
            $mail->Body = utf8_decode("
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
            <title>Dal Col Carnes</title>
            </head>
            <body bgcolor='#FFFFFF'>
                <table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'  bgcolor='#FFFFFF'>
                    <tr>
                        <td align='center' valign='middle'>
                            <table width='600' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' >
                                <tr>
                                    <td>
                                        <a href='".CONFIG_PATH."' target='_blank'>
                                            <img src='".CONFIG_PATH_PUBLIC."/img/carta/topo.jpg'
                                             width='600' height='166'  border='0'  />
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
                                                            Trabalhe Conosco pelo site - Dal Col Carnes
                                                        </strong><br />
                                                        <br />

                                                        <fieldset style='border:1px solid #ccc; margin-top:20px;'>
                                                            <legend style='font-weight:bold; color:#1B74BB;'>Dados</legend>
                                                            <strong>Data: </strong>".date('d/m/Y H:i:s')."<br />
                                                            <strong>Nome: </strong>".$data['input_nome']." <br />
                                                            <strong>Email: </strong>".$data['input_email']." <br />
                                                            <strong>Telefone: </strong>".$data['input_telefone']." <br />
                                                            <strong>Currículo: </strong><a href='".CONFIG_PATH_PAINEL."/arquivos/trabalhe_conosco/".$curriculo_name."' target='blank'>Visualizar currículo</a> <br />
                                                            <br />
                                                            <strong>Telefone: </strong><br />
                                                            ".$data['input_obs']." <br />
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
            $notificacao['description']  = "Currículo enviado com sucesso!";
            $notificacao['type'] = "success";

        }else{
            $notificacao['title'] = "";
            $notificacao['description']  = "Não foi possível enviar o seu currículo!";
            $notificacao['type'] = "error";
        }

        return $notificacao;
    }
}