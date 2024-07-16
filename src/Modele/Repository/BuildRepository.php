<?php

namespace App\EldenBuild\Modele\Repository;

use App\EldenBuild\Modele\DataObject\Build;

class BuildRepository extends AbstractRepository
{
    protected function construireDepuisTableau(array $objetFormatTableau): Build
    {
        return new Build(
            $objetFormatTableau['idBuild'] ?? null,
            $objetFormatTableau['nomBuild'],
            $objetFormatTableau['description'],
            $objetFormatTableau['dateCreation'],
            $objetFormatTableau['visibilite']
        );
    }

    protected function getNomTable(): string {return "builds";}

    protected function getNomsColonnes(): array{
        return ["idBuild", "nomBuild","description","dateCreation","visibilite"];
    }

    protected function getNomClePrimaire(): string {return "idBuild";}
}