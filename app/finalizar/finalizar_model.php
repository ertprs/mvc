<?php

class Finalizar_Model extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function finalizarPedido($dados){
    	if(!empty($_SESSION['cliente'])){
            if($dados['jcartUpdateCart'] || $dados['jcartEmpty']){
			    if($dados['jcartUpdateCart']){
                    if($_SESSION['jcart']->update_cart() !== true){
                        $_SESSION['quantityError'] = true;
                    }
                }

                if($dados['jcartEmpty']){
                    $_SESSION['jcart']->empty_cart();
                }

                $protocol = 'http://';
                if(!empty($_SERVER['HTTPS'])){
                    $protocol = 'https://';
                }

                exit;

            }else{
                $validPrices = true;

                ////////////////////////////////////////////////////////////////////////////

                if($validPrices !== true){
                    die($config['text']['checkoutError']);

                }elseif($validPrices === true){
                    $count = 1;

                    foreach($_SESSION['jcart']->get_contents() as $item){
                        if($count == 1){
                            $carrinho_cheio = "ok";

                            $dados_insert = array(
                            	'cliente_id' => $_SESSION['cliente']['id'],
                            	'status' => 1,
                            	'pago' => 'n',
                            	'data' => date('Y-m-d H:i:s'),
                            	'lido' => 'n'
                            );

                            $insert = $this->db->insert('pedidos', $dados_insert);

                            if($insert == false){
                                return array(
                                	'type' => 'danger',
                                	'title' => 'Erro!',
                                	'description' => 'Ocorreu um erro ao finalizar o pedido!'
                                );
                            }
                        }

                        ##### INSERE ITENS ###########
                        $this->db->insert('itens', array(
                        	'produtoId'  => $item['id'],
                        	'data' 		 => date("Y-d-m H:i:s"),
                            'quantidade' => $item['qty'],
                        	'valor'      => $item['price'],
                        	'PedidoId' 	 => $insert
                        ));

                        ##### SELECIONA LABELS ###########
                        $dados_produto = $this->db->selectSingle("SELECT id,nome,preco FROM produtos WHERE id='".$item['id']."'");

                        ##### ITENS QUE IRÃO NO EMAIL ###########
                        $saida .= "
                        <strong>Código:</strong>".$dados_produto['id']."<br />
                        <strong>Produto:</strong>".$dados_produto['nome']."<br />
                        <strong>Preço:</strong>".$dados_produto['preco']."<br />
                        <strong>Quantidade:</strong>".$item['qty']."<br />
                        <br clear='all' />
                        <hr>
                        <br clear='all' />
                        ";

                        ++$count;
                    }


                    if($carrinho_cheio == "ok"){
                    	# DADOS DO PEDIDO
                        $dados_pedido = $this->db->selectSingle("SELECT * FROM pedidos WHERE id='".$insert."'");

                        # DADOS DO CLIENTE
						$dados_cliente = $this->db->selectSingle("SELECT * FROM clientes WHERE id='".$_SESSION['cliente']['id']."'");

                        include "PHPMailer_v5.1/class.phpmailer.php";
                        $mail = new PHPMailer();
                        $mail->IsHTML(true); // send as HTML

                        $mail->Sender   = "dalcoladm@gmail.com";
                        $mail->From     = $dados_cliente['email'];
                        $mail->FromName = utf8_decode($dados_cliente['nome']);
                        $mail->AddReplyTo($dados_cliente['email'], utf8_decode($dados_cliente['nome']));

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

                        $mail->Subject = utf8_decode("Solicitação de Orçamento - Dal Col Carnes");
                        $mail->Body = "
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
                                                        <img src='".CONFIG_PATH_PUBLIC."/img/carta/topo.jpg'  width='600' height='166'  border='0'  />
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td background='".CONFIG_PATH_PUBLIC."/img/carta/meio.jpg'>
                                                    <table width='100%' border='0' cellspacing='0' cellpadding='35'>
                                                        <tr>
                                                            <td>
                                                                <font size='2' face='Tahoma' color='#000000'>

                                                                    <strong>Solicitação de Orçamento - Dal Col Carnes</strong>
                                                                    <br />
                                                                    <br />
                                                                    <strong>Nome: </strong>".$dados_cliente['nome']."<br />
                                                                    <strong>Email: </strong>".$dados_cliente['email']."<br />
                                                                    <strong>Telefone: </strong>".$dados_cliente['telefone']."<br />
                                                                    <br />
                                                                    <br />
                                                                    ".$saida."
                                                                </font>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td valign='bottom'>
                                                    <img src='".CONFIG_PATH_PUBLIC."/img/carta/rodape.jpg' width='600' height='30' />
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                    </td>
                                </tr>
                            </table>
                        </body>
                        </html>";

                        if($mail->Send()){
                            $_SESSION['jcart']->empty_cart();

                            return array(
                            	'type'         => 'success',
                            	'title'        => '',
                            	'description'  => 'Seu orçamento foi enviado com sucesso, entraremos em contato em breve!!',
                                'location'      => CONFIG_PATH.'/area-do-cliente/'
                            );

                        }else{
                            return array(
                            	'type' => 'error',
                            	'title' => '',
                            	'description' => 'Ocorreu um erro ao enviar o email!'
                            );
                        }

                    }else{
                        echo "<script>alert('Seu carrinho está vazio!');location.href='".CONFIG_PATH."/produtos/';</script>";
                    }

                    $_SESSION['jcart']->empty_cart();
                }
            }

        }else{
            header("Location: ".CONFIG_PATH."/area-do-cliente/?fin=1");
        }
    }
}