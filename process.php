<?php

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'include/PHPMailer.php';
require 'include/SMTP.php';
require 'include/Exception.php';

$error = '';

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo('empty');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid_Email';
}

if (!empty($error)) {
    // echo "Errors- " . $error;

    echo ('error');
    exit();
}

class EmailTemplate
{

    public static function formTemplate($name, $email, $subject, $message)
    {
        return '
            <p> Name :- ' . $name . '</p> <br/>
            <p> Email :- ' . $email . '</p> <br/>
            <p> Subject :- ' . $subject . '</p> <br/>
            <p> Message :- ' . $message . '</p> <br/>
        ';
    }
}



// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'sasindudeshan94@gmail.com';                     //SMTP username
$mail->Password   = 'nuwqsjxtzmkeeamu';                               //SMTP password
$mail->SMTPSecure = 'tls';                                    //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom($email, 'Mail from portfolio');
$mail->addAddress('sasindudeshan94@gmail.com', 'Sasindu Deshan');     //Add a recipient
$mail->addReplyTo($email, $name);

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = $name;
$mail->Body    =  EmailTemplate::formTemplate($name, $email, $subject, $message);

if ($mail->send()) {
    echo ('completed');
    exit();
} else {
    echo 'Error :-' . $mail->ErrorInfo;
}
$mail->smtpClose();
?>