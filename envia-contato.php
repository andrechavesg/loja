<?php
session_start();

$nome = $_POST["nome"];
$email = $_POST["email"];
$mensagem = $_POST["mensagem"];

require_once("PHPMailerAutoload.php");
//Criamos agora um novo email a ser enviado
$mail = new PHPMailer();
//configuração dos dados do servidor gmail, envio de email 
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "grasiela_mach@hotmail.com";
$mail->Password = "machado";
// quem está enviando o email
$mail->setFrom('aciatuani@gmail.com', 'Aciatuani');
//quem vai receber o email
$mail->addAddress('aciatuani@gmail.com');
//título da mensagem
$mail->Subject = "Email de contato da loja";
//corpo da mensagem como HTML
$mail->msgHTML("<html>de: {$nome}<br/>email: {$email}<br/>mensagem: {$mensagem}</html>");
$mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem:{$mensagem}";

if ($mail->send()) {
	$_SESSION['success'] = "Mensagem enviada com sucesso.";
	header("Location: index.php");
}else{
	$_SESSION['danger'] = "Erro ao enviar mensagem" . $mail->ErrorInfo;
	header("Location: contato.php");
}
die();
?>