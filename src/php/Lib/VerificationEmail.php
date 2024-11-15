<?php

namespace App\EldenBuild\Lib;

use App\EldenBuild\Configuration\ConfigurationSite;
use App\EldenBuild\Modele\DataObject\Utilisateur;
use App\EldenBuild\Modele\Repository\UtilisateurRepository;

class VerificationEmail
{
    public static function envoiEmailValidation(Utilisateur $utilisateur): void
    {
        $loginURL = rawurlencode($utilisateur->getLogin());
        $nonceURL = rawurlencode($utilisateur->getNonce());
        $URLAbsolue = ConfigurationSite::getURLAbsolue();

        $lienValidationEmail = "$URLAbsolue?action=validerEmail&controleur=utilisateur&login=$loginURL&nonce=$nonceURL";

        $destinataire = $utilisateur->getEmailAValider();
        $sujet = "Validation de l'adresse email";

        // Corps de l'email en HTML
        $contenuHTML = "
        <html>
        <head>
          <title>Elden Build - Validez votre Compte</title>
        </head>
        <body>
          <p>
          Merci de vous être inscrit sur le meilleur Site de Build ! 
          Pour valider votre adresse email, veuillez cliquer sur le lien suivant :</p>
          <a href=\"$lienValidationEmail\">Cliquez ici pour valider votre email</a>
          <p>Amusez-vous bien sur Elden Build !</p>
        </body>
        </html>
        ";

        // Pour envoyer un email HTML, l'en-tête Content-type doit être défini
        $enTete = "MIME-Version: 1.0" . "\r\n";
        $enTete .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // En-têtes additionnels
        $enTete .= 'From: EldenBuild.com' . "\r\n";

        // Envoyer l'email
        mail($destinataire, $sujet, $contenuHTML, $enTete);
    }

    public static function traiterEmailValidation($login, $nonce): bool
    {
        /** @var Utilisateur $utilisateur */
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);
        if ($utilisateur) return false;

        $utilisateur->setEmail($utilisateur->getEmailAValider());
        $utilisateur->setEmailAValider("");

        return (!$utilisateur->formatTableau()['nonceTag'] == $nonce);
    }

    public static function aValideEmail(Utilisateur $utilisateur): bool{
        return $utilisateur->getEmail() != "";
    }
}