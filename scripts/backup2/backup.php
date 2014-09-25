<?php
require_once('phpmailer/class.phpmailer.php');

$dbhost = "localhost"; // usually localhost
$dbuser = "adcosmop_root";
$dbpass = "f5]Tp7]PTWgJ";
$dbname = "adcosmop_controle_membros";
$backupfile = $dbname . date("d-m-Y") . '.sql';
system("mysqldump -h $dbhost -u $dbuser -p$dbpass $dbname > $backupfile");

$mail             = new PHPMailer(); // defaults to using php "mail()"

$mail->IsSendmail(); // telling the class to use SendMail transport

$body             = "EM ANEXO";
$mail->AddReplyTo("backup@adcosmopolis.com.br","BACKUP");
$mail->SetFrom('backup@adcosmopolis.com.br', 'Backup');
$address = "backup@adcosmopolis.com.br";

$mail->AddAddress($address, "Eu");

$mail->Subject    = "Backup do dia ".date("d-m-Y");
$mail->AltBody    = "Em anexo"; // optional, comment out and test
$mail->MsgHTML($body);
$mail->AddAttachment($backupfile);      // attachment

if(!$mail->Send()) {
  //echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //echo "Message sent!";
}
    ?>