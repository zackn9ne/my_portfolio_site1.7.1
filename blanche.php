<?php
/**
 * Created by PhpStorm.
 * User: netkam
 * Date: 1/8/17
 * Time: 12:18 AM



 *///Create a new PHPMailer instance
$inifile = parse_ini_file("my.ini");
//var_dump($inifile);
$acn = $inifile["Account"];
$pwd = $inifile["Pass"];

require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
$mail = new PHPMailer;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->SMTPDebug = 1;
// use
$mail->Host = gethostbyname('smtp.gmail.com');
$mail->Username = "zackn9ne@gmail.com";
$mail->Password = "+4sWF2qQy.qX)V";
//Set who the message is to be sent from
$mail->setFrom($acn, 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($acn, 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
$mail->Body = 'some test';
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
