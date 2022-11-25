<?php

class TacheGateway
{
    private Connection $con;

    /**
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * @param $nom
     * @param $descriptionTache
     * @param $importance
     * @return bool
     */
    public function insertTache($nom, $descriptionTache, $importance)
    {
        $query = "INSERT INTO Tache (nom, descriptionTache, importance) VALUES (:nom, :descriptionTache, :importance)";
        $parameters = [
            ":nom" => [$nom, PDO::PARAM_STR],
            ":descriptionTache" => [$descriptionTache, PDO::PARAM_STR],
            ":importance" => [$importance, PDO::PARAM_INT]
        ];
        return $this->con->executeQuery($query, $parameters);
    }

    /**
     * @return Tache[]
     */
    public function updateTache($id, $nom, $descriptionTache, $importance)
    {
        $query = "UPDATE Tache SET nom = :nom, descriptionTache = :descriptionTache, importance = :importance, dateModification = NOW() WHERE id = :id";
        $parameters = [
            ':id' => [$id, PDO::PARAM_INT],
            ':nom' => [$nom, PDO::PARAM_STR],
            ':descriptionTache' => [$descriptionTache, PDO::PARAM_STR],
            ':importance' => [$importance, PDO::PARAM_INT],
        ];
        return $this->con->executeQuery($query, $parameters);
    }

    /**
     * @param int $id
     */
    public function deleteTache(int $id)
    {
        $query = "DELETE FROM Tache WHERE id = :id";
        $this->con->executeQuery($query, [
            ':id' => [$id, PDO::PARAM_INT]
        ]);
    }

    /**
     * @param int $id
     * @return Tache
     */
    public function getTache(int $id) : Tache
    {
        $query = "SELECT * FROM Tache WHERE id = :id";
        $this->con->executeQuery($query, [
            ':id' => [$id, PDO::PARAM_INT]
        ]);
        $result = $this->con->getResults();
        return new Tache($result['id'], $result['nom'], $result['descriptionTache'], $result['importance'], $result['dateCreation'], $result['dateModification']);
    }

    /**
     * @return Tache[]
     */
    public function getTaches() : array
    {
        $query = "SELECT * FROM Tache";
        $this->con->executeQuery($query);
        $results = $this->con->getResults();
        $taches = [];
        foreach ($results as $ligne) {
            $taches[] = new Tache($ligne['id'], $ligne['nom'], $ligne['descriptionTache'], $ligne['importance'], $ligne['dateCreation'], $ligne['dateModification']);
        }
        return $taches;
    }
}