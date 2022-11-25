<?php

class TacheGateway
{
    private Connection $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function insert(Tache $tache): void
    {
        $query = "INSERT INTO tache (nom, descriptionTache, importance, listeId) VALUES (:nom, :descriptionTache, :importance, :listeId)";
        $parameters = [
            ":nom" => [$tache->getNom(), PDO::PARAM_STR],
            ":descriptionTache" => [$tache->getDescriptionTache(), PDO::PARAM_STR],
            ":importance" => [$tache->getImportance(), PDO::PARAM_INT],
            ":listeId" => [$tache->getListeId(), PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

    public function supprimerTache(int $id): void
    {
        $query = "DELETE FROM tache WHERE id = :id";
        $parameters = [
            ":id" => [$id, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

    public function getTachesByListeId(int $listeId): array
    {
        $query = "SELECT * FROM tache WHERE listeId = :listeId";
        $parameters = [
            ":listeId" => [$listeId, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
        $results = $this->con->getResults();
        $taches = [];
        foreach ($results as $result) {
            $taches[] = new Tache($result["id"], $result["nom"], $result["descriptionTache"], $result["importance"], $result["dateCreation"], $result["dateModification"], $result["listeId"]);
        }
        return $taches;
    }

    public function modificationTache (Tache $tache) : void
    {
        $query = "UPDATE tache SET nom = :nom, descriptionTache = :descriptionTache, importance = :importance, dateModification = NOW() WHERE id = :id";
        $parameters = [
            ":nom" => [$tache->getNom(), PDO::PARAM_STR],
            ":descriptionTache" => [$tache->getDescriptionTache(), PDO::PARAM_STR],
            ":importance" => [$tache->getImportance(), PDO::PARAM_INT],
            ":id" => [$tache->getId(), PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

}


