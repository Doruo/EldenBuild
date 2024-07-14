<?php
use App\EldenBuild\Modele\DataObject\Utilisateur;

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
        .$loginHTML. '</a></h1></div>';
}


