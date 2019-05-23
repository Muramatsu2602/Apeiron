<?php
    require_once("class.phpmailer.php");
    require_once("class.smtp.php");
    $mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0; 
	$mail->SMTPAuth = true;	
	$mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com'; 
	$mail->Port = 465;
	$mail->SMTPAuth = true; 
    $mail->Username = 'apeironnoresponse@gmail.com';//Configurar pelo link https://support.google.com/accounts/answer/6010255?hl=pt-BR 
    $mail->Password = 'logos321';
	$mail->SetFrom('apeironnoresponse@gmail.com','Apeiron'); 
	$mail->AddAddress($email,$nome); //Muda Aqui para as variaveis que vem do SELECT
    $mail->IsHTML(true); 
    $mail->CharSet = 'utf-8'; 
    $mail->Subject  = "CONFIRMAR O SEU CADASTRO EM Apeiron"; // Assunto da mensagem
    $mail->Body .= "click em <a href='200.145.153.175/marcosdias/apeiron/executa/modifica.php?id=$key'>Confirma</a>"; //Corpo da Mensagem
    $enviado = $mail->Send();
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();
?>
