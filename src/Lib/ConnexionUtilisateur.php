<?php

namespace App\EldenBuild\Lib;

use App\EldenBuild\Modele\HTTP\Session;
use App\EldenBuild\Modele\Repository\UtilisateurRepository;

class ConnexionUtilisateur
{
    // L'utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";

    public static function connecter(string $loginUtilisateur): void
    {
        Session::getInstance()->enregistrer(self::$cleConnexion, $loginUtilisateur);
    }

    public static function estConnecte(): bool
    {
        return Session::getInstance()->contient(self::$cleConnexion);
    }

    public static function deconnecter(): void
    {
        Session::getInstance()->supprimer(self::$cleConnexion);
    }

    public static function getLoginUtilisateurConnecte(): ?string
    {
        return Session::getInstance()->lire(self::$cleConnexion);
    }

    public static function estUtilisateur($login): bool
    {
        return self::getLoginUtilisateurConnecte() == $login;
    }

    public static function estAdministrateur() : bool
    {
        if (!self::estConnecte()) return false;
        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire(self::getLoginUtilisateurConnecte());
        return $utilisateur->formatTableau()['estAdminTag'];
    }
}

