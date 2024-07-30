<?php

namespace App\EldenBuild\Controleur;
use App\EldenBuild\Lib\ConnexionUtilisateur;
use App\EldenBuild\Lib\MessageFlash;
use App\EldenBuild\Lib\MotDePasse;
use App\EldenBuild\Lib\VerificationEmail;
use App\EldenBuild\Modele\DataObject\Utilisateur;
use App\EldenBuild\Modele\Repository\UtilisateurRepository;
use Random\RandomException;

class ControleurUtilisateur extends ControleurBase
{

    /** ------------------- READ ------------------- */

    // A SUPPRIMER A L'AVENIR (OPTIONNEL)
    public static function showList(): void
    {
        // Appel au modèle pour gérer la BD
        $utilisateurs = (new UtilisateurRepository())->recuperer();

        if (!$utilisateurs) {
            MessageFlash::ajouter("warning","No User Found");
            self::home();
            return;
        }

        $parametres = array(
            "utilisateurs" => $utilisateurs,
            "pagetitle" => "Users",
            "cheminVueBody" => "/../utilisateur/liste.php"
        );

        self::afficherVueGenerale($parametres);
    }

    public static function info(): void
    {
        $login = $_REQUEST["login"];

        $parametres = array(
            "pagetitle" => "Profile: ".$login,
            "cheminVueBody" => "/../utilisateur/info.php"
        );

        if (is_null($login)){
            MessageFlash::ajouter("warning","No User Found");
            self::home();
            return;
        }

        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);

        if (!$utilisateur) {
            MessageFlash::ajouter("warning","Login inconnu");
            self::showList();
            return;
        }

