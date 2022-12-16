<?php

/**
 *
 */
class TaskGateway
{
    /**
     * @var Connection
     */
    private Connection $con;

    /**
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * @param Task $tache
     * @return void
     */
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

    /**
     * @param int $listeId
     * @return array
     */
    public function getTachesByListeId(int $listeId): array
    {
        $query = "SELECT * FROM Task WHERE listeId = :listeId";
        $parameters = [
            ":listeId" => [$listeId, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
        return $this->con->getResults();
    }

    /**
     * @param Task $tache
     * @return void
     */
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

    /**
     * @param Task $task
     * @return void
     */
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

    /**
     * @param int $id
     * @return void
     */
    public function deletePublicTask(int $id)
    {
        $query = "DELETE FROM Task WHERE id = :id AND listeId IN (SELECT id FROM Liste WHERE possesseur IS NULL)";
        $parameters = [
            ":id" => [$id, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

    /**
     * @param int $idUser
     * @param int $idTask
     * @return void
     */
    public function delete(int $idUser, int $idTask)
    {
        $query = "DELETE FROM Task WHERE id = :id AND listeId IN (SELECT id FROM Liste WHERE possesseur = :idUser)";
        $parameters = [
            ":id" => [$idTask, PDO::PARAM_INT],
            ":idUser" => [$idUser, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

    /**
     * @param int $idTask
     * @return void
     */
    public function changeDone(int $idTask)
    {
        $query = "UPDATE Task SET fait = NOT fait WHERE id = :id";
        $parameters = [
            ":id" => [$idTask, PDO::PARAM_INT]
        ];
        $this->con->executeQuery($query, $parameters);
    }

}


