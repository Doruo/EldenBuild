<?php

namespace App\EldenBuild\Modele\DataObject;

class Build extends AbstractDataObject
{
    private ?int $idBuild;
    private string $nomBuild;
    private string $description;
    private string $dateCreation;
    private string $visibilite;

    public function __construct(?int $idBuild, string $nomBuild, string $description,string $dateCreation,string $visibilite)
    {
        $this->idBuild = $idBuild;
        $this->nomBuild = $nomBuild;
        $this->description = $description;
        $this->dateCreation = $dateCreation;
        $this->visibilite = $visibilite;
    }

    public function formatTableau(): array{
        return array(
            "loginTag" => $this->getIdBuild(),
            "mdpHacheTag" => $this->getNomBuild(),
            "emailTag" => $this->getDescription(),
            "emailAValiderTag" => $this->getDateCreation(),
            "nonceTag" => $this->getVisibilite()
        );
    }

    public static function construireDepuisFormulaire (array $tableauFormulaire) : Build {
        return new self(
            $tableauFormulaire['idBuild'] ?? null,
            $tableauFormulaire['nomBuild'],
            $tableauFormulaire['description'],
            $tableauFormulaire['dateCreation'],
            $tableauFormulaire['visibilite']
        );
    }

    /** GETTERS */

    public function getIdBuild(): ?int{return $this->idBuild;}

    public function getNomBuild(): string{return $this->nomBuild;}

    public function getDescription(): string{return $this->description;}

    public function getDateCreation(): string{return $this->dateCreation;}

    public function getVisibilite(): string{return $this->visibilite;}

    /** SETTERS */
}