<?php
namespace App\Covoiturage\Modele\Repository;
use App\Covoiturage\Modele\DataObject\AbstractDataObject;
use PDO;
use PDOException;

abstract class AbstractRepository
{
    /** ------------------- CREATE ------------------- */
    protected abstract function construireDepuisTableau(array $objetFormatTableau) : AbstractDataObject;

    public function ajouter(AbstractDataObject $object) : bool {

        try {
            $colonnes = $this->getNomsColonnes();
            $valeurs = [];
            $params = [];

            foreach ($colonnes as $nomColonne) {
                $valeurs[] = ":$nomColonne";
                $params[$nomColonne] = $object->formatTableau()[$nomColonne . "Tag"];
            }

            $sql = "INSERT INTO " . $this->getNomTable() . " (".implode(", ", $colonnes).") VALUES (".implode(", ", $valeurs).")";

            $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->prepare($sql);
            foreach ($params as $key => $value) {
                $pdoStatement->bindValue(":$key", $value);
            }

            return $pdoStatement->execute();
        } catch (PDOException) {return false;}
    }


    /** ------------------- READ ------------------- */
    public function recuperer() : array {

        $sql = "SELECT * FROM " . $this->getNomTable();
        $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->query($sql);
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $objets = [];
        foreach ($pdoStatement as $objetTableau)
            if (!is_null($objetTableau))
                $objets[] = $this->construireDepuisTableau($objetTableau);

        return $objets;
    }

    public function recupererParClePrimaire(string $valeurClePrimaire): ?AbstractDataObject{

        $sql = "SELECT * FROM " . $this->getNomTable() . " WHERE " . $this->getNomClePrimaire() . " = :valeurClePrimaire";

        $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->prepare($sql);

        $pdoStatement->bindParam("valeurClePrimaire",$valeurClePrimaire);
        $pdoStatement->execute();

        $objetFormatTableau = $pdoStatement->fetch();

        if (!$objetFormatTableau) return null;
        return $this->construireDepuisTableau($objetFormatTableau);
    }

    /** ------------------- UPDATE ------------------- */

    public function mettreAJour(AbstractDataObject $object): void
    {
        $valeurs = [];
        foreach ($this->getNomsColonnes() as $nomColonne)
            if ($nomColonne != $this->getNomClePrimaire())
                $valeurs [] = "$nomColonne = '" . $object->formatTableau()[$nomColonne."Tag"] ."'";

        $sql = "UPDATE " . $this->getNomTable() . " 
                SET " . implode(', ', $valeurs) . "
                WHERE " . $this->getNomTable() . "." . $this->getNomClePrimaire() . " = :valeurClePrimaire";

        $param = array("valeurClePrimaire" => $object->formatTableau()[$this->getNomClePrimaire()."Tag"]);

        $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->prepare($sql);
        $pdoStatement->execute($param);
    }

    /** ------------------- DELETE ------------------- */
    public function supprimer (string $valeurClePrimaire): bool
    {
        $sql = "DELETE FROM " . $this->getNomTable() . " WHERE " . $this->getNomClePrimaire() . " = :valeurClePrimaire";

        $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->prepare($sql);

        $values = array("valeurClePrimaire" => $valeurClePrimaire);

        return $pdoStatement->execute($values);
    }

    /** ------------------- GETTERS ------------------- */
    protected abstract function getNomTable() : string;

    protected abstract function getNomsColonnes(): array;

    protected abstract function getNomClePrimaire() : string;
}