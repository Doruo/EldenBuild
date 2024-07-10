<?php
namespace App\Covoiturage\Modele\Repository;
use App\Covoiturage\Modele\DataObject\Utilisateur;
class UtilisateurRepository extends AbstractRepository
{
    /** ------------------- CREATE ------------------- */

    protected function construireDepuisTableau(array $objetFormatTableau) : Utilisateur {
        return new Utilisateur(
            $objetFormatTableau["login"],
            $objetFormatTableau["nom"],
            $objetFormatTableau["prenom"],
            $objetFormatTableau["mdpHache"],
            $objetFormatTableau["estAdmin"],
            $objetFormatTableau["email"],
            $objetFormatTableau["emailAValider"],
            $objetFormatTableau["nonce"]

        );
    }

    protected function getNomTable(): string {return "utilisateur"; }

    protected function getNomClePrimaire(): string {return "login";}

    protected function getNomsColonnes(): array {
        return ["login", "nom", "prenom", "mdpHache","estAdmin","email","emailAValider","nonce"];
    }
}