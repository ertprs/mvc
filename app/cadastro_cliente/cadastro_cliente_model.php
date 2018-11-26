<?php

class Cadastro_Cliente_Model extends Model{
	public $log = array();

    public function __construct(){
        parent::__construct();
    }

	public function getInfo($id_cliente){
		return $this->db->selectSingle("SELECT id,nome,email,telefone,senha FROM clientes WHERE id='".$id_cliente."' AND status='1'");
    }

    /* #### CADASTRAR #### */
	public function cadastrar($dados){
    	$nome		= addslashes($dados['nome']);
		$email		= addslashes($dados['email']);
		$telefone	= addslashes($dados['telefone']);
		$senha		= addslashes($dados['senha']);

		if(empty($nome)){
			$this->log = array(
				'type' => 'error',
				'title' => "",
				'description' => "O campo 'Nome' deve ser preenchido!"
			);

			return false;

		}else if(empty($email)){
			$this->log = array(
				'type' => 'error',
				'title' => "",
				'description' => "O campo 'E-mail' deve ser preenchido!"
			);

			return false;

		}else if(empty($telefone)){
			$this->log = array(
				'type' => 'error',
				'title' => "",
				'description' => "O campo 'Telefone' deve ser preenchido!"
			);

			return false;

		}else if(empty($senha)){
			$this->log = array(
				'type' => 'error',
				'title' => "",
				'description' => "O campo 'Senha' deve ser preenchido!"
			);

			return false;

		}else{
			$verifica_cliente = $this->db->selectSingle("SELECT id FROM clientes WHERE email='".$email."' AND status='1'");

			if(!empty($verifica_cliente)){
				$this->log = array(
					'type' => 'error',
					'title' => "",
					'description' => "Já existe um cliente com esses dados!"
				);

				return false;

			}else{
				$campos_insert = array(
			        'nome'      => $dados['nome'],
			        'email'     => $dados['email'],
			        'telefone'  => $dados['telefone'],
			        'senha'  	=> md5($dados['senha']),
			        'status'	=> 1
				);

				if($insert = $this->db->insert('clientes', $campos_insert)){
					include "PHPMailer_v5.1/class.phpmailer.php";
		            $mail = new PHPMailer();
		            $mail->IsHTML(true);

		            $mail->SetFrom($dados['email'],utf8_decode($dados['nome']));
					
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

		            $mail->Subject = utf8_decode("Cadastro de cliente - Dal Col Carnes");
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
		                                                            Cadastro de cliente - Dal Col Carnes
		                                                        </strong><br />
		                                                        <br />

		                                                        <fieldset style='border:1px solid #ccc; margin-top:20px;'>
		                                                            <legend style='font-weight:bold; color:#CE1212;'>Dados</legend>
		                                                            <strong>Data: </strong>".date('d/m/Y H:i:s')."<br />
		                                                            <br />
		                                                            <strong>Nome:</strong> ".$dados['nome']." <br />
		                                                            <strong>Email:</strong> ".$dados['email']." <br />
		                                                            <strong>Telefone:</strong> ".$dados['telefone']."
		                                                        </fieldset>
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

		            return $insert;

				}else{
					$this->log = array(
						'type' => 'error',
						'title' => "",
						'description' => "Senha inválida!"
					);

					return false;
				}
			}
		}
    }
}