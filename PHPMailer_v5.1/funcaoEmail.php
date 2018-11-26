<?

if($_SERVER['HTTP_HOST'] == '192.168.2.152'){
defined('APPLICATION_PATH') || define('APPLICATION_PATH', $_SERVER['DOCUMENT_ROOT'].'mrb/');
}else{
defined('APPLICATION_PATH') || define('APPLICATION_PATH', $_SERVER['DOCUMENT_ROOT'].'novo/sistema');
}





function mailEnvia($emailDest = array(),$AssuntoDoEmail,$msg, $config = array()){
	$endereco = APPLICATION_PATH;
	if(!class_exists('phpmailer')){
		require $endereco.'PHPMailer_v5.1/class.phpmailer.php';
		require $endereco.'PHPMailer_v5.1/class.smtp.php';
	}
	
	$mail             = new PHPMailer(true);
	$mail->SetLanguage("br",$endereco.'PHPMailer_v5.1/language/phpmailer.lang-br.php');
	if(empty($msg)){
		$msg = '<br>';
	}
	$body             = $msg;
	$body             = eregi_replace("[\]",'',$body);
	
	/*DADOS DO EMAIL PARA AUTENTICA��O*/
	if(empty($config['porta'])){
		$config['porta'] = 25;
	}
	$email_receb = $config['conta'];//"teste@email.com.br";	 			//email que envia
	$email_nome = $config['conta_nome'];//"teste";
	$senha = $config['senha'];//"123456";									//senha do email para autenticacao
	$smtp = $config['smtp'];//"smtp.email.com.br";							//exemplo smtp.nomedosite.com.br
	$porta = $config['porta'];//25;											//o padrao e 25, mas tem que verificar com o servidor
	
	/************************/
	
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPSecure = "tls";
	$mail->SMTPAuth   = true;                  	// enable SMTP authentication
	$mail->Host       = $smtp; 					// sets the SMTP server
	$mail->Port       = $porta;             	// set the SMTP port
	$mail->Username   = $email_receb; 			// SMTP account username
	$mail->Password   = $senha;        			// SMTP account password
	
	//header
	$mail->Priority = 1;
	//
	
	$mail->SetFrom($email_receb, utf8_decode($email_nome));
	
	$mail->AddReplyTo($email_receb,$email_nome);
	
	$mail->Subject    = $AssuntoDoEmail;
	
	$mail->MsgHTML($body);
	
	$address = $emailDest;//destinat�rio do email
	foreach($address as $add){
		if(!empty($add)){
			$mail->AddAddress($add, '');
		}
	}
	
	//$mail->AddAttachment("../img/botao-assunto.png");      // attachment
	
	if(!$mail->Send()) 
	{
		return false;
	  echo "Mailer Error: " . $mail->ErrorInfo;
	  
	}
	else
	{
		return true;
	}
}



//EXEMPLO:

/*$config = array(
	'conta'=>'thainam@rdweb.com.br',
	'conta_nome'=>'Thainam RDWeb',
	'senha'=>'thainam5315t',
	'smtp'=>'smtp.gmail.com.br',
	'porta'=>'587'
);
$txt = '<b>teste!!!!!</b>'; 
mailEnvia(array('thainam@rdweb.com.br'),'AAA',$txt,$config);*/


?>