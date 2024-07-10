<?php

namespace App\Covoiturage\Lib;

use Random\RandomException;

abstract class MotDePasse
{
    private static string $poivre = "SfxZqax7IojrVndyXNaFPU";

    public static function hacher(string $mdpClair): string
    {
        $mdpPoivre = hash_hmac("sha256", $mdpClair, self::$poivre);
        return password_hash($mdpPoivre, PASSWORD_DEFAULT);
    }

    public static function verifier(string $mdpClair, string $mdpHache): bool
    {
        $mdpPoivre = hash_hmac("sha256", $mdpClair, self::$poivre);
        return password_verify($mdpPoivre, $mdpHache);
    }

    /** @throws RandomException */
    public static function genererChaineAleatoire(int $nbCaracteres = 22): string
    {
        // 22 caractères par défaut pour avoir au moins 128 bits aléatoires
        // 1 caractère = 6 bits car 64=2^6 caractères en base_64
        // et 128 <= 22*6 = 132
        $octetsAleatoires = random_bytes(ceil($nbCaracteres * 6 / 8));
        return substr(base64_encode($octetsAleatoires), 0, $nbCaracteres);
    }
}

// Pour créer votre poivre (une seule fois)
//var_dump(MotDePasse::genererChaineAleatoire());
