<?php

namespace App\EldenBuild\Controleur;
abstract class ControleurBase extends ControleurGenerique
{
    /** ------------------- READ ------------------- */
    protected abstract static function info(); // *

    /** ------------------- CREATE ------------------- */
    protected abstract static function showFormCreate();
    protected abstract static function create();

    /** ------------------- UPDATE ------------------- */
    protected abstract static function showFormModify();
    protected abstract static function modify();

    /** ------------------- DELETE ------------------- */
    protected abstract static function delete();

    /** ------------------- * ------------------- */
}