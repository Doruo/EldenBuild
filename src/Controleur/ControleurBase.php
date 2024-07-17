<?php

namespace App\EldenBuild\Controleur;
abstract class ControleurBase extends ControleurGenerique
{
    /** ------------------- READ ------------------- */
    protected abstract static function info():void; // *

    /** ------------------- CREATE ------------------- */
    protected abstract static function showFormCreate():void;
    protected abstract static function create():void;

    /** ------------------- UPDATE ------------------- */
    protected abstract static function showFormModify():void;
    protected abstract static function modify():void;

    /** ------------------- DELETE ------------------- */
    protected abstract static function delete():void;

    /** ------------------- * ------------------- */
}