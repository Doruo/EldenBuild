<?php
namespace App\Covoiturage\Configuration;
abstract class ConfigurationSite
{
    private static array $configurationSite = array(
        'dureeExpiration' => 3600,
        'URLAbsolue' => "http://marchaye.freeboxos.fr/A2/DevWeb/TD/TDCOVOITURAGE/src/vue/web/controleurFrontal.php",
        'debug' => false
    );

    public static function getDureeExpiration(): int {
        return self::$configurationSite['dureeExpiration'];
    }

    public static function getURLAbsolue() : string {
        return self::$configurationSite['URLAbsolue'];
    }

    public static function getDebug(): bool{
        return self::$configurationSite['debug'];
    }

    public static function getMethodeForm() : string{
        return self::getDebug() ? "get" : "post";
    }
}