<?php
namespace App\EldenBuild\Modele\Repository;
use App\EldenBuild\Modele\DataObject\Utilisateur;
class UtilisateurRepository extends AbstractRepository
{
    /** ------------------- CREATE ------------------- */

    protected function construireDepuisTableau(array $objetFormatTableau) : Utilisateur {
        return new Utilisateur(
            $objetFormatTableau["login"],
            $objetFormatTableau["mdpHache"],
            $objetFormatTableau["email"] ?? "",
            $objetFormatTableau["emailAValider"] ?? "",
            $objetFormatTableau["nonce"] ?? "",
            $objetFormatTableau["estAdmin"]
        );
    }
    protected function getNomTable(): string {return "users"; }

    protected function getNomClePrimaire(): string {return "login";}

    protected function getNomsColonnes(): array {
        return ["login", "mdpHache","estAdmin","email","emailAValider","nonce"];
    }
}