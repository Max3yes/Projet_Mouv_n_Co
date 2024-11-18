<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mouv'n Co - Cabinet de Kinésithérapie & Ostéopathe à Colmar</title>
    <meta name="description"
        content="Mouv'n Co Kinésithérapie et ostéopathie à Colmar | Soulagez vos douleurs | Près du vignoble alsacien" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        /* Masque la zone de texte par défaut à mettre dans le css*/
        #precisezZone {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Ecrivez-nous</h2>
        <p class="text-center">Vous souhaitez des renseignements ? Laissez-nous un message avec votre demande et vos
            coordonnées.</p>
            <?php
            // Vérifie si le message a été envoyé
            if (isset($_SESSION['messageEnvoye'])) {
                if ($_SESSION['messageEnvoye']) {
                    echo '<div class="alert alert-success mt-4">Merci ! Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.</div>';
                } else {
                    echo '<div class="alert alert-danger mt-4">Il y a eu un problème lors de l\'envoi de votre message. Veuillez réessayer.</div>';
                }
                unset($_SESSION['messageEnvoye']); // Effacer l'indicateur
            }
            ?>
        <p class="required">Les champs <span>*</span> sont obligatoires</p>
        <form method="post" action="mail.php">
            <div class="row">
                <label class="mb-2">Civilité<span>*</span> :</label>
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="civilite" id="madame" value="Madame"
                            required>
                        <label class="form-check-label" for="madame">Madame</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="civilite" id="monsieur" value="Monsieur"
                            required>
                        <label class="form-check-label" for="monsieur">Monsieur</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label">Nom<span>*</span></label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label" required>Prénom<span>*</span></label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
            </div>

            <!-- Email et Numéro de téléphone en 2 colonnes -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email<span>*</span></label>
                    <input type="email" class="form-control" id="email" name="mel" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telephone" class="form-label">Téléphone<span>*</span></label>
                    <input type="tel" class="form-control" id="telephone" name="tel" required>
                </div>
            </div>

            <!-- Choix sous forme de cases à cocher à choix simple -->
            <div class="mb-3">
                <label>Votre demande concerne<span>*</span> :</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="choix" id="physio" value="la kinésithérapie"
                        required>
                    <label class="form-check-label" for="physio">La kinésithérapie</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="choix" id="osteo" value="l'ostéopathie" required>
                    <label class="form-check-label" for="osteo">L'ostéopathie</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="choix" id="nurse"
                        value="Le cabinet d'infirmières" required>
                    <label class="form-check-label" for="nurse">Le cabinet d'infirmières</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="choix" id="well-being"
                        value=" le massage californien" required>
                    <label class="form-check-label" for="well-being">Massage californien</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="choix" id="obi-wan_kenobi" value="Autre" required
                        onchange="togglePrecisez()">
                    <label class="form-check-label" for="obi-wan_kenobi">Autre</label>
                </div>
            </div>
            <div class="mb-3" id="precisezZone">
                <label for="precisez" class="form-label">Vous avez sélectionné "Autre" ?</label>
                <input type="text" class="form-control" name="precision" id="precisez" placeholder="Vous pouvez préciser votre choix">
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Sujet<span>*</span></label>
                <input type="text" class="form-control" id="subject" name="sujet" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message<span>*</span></label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>

            <div class="container mt-4">
                <h4 class="mb-3">Vos disponibilités</h4>
                <div class="mb-3">
                    <label for="message" class="form-label">Indiquez le(s) jours et le(s) horaire(s)</label>
                    <textarea class="form-control" id="dispo" name="dispo" rows="4"></textarea>
                </div>
            </div>
    <!-- Première liste : choix des jours -->
    <!-- <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="jours">Quel jour(s) :</label>
            <div id="jours">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jours[]" id="lundi" value="Lundi">
                    <label class="form-check-label" for="lundi">Lundi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jours[]" id="mardi" value="Mardi">
                    <label class="form-check-label" for="mardi">Mardi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jours[]" id="mercredi" value="Mercredi">
                    <label class="form-check-label" for="mercredi">Mercredi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jours[]" id="jeudi" value="Jeudi">
                    <label class="form-check-label" for="jeudi">Jeudi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jours[]" id="vendredi" value="Vendredi">
                    <label class="form-check-label" for="vendredi">Vendredi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jours[]" id="tous-les-jours" value="Je suis disponible tous les jours">
                    <label class="form-check-label" for="tous-les-jours">Je suis disponible tous les jours</label>
                </div>
            </div>
        </div>
    

    <!-- Deuxième liste : choix des horaires -->
    <!--<div class="col-md-6 mb-3">
        <label class="form-label" for="plages">Sur quelle(s) plage(s) horaire :</label>
        <div id="plages">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="plages[]" id="matin" value="entre 8h et 12h">
                <label class="form-check-label" for="matin">Entre 8h et 12h</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="plages[]" id="midi" value="entre 12h et 14h">
                <label class="form-check-label" for="midi">Entre 12h et 14h</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="plages[]" id="apres-midi" value="entre 14h et 16h">
                <label class="form-check-label" for="apres-midi">Entre 14h et 16h</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="plages[]" id="soir" value="après 16h">
                <label class="form-check-label" for="soir">Après 16h</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="plages[]" id="aucune-preference" value="je n'ai pas de préférence">
                <label class="form-check-label" for="aucune-preference">Je n'ai pas de préférence</label>
            </div>
        </div>
    </div>
    </div> -->
    
            <!-- reCAPTCHA -->
            <!-- <div class="g-recaptcha mb-3" data-sitekey="TA_CLE_SITE"></div> -->

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fonction pour afficher/masquer la zone "Précisez"
        function togglePrecisez() {
            var autre = document.getElementById("obi-wan_kenobi");
            var precisezZone = document.getElementById("precisezZone");

            if (autre.checked) {
                precisezZone.style.display = "block"; // Afficher la zone
            } else {
                precisezZone.style.display = "none"; // Masquer la zone
            }
        }
    </script>
</body>