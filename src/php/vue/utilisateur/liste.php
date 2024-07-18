<?php
use App\EldenBuild\Modele\DataObject\Utilisateur;

/** @var array $utilisateurs */
/** @var Utilisateur $utilisateur */
foreach ($utilisateurs as $utilisateur) {

    $login = $utilisateur->getLogin();
    $loginHTML = htmlspecialchars($login);
    $loginURL = rawurlencode($login);

    echo '<div class=\"encadre\"><h1><a href="/info&login='.$loginURL.'">' .$loginHTML. '</a></h1></div>';
}


