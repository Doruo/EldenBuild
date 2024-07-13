<?php

require_once __DIR__ . '/../../Lib/Psr4AutoloaderClass.php';

use App\EldenBuild\Controleur\ControleurGenerique;
use App\EldenBuild\Lib\MessageFlash;
use App\EldenBuild\Lib\PreferenceControleur;

/** ------------------- CLASS AUTOLOADER ------------------- */

// initialisation (param : affichage de débogage)
$chargeurDeClasse = new App\EldenBuild\Lib\Psr4AutoloaderClass(false);
$chargeurDeClasse->register();

// enregistrement d'une association "espace de nom" → "dossier"
$chargeurDeClasse->addNamespace('App\EldenBuild', __DIR__ . '/../../../src');

/** ------------------- GESTION CONTROLEUR ------------------- */

$action = $_REQUEST['action'] ?? "home";

// controleur choisi par client
if (isset($_REQUEST['controleur']))
    $controleur = $_REQUEST['controleur'];

// sinon, controleur de preference du client
else if (PreferenceControleur::existe())
    $controleur = PreferenceControleur::lire();

// sinon, par défaut
else $controleur = "utilisateur";

$nomDeClasseControleur = "App\EldenBuild\Controleur\Controleur" . ucfirst($controleur);

/** ------------------- GESTION ACTION ------------------- */

// Si le controleur existe
if (class_exists($nomDeClasseControleur)) {

    // Si l'action existe dans la classe du controleur, on l'execute
    if (in_array($action,get_class_methods($nomDeClasseControleur)))
        $nomDeClasseControleur::$action();
    else {
        MessageFlash::ajouter("danger","Cette action n'existe pas pour : ".$nomDeClasseControleur);
        ControleurGenerique::redirectionVersURL("controleurFrontal.php?action=home");
    }
}
else {
    MessageFlash::ajouter("danger",$nomDeClasseControleur." n'existe pas");
    ControleurGenerique::redirectionVersURL("controleurFrontal.php?action=home");
}