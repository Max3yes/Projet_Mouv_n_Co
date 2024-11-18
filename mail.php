<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/PHPMailer/src/Exception.php';
require 'libs/PHPMailer/src/PHPMailer.php';
require 'libs/PHPMailer/src/SMTP.php';

session_start();

$messageEnvoye = false;

// Récupération des données du formulaire
$civilite = filter_input(INPUT_POST, "civilite", FILTER_SANITIZE_SPECIAL_CHARS);
$nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
$prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
$choix = filter_input(INPUT_POST, "choix", FILTER_SANITIZE_SPECIAL_CHARS);
$precisez = filter_input(INPUT_POST, "precision", FILTER_SANITIZE_SPECIAL_CHARS);
$sujet = filter_input(INPUT_POST, "sujet", FILTER_SANITIZE_SPECIAL_CHARS);
$message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "mel", FILTER_VALIDATE_EMAIL);
$tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_NUMBER_INT);
$dispo = filter_input(INPUT_POST, "dispo", FILTER_SANITIZE_SPECIAL_CHARS);

if (empty($dispo)) {
    $dispo = "La personne n'a pas laissé ses disponibilités.";
}

if ($choix === "Autre" && !empty($precisez)) {
    // Ajouter les détails précisés par l'utilisateur si "Autre" est sélectionné
    $choix .= " (" . $precisez.")";
}

// Normalisation de `$choix`
$choix = trim(strtolower($choix));

// Choix du compte Gmail et destinataire en fonction de l'option sélectionnée
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug = 1; // À mettre sur 0 en production
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->CharSet = PHPMailer::CHARSET_UTF8;

// Configuration en fonction de `$choix`
if ($choix === "le cabinet d&#39;infirmières") {
    $mail->Host = "smtp.gmail.com";
    $mail->Username = ''; // Compte Gmail de l'infirmière
    $mail->Password = '';
    $destinataire = 'lalilulelo@gmail.com';
} else {
    $mail->Host = "smtp.gmail.com";
    $mail->Username = ''; // Compte Gmail pour la rééducation
    $mail->Password = '';
    $destinataire = 'lalilulelo.gmail.com';
}

// Paramètres de l'email
$mail->IsHTML(true);
$mail->setFrom($email, "$nom $prenom");
$mail->addReplyTo($email, "$civilite $nom $prenom");
$mail->addAddress($destinataire, htmlspecialchars_decode($choix));
$mail->Subject = htmlspecialchars_decode($sujet);
$mail->Body = "<p>$civilite " . strtoupper($nom) . " $prenom a laissé un message via le formulaire de contact concernant <strong>$choix</strong> :</p><p>" . nl2br($message) . "</p>
<p>Disponibilités : $dispo</p>
<p>Mon numéro de téléphone : $tel</p>
<p>Mon adresse mail : $email</p>";
// <p>$disponibilites</p>

if ($mail->send()) {
    // Si l'email est envoyé, on définit la session pour afficher le message de confirmation
    $_SESSION['messageEnvoye'] = true;
} else {
    // Si l'email échoue, on définit la session pour afficher le message d'erreur
    $_SESSION['messageEnvoye'] = false;
}

header("Location: contact.php");
exit();

?>