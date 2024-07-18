<?php
use App\EldenBuild\Lib\ConnexionUtilisateur;
use App\EldenBuild\Modele\DataObject\Build;

/** @var Build $build */

$nomBuild = $build->getNomBuild();
$nomBuildHTML = htmlspecialchars($nomBuild);
$nomBuildURL = rawurlencode($nomBuild);

/** NOM */

echo "<h2>- ".$nomBuildHTML." -</h2>";

/** ACTIONS MODIFICATION */

if (ConnexionUtilisateur::estConnecte() && (ConnexionUtilisateur::estUtilisateur($nomBuild) || ConnexionUtilisateur::estAdministrateur()))
{
    echo '<h1><a href="../web/controleurFrontal.php?controleur=utilisateur&action=afficherFormulaireMiseAJour&login='
        . $nomBuildURL . '">Modify Profile</a></h1>';

    echo'<h1><a href="../web/controleurFrontal.php?controleur=Utilisateur&action=supprimer&login=' . $nomBuildURL . '">Delete Account</a></h1>';
}


