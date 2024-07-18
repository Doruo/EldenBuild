<?php
namespace App\EldenBuild\Modele\DataObject;

class Utilisateur extends AbstractDataObject {

    private string $login;
    private string $mdpHache;
    private bool $estAdmin;
    private string $email;
    private string $emailAValider;

    private string $nonce;

    public function __construct(string $login, string $mdpHache, string $email,string $emailAValider,string $nonce, mixed $estAdmin)
    {
        $this->login = $login;
        $this->mdpHache = $mdpHache;
        $this->email = $email;
        $this->emailAValider = $emailAValider;
        $this->nonce = $nonce;
        $this->estAdmin = $estAdmin;
    }

    public function formatTableau(): array{
        return array(
            "loginTag" => $this->getLogin(),
            "mdpHacheTag" => $this->getMdpHache(),
            "emailTag" => $this->getEmail(),
            "emailAValiderTag" => $this->getEmailAValider(),
            "nonceTag" => $this->getNonce(),
            "estAdminTag" => $this->estAdmin()
        );
    }

    public static function construireDepuisFormulaire (array $tableauFormulaire) : Utilisateur {
        return new self(
            $tableauFormulaire['login'],
            $tableauFormulaire['mdpHache'],
            $tableauFormulaire['email'],
            $tableauFormulaire['emailAValider'],
            $tableauFormulaire['nonce'],
            $tableauFormulaire['estAdmin'],
        );
    }

    /** GETTERS */
    public function getLogin(): string {return $this->login;}
    public function getMdpHache(): string {return $this->mdpHache;}
    public function estAdmin(): bool{return $this->estAdmin;}
    public function getNonce(): string{return $this->nonce;}
    public function getEmail(): string{return $this->email;}
    public function getEmailAValider(): string{return $this->emailAValider;}

    /** SETTERS */
    public function setNom(string $nom): void{$this->nom = $nom;}
    public function setMdpHache(string $mdpHache): void {$this->mdpHache = $mdpHache;}
    public function setEmail(string $email): void{$this->email = $email;}
    public function setEmailAValider(string $emailAValider): void{$this->emailAValider = $emailAValider;}
    public function setNonce(string $nonce): void{$this->nonce = $nonce;}
    public function setAdmin(false $estAdmin): void{$this->estAdmin = $estAdmin;}
}