<?php

namespace App\EldenBuild\Controleur;

class ControleurEquipement extends ControleurGenerique
{
    public static function info() : void
    {
        $parametres = array(
            "pagetitle" => "TEST API",
            "cheminVueBody" => "/../equipement/info.php"
        );
        self::afficherVueGenerale($parametres);
    }

    protected static function add():void
    {
        // TODO: Implement info() method.
    }

    protected static function remove():void
    {
        // TODO: Implement info() method.
    }
}