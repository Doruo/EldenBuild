<?php

namespace App\EldenBuild\Controleur;

class ControleurBuild extends ControleurBase
{
    public static function info():void
    {
        // TODO: Implement info() method.
    }

    public static function showFormCreate():void
    {
        $parametres = array(
            "pagetitle" => "New Build",
            "cheminVueBody" =>  "/../build/formulaireCreation.php"
        );
        self::afficherVueGenerale($parametres);
    }

    public static function create() : void
    {
        // TODO: Implement create() method.
    }

    public static function showFormModify():void
    {
        // TODO: Implement showFormModify() method.
    }

    public static function modify():void
    {
        // TODO: Implement modify() method.
    }

    public static function delete():void
    {
        // TODO: Implement delete() method.
    }
}