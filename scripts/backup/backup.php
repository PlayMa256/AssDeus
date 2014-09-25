<?
// Create the mysql backup file
// edit this section
$dbhost = "localhost"; // usually localhost
$dbuser = "adcosmop_root";
$dbpass = "f5]Tp7]PTWgJ";
$dbname = "adcosmop_controle_membros";
$sendto = "Webmaster <backup@adcosmopolis.com.br>";
$sendfrom = "Backup <backup@adcosmopolis.com.br>";
$sendsubject = "Daily Mysql Backup";
$bodyofemail = "Here is the daily backup.";
// don't need to edit below this section

$backupfile = $dbname . date("Y-m-d") . '.sql';
system("mysqldump -h $dbhost -u $dbuser -p$dbpass $dbname > $backupfile");


// Mail the file


include('Mail.php');
include('Mail/mime.php');


$message = new Mail_mime();
$text = "$bodyofemail";
$message->setTXTBody($text);
$message->AddAttachment($backupfile);
$body = $message->get();
$extraheaders = array("From"=>"$sendfrom", "Subject"=>"$sendsubject");
$headers = $message->headers($extraheaders);
$mail = Mail::factory("mail");
$mail->send("$sendto", $headers, $body);


// Delete the file from your server
unlink($backupfile);
?>
