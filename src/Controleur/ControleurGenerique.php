<?php
namespace App\EldenBuild\Controleur;
use App\EldenBuild\Lib\MessageFlash;
use App\EldenBuild\Lib\PreferenceControleur;

abstract class ControleurGenerique {

    public static function home() : void {self::afficherVueGenerale();}

    /** ------------------- READ ------------------- */
    protected static abstract function afficherListe();
    protected abstract static function afficherDetail();

    /** ------------------- CREATE ------------------- */
    protected abstract static function afficherFormulaireCreation();
    protected abstract static function creerDepuisFormulaire();

    /** ------------------- UPDATE ------------------- */
    protected abstract static function afficherFormulaireMiseAJour();
    protected abstract static function mettreAJour();

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

    /** ------------------- DELETE ------------------- */
    protected abstract static function supprimer();

    /** ------------------- MESSAGES FLASHS ------------------- */
    public static function redirectionVersURL(string $url) : void{
        header("Location: $url");
    }
    /** ------------------- PREFERENCE CONTROLEUR ------------------- */
    public static function afficherFormulairePreference() : void
    {
        $parametres = array(
            "pagetitle" => "Formulaire Preference",
            "cheminVueBody" => "/../formulairePreference.php",
        );
        $parametres ['controleurPreference'] = PreferenceControleur::existe() ? PreferenceControleur::lire() : "voiture";
        self::afficherVue('web/vueGenerale.php',$parametres);
    }

    public static function enregistrerPreference() : void
    {
        $controleurDefaut = $_REQUEST['controleur_defaut'];

        if (!is_null($controleurDefaut)){
            PreferenceControleur::enregistrer($controleurDefaut);
            MessageFlash::ajouter("success","Votre préference " . $controleurDefaut . " a bien été enregistrée. (Tu as reçu un cookie !)");
        }
        else MessageFlash::ajouter("danger","Votre préference n'a pas pu être enregistrée.");

        self::redirectionVersURL('controleurFrontal.php?action=home');
    }
}