<?php
require_once('composer/PHPMailer/src/PHPMailer.php');
require_once('composer/PHPMailer/src/SMTP.php');
use composer\PHPMailer\PHPMailer;
use composer\PHPMailer\SMTP\src\SMTP;
$mail = new PHPMailer();

//Send mail using gmail
if($send_using_gmail){
    $mail->isSendmail(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->Username = "reecosstar@gmail.com"; // GMAIL username
    $mail->Password = "#Reecosstar!1353"; // GMAIL password
}

//Typical mail data
$mail->AddAddress($email, $name);
$mail->SetFrom($email_from, $name_from);
$mail->Subject = "My Subject";
$mail->Body = "Mail contents";

try{
    $mail->Send();
    echo "Success!";
} catch(Exception $e){
    //Something went bad
    echo "Fail - " . $mail->ErrorInfo;
}

?>
