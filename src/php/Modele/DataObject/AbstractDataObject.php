<?php

namespace App\EldenBuild\Modele\DataObject;

abstract class AbstractDataObject{
    public abstract function formatTableau(): array;
    public abstract static function construireDepuisFormulaire (array $tableauFormulaire) : AbstractDataObject;
}