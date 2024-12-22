<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>
	<?php
		require_once "PHPMailer/class.phpmailer.php";
		require_once "PHPMailer/class.smtp.php";
		
		if(isset($_POST['Enviar'])):
		$nome 		= addslashes(trim($_POST['nome']));
		$email 		= addslashes(trim($_POST['email']));
		$assunto 	= addslashes(trim($_POST['assunto']));
		$mensagem 	= addslashes(trim($_POST['mensagem']));
		$receber	= "elia.tawil@awardbrasil.com.br";
		$erro 		= array();
			if(empty($nome)):
			$erro[] = "Digite um nome";
			elseif(empty($email)):
				$erro[] = "Digite um email";
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
				$erro[] = "Email inválido!";
			elseif(empty($assunto)):
				$erro[] = "Digite um assunto";
			elseif(empty($mensagem)):
				$erro[] = "Digite uma mensagem";
			else:
				//mandar o email se passar nas validações
				$mail = new PHPMailer();
				$mail->isMail();
				$mail->setLanguage('pt', 'PHPMailer/language/');
				//$mail->CharSet = "UTF-8";
				//$mail->SMTPSecure = "ssl";
				//$mail->isSMTP();
				//$mail->Host = "smtp.gmail.com";
				//$mail->Port = 465;
				//$mail->SMTPAuth = true;
				//$mail->Username = "elia20109029@gmail.com";
				//$mail->Password = "";
				$mail->isHTML(true);
				//$mail->setFrom($email);
				$mail->From = $email;
				$mail->FromName = $nome;
				$mail->addAddress($receber);
				$mail->Subject = $assunto;
				$mail->Body = $mensagem;
				
				if($mail->Send()):
				echo "e-mail enviado com sucesso";
				
				else:
				echo "erro ao enviar email".$mail->ErrorInfo;
				
				endif;
			endif;
			
			foreach ($erro as $err) {
				if(!empty($err)):
					echo $err;
				endif;
			}
			
		endif;
	?>
</body>
</html>