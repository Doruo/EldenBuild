<?php
namespace App\Covoiturage\Configuration;
abstract class ConfigurationBaseDeDonnees{

    // Le nom d'hote est webinfo a l'IUT
    // ou localhost sur votre machine
    // ou webinfo.iutmontp.univ-montp2.fr
    // pour accéder à webinfo depuis l'extérieur
    static private array $configurationBaseDeDonnees = array(
        'nomHote' => 'localhost',
        'nomBaseDeDonnees' => 'HAYE',
        'port' => '3306',
        'login' => 'root',
        'motDePasse' => '!Fp!d].d7N]Ir5]C'
    );

    static public function getLogin(): string{
        return self::$configurationBaseDeDonnees['login'];
    }

    static public function getNomHote(): string{
        return self::$configurationBaseDeDonnees['nomHote'];
    }

    static public function getNomBaseDeDonnees(): string{
        return self::$configurationBaseDeDonnees['nomBaseDeDonnees'];
    }

    static public function getMotDePasse(): string{
        return self::$configurationBaseDeDonnees['motDePasse'];
    }

    static public function getPort(): string{
        return self::$configurationBaseDeDonnees['port'];
    }
}