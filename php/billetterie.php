<?php

require_once 'function.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Paramètre standard
    $name_ticket = $_POST['ticket-form-name'];
    $phone_ticket = $_POST['ticket-form-phone'];
    $mail_ticket = $_POST['ticket-form-mail'];


    // On commence avec le CV de base
    $attachment_mail = ["../attachment_file_mail/CV_quentin_rault.pdf"];

    $message_forms = $_POST['ticket-form-message'];

    // Paramètre client
    $body_mail_client ="
   <p><strong>Merci pour votre message&nbsp;!</strong></p>
       <p>Je ne manquerais pas de vous répondre dans les plus bref délais.</p>
       <p>En vous souhaitant une excellente journée/soirée,</p>
       <p>Cordialement,</p>
       <p>Quentin RAULT</p>
    ";



    // Envoi du mail client
    mail_send($mail_ticket, $name_ticket, $attachment_mail, "Billetterie", $body_mail_client);





    // Paramètre hote

    $body_mail_host = "
    <p>Nom: {$name_ticket}</p>
    <p>Téléphone: {$phone_ticket}</p>
    <p><strong>Mail:</strong> {$mail_ticket}</p>
    <br>
    <p><strong>Message:</strong> {$message_forms}</p>
    ";


    // Envoi du mail à l'hote
    mail_send("quentinrault0@gmail.com", $name_ticket, null, "Nouveau message", $body_mail_host);
}else{
echo "error"; // On renvoie une réponse pour l’ajax}
}
