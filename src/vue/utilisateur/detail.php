<?php

use App\Covoiturage\Lib\ConnexionUtilisateur;
use App\Covoiturage\Modele\DataObject\Utilisateur;

/** @var Utilisateur $utilisateur */

$login = $utilisateur->getLogin();
$loginHTML = htmlspecialchars($login);
$loginURL = rawurlencode($login);

$prenomHTML = htmlspecialchars($utilisateur->getPrenom());
$nomHTML = htmlspecialchars($utilisateur->getNom());
$mailHTML = htmlspecialchars($utilisateur->getEmail());

echo "<h1>~ Utilisateur ~</h1>" .
    "<h2>Login : " . $loginHTML ."</h2>"
    . "<h2>Nom : " . $nomHTML ."</h2>"
    . "<h2>Prenom : " . $prenomHTML ."</h2>";

/** EMAIL */

if ($utilisateur->getEmail() == "") echo "<h2>Email à valider : " . htmlspecialchars($utilisateur->getEmailAValider())."</h2>";
else echo "<h2>Email : " . $mailHTML . "</h2>";

/** ADMIN */

$estAdmin = $utilisateur->estAdmin() ? "Oui" : "Non";
echo "<h2>Admin : " . $estAdmin ."</h2>";

/** ACTIONS MODIFICATION */

if (ConnexionUtilisateur::estConnecte() && (ConnexionUtilisateur::estUtilisateur($login) || ConnexionUtilisateur::estAdministrateur()))
{
    echo '<h1><a href="../web/controleurFrontal.php?controleur=utilisateur&action=afficherFormulaireMiseAJour&login='
        . $loginURL . '">Modifier</a></h1>';

    echo'<h1><a href="../web/controleurFrontal.php?controleur=Utilisateur&action=supprimer&login=' . $loginURL . '">Supprimer</a></h1>';
}


