<?php

require_once 'function.php';

// Paramètre standard
$adress_mail = $_POST['adress_mail'];
$name_mail = $_POST['name_mail'];
$attachment_mail = null;
$subject_mail = $_POST['subject_mail'];
$message_forms = $_POST['message_mail'];

// Paramètre client
$body_mail_client = "<p>Merci pour votre message. Nous avons bien reçu votre demande et notre équipe l’examine.</p>
<p>Un membre de l’équipe vous répondra par email dans les plus brefs délais. En attendant, merci de patienter.</p>>
<p>Si vous avez des informations supplémentaires à nous communiquer, vous pouvez répondre directement à cet email.</p>";

// Envoi du mail client
mail_send($adress_mail, $name_mail, null, $subject_mail, $body_mail_client);





// Paramètre hote
$body_mail_host = "<p>Nom: ".$name_mail."</p>
<p>Sujet: ".$subject_mail."</p>
<p><strong>Mail:</strong> ".$adress_mail."</p>
<p><strong>Message:</strong> ".$message_forms."</p>";

// Envoi du mail à l'hote
mail_send($adress_mail, $name_mail, null, $subject_mail, $body_mail_host);

header('Location: ../index.html?message=success');
