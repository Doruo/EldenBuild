<?php
namespace App\EldenBuild\Controleur;
use App\EldenBuild\Lib\MessageFlash;
use App\EldenBuild\Lib\PreferenceControleur;

abstract class ControleurGenerique {

    /** ------------------- AFFICHAGE PRINCIPALE ------------------- */
    public static function home():void {
        self::afficherVueGenerale(array("cheminVueBody" => "/../home/home.php"));
    }

    /** ------------------- READ ------------------- */
    protected abstract static function info():void; // *

    /** ------------------- AFFICHAGE VUES ------------------- */
    protected static function afficherVue(string $cheminVue, array $parametres = []): void
    {
        $messagesFlash = MessageFlash::lireTousMessages();
        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../vue/$cheminVue"; // Charge la vue
    }

    protected static function afficherVueGenerale(array $parametres = []): void
    {
        $messagesFlash = MessageFlash::lireTousMessages();
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../vue/web/vueGenerale.php"; // Charge la vue
    }

    /** ------------------- MESSAGES FLASHS ------------------- */
    public static function redirect(string $url):void{
        header("Location: $url");
    }
    /** ------------------- PREFERENCE CONTROLEUR ------------------- */
    public static function showFormPreference():void
    {
        $parametres = array(
            "pagetitle" => "Formulaire Preference",
            "cheminVueBody" => "/../formulairePreference.php",
        );
        $parametres ['controleurPreference'] = PreferenceControleur::existe() ? PreferenceControleur::lire() : "voiture";
        self::afficherVue('web/vueGenerale.php',$parametres);
    }

    public static function registerPreference():void
    {
        $controleurDefaut = $_REQUEST['controleur_defaut'];

        if (!is_null($controleurDefaut)){
            PreferenceControleur::enregistrer($controleurDefaut);
            MessageFlash::ajouter("success","Votre préference " . $controleurDefaut . " a bien été enregistrée. (Tu as reçu un cookie !)");
        }
        else MessageFlash::ajouter("danger","Votre préference n'a pas pu être enregistrée.");

        self::redirect('controleurFrontal.php?action=home');
    }
}