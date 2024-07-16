<?php

namespace App\EldenBuild\Modele\DataObject;

class Build extends AbstractDataObject
{
    private ?int $idBuild;
    private string $nomBuild;
    private string $description;
    private string $dateCreation;
    private string $visibilite;
    private string $login;

    public function __construct(?int $idBuild, string $nomBuild, string $description,string $dateCreation,string $visibilite,string $login)
    {
        $this->idBuild = $idBuild;
        $this->nomBuild = $nomBuild;
        $this->description = $description;
        $this->dateCreation = $dateCreation;
        $this->visibilite = $visibilite;
        $this->login = $login;
    }

    public function formatTableau(): array {
        return array(
            "idBuildTag" => $this->getIdBuild(),
            "nomBuildTag" => $this->getNomBuild(),
            "descriptionTag" => $this->getDescription(),
            "dateCreationTag" => $this->getDateCreation(),
            "visibiliteTag" => $this->getVisibilite(),
            "loginTag" => $this->getLogin()
        );
    }

    public static function construireDepuisFormulaire (array $tableauFormulaire) : Build {
        return new self(
            $tableauFormulaire['idBuild'] ?? null,
            $tableauFormulaire['nomBuild'],
            $tableauFormulaire['description'],
            $tableauFormulaire['dateCreation'],
            $tableauFormulaire['visibilite'],
            $tableauFormulaire['login']
        );
    }

    /** GETTERS */

    public function getIdBuild(): ?int{return $this->idBuild;}

    public function getNomBuild(): string{return $this->nomBuild;}

    public function getDescription(): string{return $this->description;}

    public function getDateCreation(): string{return $this->dateCreation;}

    public function getVisibilite(): string{return $this->visibilite;}

    public function getLogin(): string{return $this->login;}

    /** SETTERS */
}