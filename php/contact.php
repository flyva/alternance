<?php

require_once 'function.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Paramètre standard
    $adress_mail = $_POST['adress_mail'];
    $name_mail = $_POST['name_mail'];
    $attachment_mail = null;
    $subject_mail = $_POST['subject_mail'];
    $message_forms = $_POST['message_mail'];

    // Paramètre client
    $body_mail_client = "
    <p><strong>Merci pour votre message&nbsp;!</strong></p>
    <p>Je ne manquerais pas de vous répondre dans les plus bref délais.</p>
    <p>En vous souhaitant une excellente journée/soirée,</p>
    <p>Cordialement,</p>
    <p>Quentin RAULT</p>
    ";

    // Envoi du mail client
    mail_send($adress_mail, $name_mail, null, "Votre message à bien été reçu", $body_mail_client);





    // Paramètre hote
    $body_mail_host = "<p>Nom: ".$name_mail."</p>
    <p>Sujet: ".$subject_mail."</p>
    <p><strong>Mail:</strong> ".$adress_mail."</p>
    <p><strong>Message:</strong> ".$message_forms."</p>";

    // Envoi du mail à l'hote
    mail_send("quentinrault0@gmail.com", $name_mail, null, "Nouveau message", $body_mail_host);

    echo "success"; // On renvoie une réponse pour l’ajax

}else{
echo "error"; // On renvoie une réponse pour l’ajax}
}