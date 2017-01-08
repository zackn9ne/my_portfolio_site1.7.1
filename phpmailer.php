<?php



var_dump($_POST);
echo "asdf";

//$email = $_REQUEST['email'] ;
//$message = $_REQUEST['message'] ;

//get secrets outta here
$inifile = parse_ini_file("my.ini");
//   var_dump($inifile);
$acn = $inifile["Account"];
$pwd = $inifile["Pass"];








if ( isset($_REQUEST['email']) && isset($_REQUEST['name']) && isset($_REQUEST['subject']) && isset($_REQUEST['text']) && filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) ) {

    // detect & prevent header injections
    $test = "/(content-type|bcc:|cc:|to:)/i";
    foreach ( $_REQUEST as $key => $val ) {
        if ( preg_match( $test, $val ) ) {
            exit;
        }
    }





    // PREPARE THE BODY OF THE MESSAGE

    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
    $message .= "<tr><td><strong>Message:</strong> </td><td>" . htmlentities($_POST['text']) . "</td></tr>";
    $message .= "</table>";


    echo $message;


    require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';




//Create a new PHPMailer instance
    $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPDebug = 3;
//Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';




//Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $acn;
//Password to use for SMTP authentication
    $mail->Password = $pwd;
//Set who the message is to be sent from
    $mail->setFrom('from@example.com', 'First Last');
//Set an alternative reply-to address
    $mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
    $mail->addAddress($acn, 'zak');
//Set the subject line
    $mail->Subject = 'PHPMailer GMail SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//$mail->Body = 'the quick brown fox jumps over the lazy dogs';
    $mail->Body = $message;
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
}
