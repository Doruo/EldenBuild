<?php
namespace App\Covoiturage\Modele\DataObject;

class Utilisateur extends AbstractDataObject {

    private string $login;
    private string $nom;
    private string $prenom;
    private string $mdpHache;
    private bool $estAdmin;
    private string $email;
    private string $emailAValider;

    private string $nonce;

    public function __construct(string $login, string $nom, string $prenom, string $mdpHache, mixed $estAdmin, string $email,string $emailAValider,string $nonce)
    {
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdpHache = $mdpHache;
        $this->estAdmin = $estAdmin;
        $this->email = $email;
        $this->emailAValider = $emailAValider;
        $this->nonce = $nonce;
    }

    public function formatTableau(): array{
        return array(
            "loginTag" => $this->getLogin(),
            "nomTag" => $this->getNom(),
            "prenomTag" => $this->getPrenom(),
            "mdpHacheTag" => $this->getMdpHache(),
            "estAdminTag" => $this->estAdmin(),
            "emailTag" => $this->getEmail(),
            "emailAValiderTag" => $this->getEmailAValider(),
            "nonceTag" => $this->getNonce()
        );
    }

    public static function construireDepuisFormulaire (array $tableauFormulaire) : Utilisateur {
        return new self(
            $tableauFormulaire['login'],
            $tableauFormulaire['nom'],
            $tableauFormulaire['prenom'],
            $tableauFormulaire['mdpHache'],
            $tableauFormulaire['estAdmin'],
            $tableauFormulaire['email'],
            $tableauFormulaire['emailAValider'],
            $tableauFormulaire['nonce']
        );
    }

    /** GETTERS */
    public function getLogin(): string {return $this->login;}
    public function getNom(): string {return $this->nom;}
    public function getPrenom(): string {return $this->prenom;}
    public function getMdpHache(): string {return $this->mdpHache;}
    public function estAdmin(): bool{return $this->estAdmin;}
    public function getNonce(): string{return $this->nonce;}
    public function getEmail(): string{return $this->email;}
    public function getEmailAValider(): string{return $this->emailAValider;}

    /** SETTERS */
    public function setNom(string $nom): void{$this->nom = $nom;}
    public function setPrenom(string $prenom): void{$this->prenom = $prenom;}
    public function setAdmin(bool $estAdmin): void{$this->estAdmin = $estAdmin;}
    public function setMdpHache(string $mdpHache): void {$this->mdpHache = $mdpHache;}
    public function setEmail(string $email): void{$this->email = $email;}
    public function setEmailAValider(string $emailAValider): void{$this->emailAValider = $emailAValider;}
    public function setNonce(string $nonce): void{$this->nonce = $nonce;}
}