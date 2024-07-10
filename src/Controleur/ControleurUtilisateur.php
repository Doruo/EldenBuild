<?php

namespace App\Covoiturage\Controleur;
use App\Covoiturage\Lib\ConnexionUtilisateur;
use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Lib\MotDePasse;
use App\Covoiturage\Lib\VerificationEmail;
use App\Covoiturage\Modele\DataObject\Utilisateur;
use App\Covoiturage\Modele\Repository\UtilisateurRepository;
use Random\RandomException;

class ControleurUtilisateur extends ControleurGenerique
{

    /** ------------------- READ ------------------- */
    public static function afficherListe(): void
    {
        $utilisateurs = (new UtilisateurRepository())->recuperer();  //appel au modèle pour gérer la BD

        if (!$utilisateurs) {
            MessageFlash::ajouter("warning","Aucun Utilisateur");
            self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
            return;
        }

        $parametres = array(
            "utilisateurs" => $utilisateurs,
            "pagetitle" => "Liste des Utilisateurs",
            "cheminVueBody" => "/../utilisateur/liste.php"
        );

        self::afficherVue('/web/vueGenerale.php', $parametres);
    }

    public static function afficherDetail(): void
    {
        $login = $_REQUEST["login"];

        if (is_null($login)){
            MessageFlash::ajouter("warning","Aucun Login");
            self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
            return;
        }

        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);

        if (!$utilisateur) {
            MessageFlash::ajouter("warning","Login inconnu");
            self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
            return;
        }

        $parametres = array(
            "utilisateur" => $utilisateur,
            "pagetitle" => "Details Utilisateur",
            "cheminVueBody" => "/../utilisateur/detail.php"
        );

