<?php

require_once __DIR__ . '/../../Lib/Psr4AutoloaderClass.php';

use App\Covoiturage\Controleur\ControleurGenerique;
use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Lib\PreferenceControleur;

/** ------------------- CLASS AUTOLOADER ------------------- */

// initialisation (param : affichage de débogage)
$chargeurDeClasse = new App\Covoiturage\Lib\Psr4AutoloaderClass(false);
$chargeurDeClasse->register();

// enregistrement d'une association "espace de nom" → "dossier"
$chargeurDeClasse->addNamespace('App\Covoiturage', __DIR__ . '/../../../src');

/** ------------------- GESTION CONTROLEUR ------------------- */

$action = $_REQUEST['action'] ?? "afficherListe";

// controleur choisi par client
if (isset($_REQUEST['controleur']))
    $controleur = $_REQUEST['controleur'];

// sinon, controleur de preference du client
else if (PreferenceControleur::existe())
    $controleur = PreferenceControleur::lire();

// sinon, par défaut
else $controleur = "voiture";


$nomDeClasseControleur = "App\Covoiturage\Controleur\Controleur" . ucfirst($controleur);

/** ------------------- GESTION ACTION ------------------- */


// Si le controleur existe
if (class_exists($nomDeClasseControleur)) {

    // Si l'action existe dans la classe du controleur, on l'execute
    if (in_array($action,get_class_methods($nomDeClasseControleur)))
        $nomDeClasseControleur::$action();
    else {
        MessageFlash::ajouter("danger","Erreur: Cette action n'existe pas pour : ".$nomDeClasseControleur);
        ControleurGenerique::redirectionVersURL("controleurFrontal.php?action=afficherListe");
    }
}
else {
    MessageFlash::ajouter("danger","Erreur: ".$nomDeClasseControleur." n'existe pas");
    ControleurGenerique::redirectionVersURL("controleurFrontal.php?action=afficherListe");
}