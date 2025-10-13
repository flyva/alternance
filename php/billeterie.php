<?php

require_once 'function.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Paramètre standard
    $name_ticket = $_POST['ticket-form-name'];
    $phone_ticket = $_POST['ticket-form-phone'];
    $mail_ticket = $_POST['ticket-form-mail'];

    // Nombre de billets récupéré depuis le formulaire
    $nb_tickets = $_POST['ticket-form-number'] ?? 1;

    // On commence avec le CV de base
    $attachment_mail = ["../attachment_file_mail/CV_quentin_rault.pdf"];

    // Si plus d'un billet, on ajoute CV2, CV3...
    if ($nb_tickets >= 2) {
        $attachment_mail[] = "../attachment_file_mail/CV2_quentin_rault.pdf";
    }
    if ($nb_tickets >= 3) {
        $attachment_mail[] = "../attachment_file_mail/CV3_quentin_rault.pdf";
    }

    $type_ticket = $_POST['TicketForm'] ?? null;
    $number_ticket = $_POST['ticket-form-number'];
    $message_forms = $_POST['ticket-form-message'];

    // Paramètre client
    $body_mail_client = (function() use ($type_ticket) {
        if ($type_ticket === 'Opt_1') {
            return "
<p><strong>Merci pour votre message&nbsp;!</strong></p>
    <p>Je ne manquerais pas de vous répondre dans les plus bref délais.</p>
    <p>En vous souhaitant une excellente journée/soirée,</p>
    <p>Cordialement,</p>
    <p>Quentin RAULT</p>
    ";
        } else {
            return "
   <p><strong>Merci pour votre message&nbsp;!</strong></p>
       <p>Je ne manquerais pas de vous répondre dans les plus bref délais.</p>
       <p>En vous souhaitant une excellente journée/soirée,</p>
       <p>Cordialement,</p>
       <p>Quentin RAULT</p>
    ";
        }
    })();


    // Envoi du mail client
    mail_send($mail_ticket, $name_ticket, $attachment_mail, "Vos billets", $body_mail_client);





    // Paramètre hote

    if ($type_ticket === 'Opt_1') {
        $type_text = 'Un entretien';
    } else {
        $type_text = 'Une alternance';
    }

    $body_mail_host = "
    <p>Nom: {$name_ticket}</p>
    <p>Téléphone: {$phone_ticket}</p>
    <p><strong>Mail:</strong> {$mail_ticket}</p>
    <br>
    <p><strong>Type de billet:</strong> {$type_text}</p>
    <p><strong>Nombre de billet:</strong> {$number_ticket}</p>
    <p><strong>Message:</strong> {$message_forms}</p>
    ";


    // Envoi du mail à l'hote
    mail_send("quentinrault0@gmail.com", $name_ticket, null, "Nouveau message", $body_mail_host);
}else{
echo "error"; // On renvoie une réponse pour l’ajax}
}