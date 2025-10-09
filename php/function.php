<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require '../vendor/autoload.php';

function mail_send($adress_mail, $name_mail, $attachment_mail, $subject_mail, $body_mail){

//Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'ssl0.ovh.net ';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'contact@alternance-fest.fr';                     //SMTP username
        $mail->Password   = 'iBCAn7M5rh38sk67DJpYhEPCaYE7st';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('contact@alternance-fest.fr', 'Alternance Fest');
        $mail->addAddress($adress_mail, $name_mail);     //Add a recipient
        $mail->addReplyTo('contact@alternance-fest.fr', 'Alternance Fest');

        //Attachments
        if(is_null($attachment_mail) ){
        }else{
            $mail->addAttachment('../attachment_file_mail/'.$attachment_mail); //Add attachments
        }

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject_mail;
        $mail->Body    = '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alternance Fest</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
  }
  .container {
    max-width: 700px;
    margin: 20px auto;
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  .header {
    background-color: #0d6efd;
    color: white;
    text-align: center;
    padding: 20px;
    font-size: 22px;
    font-weight: bold;
  }
  .content {
    padding: 25px;
    color: #333333;
    line-height: 1.6;
  }
  .footer {
    text-align: center;
    font-size: 13px;
    color: #888888;
    padding: 15px;
    border-top: 1px solid #eeeeee;
  }
  a.footer-link {
    color: #0d6efd;
    text-decoration: none;
  }
  p {
              margin: 0;
          }
</style>
</head>
<body>
  <div class="container">
    <div class="header">
      Alternance Fest
    </div>
    <div class="content">
      <p><strong>Bonjour ' . htmlspecialchars($name_mail) . ',</strong></p>
      <br>
      <p>' . nl2br($body_mail) . '</p>
    </div>
    <div class="footer">
      © 2025 <a class="footer-link" href="https://alternance-fest.fr">Alternance Fest</a>
    </div>
  </div>
</body>
</html>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}




?>