        self::afficherVue('web/vueGenerale.php', $parametres);
    }

    /** ------------------- CREATE ------------------- */
    public static function afficherFormulaireCreation(): void{
        $parametres = array(
            "pagetitle" => "Formulaire Utilisateur",
            "cheminVueBody" =>  "/../utilisateur/formulaireCreation.php"
        );
        self::afficherVue("web/vueGenerale.php", $parametres);
    }

    /**@throws RandomException */
    public static function creerDepuisFormulaire(): void
    {
        // MDP et ressaisie doivent etre les mêmes
        if ($_REQUEST['mdp'] != $_REQUEST['mdp2']){
            MessageFlash::ajouter("danger","Mots de passe doivent être identiques");
            self::redirectionVersURL('controleurFrontal.php?action=creerDepuisFormulaire&controleur=utilisateur');
            return;
        }

        // Login ne doit pas déjà exister dans la BD
        if (!is_null((new UtilisateurRepository())->recupererParClePrimaire($_REQUEST['login']))){
            MessageFlash::ajouter("warning","Ce login existe déjà");
            self::redirectionVersURL('controleurFrontal.php?action=creerDepuisFormulaire&controleur=utilisateur');
            return;
        }

        // Verif Adr mail valide
        if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
            MessageFlash::ajouter("warning","Veuillez saisir une adresse email valide");
            self::redirectionVersURL('controleurFrontal.php?action=creerDepuisFormulaire&controleur=utilisateur');
            return;
        }

        // Création Utilisateur
        $estUtilisateurAdmin = ConnexionUtilisateur::estAdministrateur();

        $utilisateurTableau = array(
            'login' => $_REQUEST['login'],
            'nom' => $_REQUEST['nom'],
            'prenom' => $_REQUEST['prenom'],
            'mdpHache' => MotDePasse::hacher($_REQUEST['mdp']),
            'email' => "",
            'emailAValider' => $_REQUEST['email'],
            'nonce' => MotDePasse::genererChaineAleatoire()
        );


        $utilisateurTableau['estAdmin'] = $estUtilisateurAdmin && (!is_null($_REQUEST['estAdmin'] || $_REQUEST['estAdmin'] = "on"));

        $utilisateur = Utilisateur::construireDepuisFormulaire($utilisateurTableau);
        (new UtilisateurRepository)->ajouter($utilisateur); // Ajoute utilisateur dans BD

        VerificationEmail::envoiEmailValidation($utilisateur);

        // Connecte le nouvelle utilisateur
        if (!$estUtilisateurAdmin) ConnexionUtilisateur::connecter($utilisateur->getLogin());

        MessageFlash::ajouter("success","Utilisateur ".$utilisateur->getLogin()." crée !");
        self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
    }

    /** ------------------- UPDATE ------------------- */

    public static function afficherFormulaireMiseAJour(): void
    {
        $login = $_REQUEST['login'];

        if (!ConnexionUtilisateur::estAdministrateur() && !ConnexionUtilisateur::estUtilisateur($login)){
            MessageFlash::ajouter("warning","La mise à jour n’est possible que pour l’utilisateur connecté ou par un admin");
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireMiseAJour&login='.$login.'&controleur=utilisateur');
            return;
        }

        $utilisateur = (new UtilisateurRepository)->recupererParClePrimaire($login);

        if (is_null($utilisateur)) {
            MessageFlash::ajouter("warning","Aucun Utilisateur " . $login);
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireMiseAJour&login='.$login.'&controleur=utilisateur');
            return;
        }

        $parametres = array(
            "pagetitle" => "Modifier un Utilisateur",
            "cheminVueBody" => "/../utilisateur/formulaireMiseAJour.php",

            "login" => $login,
            "nom" => $utilisateur->formatTableau()['nomTag'],
            "prenom" => $utilisateur->formatTableau()['prenomTag'],
            "mail" => $utilisateur->formatTableau()['emailTag']
        );
        self::afficherVue("web/vueGenerale.php",$parametres);
    }

    /** @throws RandomException */
    public static function mettreAJour(): void
    {
        $utilisateurEstAdmin = ConnexionUtilisateur::estAdministrateur();

        $login = $_REQUEST['login'];
        $nom = $_REQUEST['nom'];
        $prenom = $_REQUEST['prenom'];
        if (!$utilisateurEstAdmin) $ancienMdp = $_REQUEST['ancienMdp'];
        $mdp = $_REQUEST['mdp'];
        $mdp2 = $_REQUEST['mdp2'];
        $estAdmin = $_REQUEST['estAdmin'];
        $mail = $_REQUEST['email'];

        // vérifiez que tous les champs obligatoires du formulaire ont été transmis

        if (is_null($login) || is_null($nom) || is_null($prenom)
            || (!$utilisateurEstAdmin && is_null($ancienMdp))
            || is_null($mdp) || is_null($mdp2)) {

            MessageFlash::ajouter("warning","Remplissez bien tous les champs");
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireMiseAJour&login='.$login.'&controleur=utilisateur');
            return;
        }

        /** @var Utilisateur $utilisateur */
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);

        // Vérifiez que le login existe
        if (is_null($utilisateur)){
            MessageFlash::ajouter("warning","Aucun Utilisateur ".$login);
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireMiseAJour&login='.$login.'&controleur=utilisateur');
            return;
        }

        // Vérifiez que l’utilisateur mis-à-jour correspond à l’utilisateur connecté
        if (!$utilisateurEstAdmin && !ConnexionUtilisateur::estUtilisateur($login)){
            MessageFlash::ajouter("warning","La mise à jour n’est possible que pour l’utilisateur connecté ou par un admin");
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireMiseAJour&login='.$login.'&controleur=utilisateur');
            return;
        }

        // Vérifiez que les 2 nouveaux mots de passe coïncident
        if ($mdp != $mdp2){
            MessageFlash::ajouter("warning","Mots de passe identiques dans les deux champs requis");
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireMiseAJour&login='.$login.'&controleur=utilisateur');
            return;
        }

        // Vérifiez que l’ancien mot de passe est correct
        if (!$utilisateurEstAdmin && isset($ancienMdp) && !MotDePasse::verifier($ancienMdp, $utilisateur->formatTableau()['mdpTag'])){
            MessageFlash::ajouter("warning","Ancien mot de passe erroné");
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireMiseAJour&login='.$login.'&controleur=utilisateur');
            return;
        }

        $utilisateur->setNom($nom);
        $utilisateur->setPrenom($prenom);
        $utilisateur->setMdpHache(MotdePasse::hacher($mdp));
        $utilisateur->setEmailAValider($mail);

        $utilisateur->setNonce(MotDePasse::genererChaineAleatoire());
        VerificationEmail::envoiEmailValidation($utilisateur);

        if (ConnexionUtilisateur::estConnecte() && !$utilisateurEstAdmin) $utilisateur->setAdmin(false);
        else $utilisateur->setAdmin($estAdmin == "on");

        (new UtilisateurRepository())->mettreAJour($utilisateur);

        MessageFlash::ajouter("success","Utilisateur ".$utilisateur->getLogin()." mis à jour !");
        self::redirectionVersURL('controleurFrontal.php?action=afficherDetail&controleur=utilisateur&login='.$utilisateur->getLogin());
    }

    /** ------------------- DELETE ------------------- */

    public static function supprimer(): void
    {
        $login = $_REQUEST['login'];

        // vérifiez que tous les champs obligatoires du formulaire ont été transmis
        if (is_null($login)) {
            MessageFlash::ajouter("danger","Login inexistant");
            self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
            return;
        }

        // Vérifiez que le login existe
        if (is_null((new UtilisateurRepository())->recupererParClePrimaire($login))){
            MessageFlash::ajouter("danger","Aucun utilisateur " . $login);
            self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
            return;
        }


        // Vérifiez que l’utilisateur supprimé correspond à l’utilisateur connecté
        if (!ConnexionUtilisateur::estUtilisateur($login) && !ConnexionUtilisateur::estAdministrateur()){
            MessageFlash::ajouter("warning","La mise à jour n’est possible que pour l’utilisateur connecté");
            self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
            return;
        }


        // Déconnecte l'utilisateur si il correspond à celui supprimé
        if (ConnexionUtilisateur::estUtilisateur($login) && ConnexionUtilisateur::estConnecte())
            ConnexionUtilisateur::deconnecter();

        if ((new UtilisateurRepository())->supprimer($login))
            MessageFlash::ajouter("success","L'utilisateur a bien été supprimé !");

        else MessageFlash::ajouter("danger","La supression n'a pas pu avoir lieu.");

        self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
    }

    /** ------------------- SESSIONS (CONNEXION) ------------------- */

    public static function afficherFormulaireConnexion(): void
    {
        $parametres = array(
            "pagetitle" => "Site Covoiturage - Inscription",
            "cheminVueBody" =>  "/../utilisateur/formulaireConnexion.php"
        );

        self::afficherVue("web/vueGenerale.php", $parametres);
    }

    public static function connecter(): void
    {
        $login = $_REQUEST['login'];
        $mdp = $_REQUEST['mdp'];

        /** @var Utilisateur $utilisateur */
        $utilisateur = (new UtilisateurRepository)->recupererParClePrimaire($login);

        if (is_null($login) || is_null($mdp)){
            MessageFlash::ajouter("warning","Login et/ou mot de passe manquant");
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireConnexion&controleur=utilisateur');
            return;
        }

        if (is_null($utilisateur)) {
            MessageFlash::ajouter("danger","Cette utilisateur n'existe pas");
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireConnexion&controleur=utilisateur');
            return;
        }

        if (!MotDePasse::verifier($mdp, $utilisateur->formatTableau()['mdpHacheTag'])) {
            MessageFlash::ajouter("danger","Mot de passe erroné");
            self::redirectionVersURL('controleurFrontal.php?action=afficherFormulaireConnexion&controleur=utilisateur');
            return;
        }

        ConnexionUtilisateur::connecter($login);

        MessageFlash::ajouter("success","Bienvenue ".$login." !");
        self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
    }

    /** ------------------- SESSIONS (DECONNEXION) ------------------- */

    public static function deconnecter(): void {
        ConnexionUtilisateur::deconnecter();
        MessageFlash::ajouter("success","Utilisateur déconnecté.");
        self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
    }

    /** ------------------- VERIFICATION MAIL ------------------- */

    public static function validerEmail() : void
    {
        $login = $_REQUEST['login']; $nonce = $_REQUEST['nonce'];

        if (is_null($login) || is_null($nonce)){
            MessageFlash::ajouter("warning","Login et/ou mot de passe manquant");
            self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
            return;
        }

        if (!VerificationEmail::traiterEmailValidation($login,$nonce)){
            MessageFlash::ajouter("warning","Problème lors du traitement de la validation par email");
            self::redirectionVersURL('controleurFrontal.php?action=afficherListe&controleur=utilisateur');
            return;
        }

        MessageFlash::ajouter("success","Votre vérification par mail a bien été confirmée !");
        self::redirectionVersURL('controleurFrontal.php?action=afficherDetail&controleur=utilisateur&login='.$login);
    }

    /** ------------------- COOKIES ------------------- */

    /*
    public static function deposerCookie(): void{
        Cookie::enregistrer("cookieTest","OK",time()+3600);
    }

    public static function lireCookie(): mixed {
        $valeur = Cookie::lire("cookieTest");
        echo $valeur;
        return $valeur;
    }
    */
}