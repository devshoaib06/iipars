<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'class.phpmailer.php';

$mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'mail.karmickdev.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'info@karmickdev.com';
$mail->Password = 'q9b{eGcM(x#f';


$mail->From = 'info@karmickdev.com';
$mail->FromName = 'Info';
$mail->AddAddress('amal.khamaru@karmicksolutions.com', 'Amal');  // Add a recipient

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <strong>in bold!</strong>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';