<?php

use App\Covoiturage\Modele\DataObject\Utilisateur;

echo '<h1>~ Utilisateurs ~</h1>';

/** @var array $utilisateurs */
/** @var Utilisateur $utilisateur */
foreach ($utilisateurs as $utilisateur) {

    $login = $utilisateur->getLogin();

    $loginHTML = htmlspecialchars($login);
    $loginURL = rawurlencode($login);

    echo "<div class=\"encadre\"> ";
    echo
        '<h1>' .
        '<a href="../web/controleurFrontal.php?action=afficherDetail&controleur=utilisateur&login=' . $loginURL . '">'
        . $loginHTML . '</a></h1>';
    echo "</div>";
}


