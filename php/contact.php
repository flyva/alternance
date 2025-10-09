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
    <p>Je suis entrain de vérifier les branchements (et peut-être de démêler quelques câbles) avant de vous répondre.</p>
    <p>Vous recevrez un mail dès que tout est prêt côté régie !</p>
    <p>En attendant, gardez les lights allumée et le son sur ON&nbsp;!</p>
    <p>Si vous souhaitez un café, une poursuite ou me proposer un entretien, vous pouvez répondre à ce mail.</p>
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