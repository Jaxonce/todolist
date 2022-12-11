<?php

class TaskGateway
{
    private Connection $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function insert(Task $tache): void
    {
        $query = "INSERT INTO Task (nom, descriptionTache, importance, listeId) VALUES (:nom, :descriptionTache, :importance, :listeId)";
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
        $query = "DELETE FROM Task WHERE id = :id";
        $parameters = [
            ":id" => [$id, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

    public function getTachesByListeId(int $listeId): array
    {
        $query = "SELECT * FROM Task WHERE listeId = :listeId";
        $parameters = [
            ":listeId" => [$listeId, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
        return $this->con->getResults();
    }

    public function modificationTache (Task $tache) : void
    {
        $query = "UPDATE Task SET nom = :nom, descriptionTache = :descriptionTache, importance = :importance, dateModification = NOW() WHERE id = :id";
        $parameters = [
            ":nom" => [$tache->getNom(), PDO::PARAM_STR],
            ":descriptionTache" => [$tache->getDescriptionTache(), PDO::PARAM_STR],
            ":importance" => [$tache->getImportance(), PDO::PARAM_INT],
            ":id" => [$tache->getId(), PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

    public function insertPublic(Task $task)
    {
        $query = "INSERT INTO Task (nom, descriptionTache, importance, listeId) VALUES (:nom, :descriptionTache, :importance, :listeId)";
        $parameters = [
            ":nom" => [$task->getNom(), PDO::PARAM_STR],
            ":descriptionTache" => [$task->getDescriptionTache(), PDO::PARAM_STR],
            ":importance" => [$task->getImportance(), PDO::PARAM_INT],
            ":listeId" => [$task->getListeId(), PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

    public function deletePublicTask(int $id)
    {
        $query = "DELETE FROM Task WHERE id = :id AND listeId IN (SELECT id FROM Liste WHERE possesseur IS NULL)";
        $parameters = [
            ":id" => [$id, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

}