        $parametres['utilisateur'] = $utilisateur;
        self::afficherVueGenerale($parametres);
    }

    /** ------------------- CREATE ------------------- */
    public static function showFormCreate(): void{
        $parametres = array(
            "pagetitle" => "Sign Up",
            "cheminVueBody" =>  "/../utilisateur/formulaireCreation.php"
        );
        self::afficherVueGenerale($parametres);
    }

    /**@throws RandomException */
    public static function create(): void
    {
        // MDP et ressaisie doivent etre les mêmes
        if ($_REQUEST['mdp'] != $_REQUEST['mdp2']){
            MessageFlash::ajouter("danger","Mots de passe doivent être identiques");
            self::redirect('/create');
            return;
        }

        // Login ne doit pas déjà exister dans la BD
        if (!is_null((new UtilisateurRepository())->recupererParClePrimaire($_REQUEST['login']))){
            MessageFlash::ajouter("warning","Ce login existe déjà");
            self::redirect('/create');
            return;
        }

        // Verif Adr mail valide
        /*
        if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
            MessageFlash::ajouter("warning","Veuillez saisir une adresse email valide");
            self::redirectionVersURL('controleurFrontal.php?action=creerDepuisFormulaire&controleur=utilisateur');
            return;
        }*/

        // Création Utilisateur
        $estUtilisateurAdmin = ConnexionUtilisateur::estAdministrateur();

        $utilisateurTableau = array(
            'login' => $_REQUEST['login'],
            'mdpHache' => MotDePasse::hacher($_REQUEST['mdp']),
            'email' => "",
            'emailAValider' => $_REQUEST['email'],
            'nonce' => MotDePasse::genererChaineAleatoire()
        );

        $utilisateurTableau['estAdmin'] = $estUtilisateurAdmin && (!is_null($_REQUEST['estAdmin'] || $_REQUEST['estAdmin'] = "on"));

        $utilisateur = Utilisateur::construireDepuisFormulaire($utilisateurTableau);

        (new UtilisateurRepository)->ajouter($utilisateur); // Ajoute utilisateur dans BD

        /*VerificationEmail::envoiEmailValidation($utilisateur);*/

        // Connecte le nouvelle utilisateur
        if (!$estUtilisateurAdmin) ConnexionUtilisateur::connecter($utilisateur->getLogin());

        MessageFlash::ajouter("success","Utilisateur ".$utilisateur->getLogin()." crée !");
        self::home();
    }

    /** ------------------- UPDATE ------------------- */

    public static function showFormModify(): void
    {
        $login = $_REQUEST['login'];

        if (!ConnexionUtilisateur::estAdministrateur() && !ConnexionUtilisateur::estUtilisateur($login)){
            MessageFlash::ajouter("warning","La mise à jour n’est possible que pour l’utilisateur connecté ou par un admin");
            self::redirect('/showFormModify&login='.$login);
            return;
        }

        $utilisateur = (new UtilisateurRepository)->recupererParClePrimaire($login);

        if (is_null($utilisateur)) {
            MessageFlash::ajouter("warning","Aucun Utilisateur " . $login);
            self::redirect('/showFormModify&login='.$login);
            return;
        }

        $parametres = array(
            "pagetitle" => "Modify User",
            "cheminVueBody" => "/../utilisateur/formulaireMiseAJour.php",

            "login" => $login,
            "mail" => $utilisateur->formatTableau()['emailTag']
        );
        self::afficherVueGenerale($parametres);
    }

    /** @throws RandomException */
    public static function modify(): void
    {
        $utilisateurEstAdmin = ConnexionUtilisateur::estAdministrateur();

        $login = $_REQUEST['login'];
        if (!$utilisateurEstAdmin) $ancienMdp = $_REQUEST['ancienMdp'];
        $mdp = $_REQUEST['mdp'];
        $mdp2 = $_REQUEST['mdp2'];
        $estAdmin = $_REQUEST['estAdmin'];
        $mail = $_REQUEST['email'];

        // vérifiez que tous les champs obligatoires du formulaire ont été transmis
        if (is_null($login) || is_null($mdp) || is_null($mdp2) || is_null($mail) ||(!$utilisateurEstAdmin && is_null($ancienMdp)))
        {
            MessageFlash::ajouter("warning","Please fill all necessary fields");
            self::redirect('/showFormModify&login='.$login);
            return;
        }

        /** @var Utilisateur $utilisateur */
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);

        // Vérifiez que le login existe
        if (is_null($utilisateur)){
            MessageFlash::ajouter("warning","No user found");
            self::redirect('/showFormModify&login='.$login);
            return;
        }

        // Vérifiez que l’utilisateur mis-à-jour correspond à l’utilisateur connecté
        if (!$utilisateurEstAdmin && !ConnexionUtilisateur::estUtilisateur($login)){
            MessageFlash::ajouter("warning","Action only possible by admin");
            self::redirect('/showFormModify&login='.$login);
            return;
        }

        // Vérifiez que les 2 nouveaux mots de passe coïncident
        if ($mdp != $mdp2){
            MessageFlash::ajouter("warning","Mots de passe identiques dans les deux champs requis");
            self::redirect('/showFormModify&login='.$login);
            return;
        }

        // Vérifiez que l’ancien mot de passe est correct
        if (!$utilisateurEstAdmin && isset($ancienMdp) && !MotDePasse::verifier($ancienMdp, $utilisateur->formatTableau()['mdpTag'])){
            MessageFlash::ajouter("warning","Wrong former password");
            self::redirect('/showFormModify&login='.$login);
            return;
        }

        $utilisateur->setMdpHache(MotdePasse::hacher($mdp));
        $utilisateur->setEmailAValider($mail);

        $utilisateur->setNonce(MotDePasse::genererChaineAleatoire());
        VerificationEmail::envoiEmailValidation($utilisateur);

        if (ConnexionUtilisateur::estConnecte() && !$utilisateurEstAdmin) $utilisateur->setAdmin(false);
        else $utilisateur->setAdmin($estAdmin == "on");

        (new UtilisateurRepository())->mettreAJour($utilisateur);

        MessageFlash::ajouter("success","User ".$utilisateur->getLogin()." updated !");
        self::redirect('/info&login='.$utilisateur->getLogin());
    }

    /** ------------------- DELETE ------------------- */

    public static function delete(): void
    {
        $login = $_REQUEST['login'];

        // vérifiez que tous les champs obligatoires du formulaire ont été transmis
        if (is_null($login)) {
            MessageFlash::ajouter("danger","Login is empty");
            self::redirect('/showList');
            return;
        }

        // Vérifiez que le login existe
        if (is_null((new UtilisateurRepository())->recupererParClePrimaire($login))){
            MessageFlash::ajouter("danger","No User Found");
            self::redirect('/showList');
            return;
        }

        // Vérifiez que l’utilisateur supprimé correspond à l’utilisateur connecté
        if (!ConnexionUtilisateur::estUtilisateur($login) && !ConnexionUtilisateur::estAdministrateur()){
            MessageFlash::ajouter("warning","You don't have permission to delete user ".$login);
            self::redirect('/showList');
            return;
        }

        // Déconnecte l'utilisateur si il correspond à celui supprimé
        if (ConnexionUtilisateur::estUtilisateur($login) && ConnexionUtilisateur::estConnecte())
            ConnexionUtilisateur::deconnecter();

        if ((new UtilisateurRepository())->supprimer($login))
            MessageFlash::ajouter("success","User ".$login." deleted !");

        else MessageFlash::ajouter("danger","Error trying to delete user ".$login);

        self::redirect('/showList');
    }

    /** ------------------- SESSIONS (CONNEXION) ------------------- */

    public static function showFormConnect(): void
    {
        $parametres = array(
            "pagetitle" => "Log In",
            "cheminVueBody" =>  "/../utilisateur/formulaireConnexion.php"
        );
        self::afficherVueGenerale($parametres);
    }

    public static function connect(): void
    {
        $login = $_REQUEST['login'];
        $mail = $_REQUEST['mail'];
        $mdp = $_REQUEST['mdp'];

        /** @var Utilisateur $utilisateur */
        $utilisateur = (new UtilisateurRepository)->recupererParClePrimaire($login);

        if (is_null($login) || is_null($mdp)){
            MessageFlash::ajouter("warning","Login or password missing");
            self::redirect('/showFormConnect');
            return;
        }

        if (is_null($mail)) {
            MessageFlash::ajouter("danger","Email is empty");
            self::redirect('/showFormConnect');
            return;
        }

        // Verif Adr mail valide
        /*
        if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
            MessageFlash::ajouter("warning","Veuillez saisir une adresse email valide");
            self::redirectionVersURL('controleurFrontal.php?action=creerDepuisFormulaire&controleur=utilisateur');
            return;
        }*/


        if (is_null($utilisateur)) {
            MessageFlash::ajouter("danger","This user does not exist");
            self::redirect('/showFormConnect');
            return;
        }

        if ($utilisateur->getEmail() != $mail && $utilisateur->getEmailAValider() != $mail) {
            MessageFlash::ajouter("danger","Wrong mail adress");
            self::redirect('/showFormConnect');
            return;
        }

        if (!MotDePasse::verifier($mdp, $utilisateur->formatTableau()['mdpHacheTag'])) {
            MessageFlash::ajouter("danger","Wrong password");
            self::redirect('/showFormConnect');
            return;
        }

        ConnexionUtilisateur::connecter($login);

        MessageFlash::ajouter("success","Bienvenue ".$login." !");
        self::redirect('/home');
    }

    /** ------------------- SESSIONS (DECONNEXION) ------------------- */

    public static function disconnect(): void {
        ConnexionUtilisateur::deconnecter();
        MessageFlash::ajouter("success","User Disconnected");
        self::home();
    }

    /** ------------------- VERIFICATION MAIL ------------------- */

    public static function validateEmail() : void
    {
        $login = $_REQUEST['login']; $nonce = $_REQUEST['nonce'];

        if (is_null($login) || is_null($nonce)){
            MessageFlash::ajouter("warning","Login et/ou mot de passe manquant");
            return;
        }

        if (!VerificationEmail::traiterEmailValidation($login,$nonce)){
            MessageFlash::ajouter("warning","Problème lors du traitement de la validation par email");
            return;
        }

        MessageFlash::ajouter("success","Votre vérification par mail a bien été confirmée !");
        self::home();
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