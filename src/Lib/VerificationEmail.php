<?php

namespace App\Covoiturage\Lib;

use App\Covoiturage\Configuration\ConfigurationSite;
use App\Covoiturage\Modele\DataObject\Utilisateur;
use App\Covoiturage\Modele\Repository\UtilisateurRepository;

class VerificationEmail
{
    public static function envoiEmailValidation(Utilisateur $utilisateur): void
    {
        $loginURL = rawurlencode($utilisateur->getLogin());
        $nonceURL = rawurlencode($utilisateur->getNonce());
        $URLAbsolue = ConfigurationSite::getURLAbsolue();

        $lienValidationEmail = "$URLAbsolue?action=validerEmail&controleur=utilisateur&login=$loginURL&nonce=$nonceURL";

        $destinataire = "bob@yopmail.com";
        $sujet = "Validation de l'adresse email";

        // Corps de l'email en HTML
        $contenuHTML = "
        <html>
        <head>
          <title>HAYE Marc Covoiturage - Validation adresse email</title>
        </head>
        <body>
          <p>
          Merci de vous être inscrit sur le meilleur site de covoiturage ! 
          Pour valider votre adresse email, veuillez cliquer sur le lien suivant :</p>
          <a href=\"$lienValidationEmail\">Cliquez ici pour valider votre email</a>
          <p>Marc HAYE, Etudiant Informatique à l'IUT Montpellier-Sète.</p>
        </body>
        </html>
        ";

        // Pour envoyer un email HTML, l'en-tête Content-type doit être défini
        $enTete = "MIME-Version: 1.0" . "\r\n";
        $enTete .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        /*// En-têtes additionnels
        $enTete .= 'From: marc.antonio.haye@gmail.com' . "\r\n";*/

        // Envoyer l'email
        mail($destinataire, $sujet, $contenuHTML, $enTete);
    }

    public static function traiterEmailValidation($login, $nonce): bool
    {
        /** @var Utilisateur $utilisateur */
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);
        return ($utilisateur && !$utilisateur->formatTableau()['nonceTag'] == $nonce);
    }

    public static function aValideEmail(Utilisateur $utilisateur): bool{
        return !$utilisateur->getEmail() == "";
    }
}