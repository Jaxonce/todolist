<?php

class ArtisteGateway
{
    private $con;

    /**
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * @param $titre
     * @param $description
     * @param $priorite
     * @return bool
     */
    public function insert($titre, $description, $priorite)
    {
        $query = "INSERT INTO tache (titre, description,priorite) VALUES (:titre, :description, :priorite)";
        $parameters = [
            ':titre' => [$titre, PDO::PARAM_STR],
            ':description' => [$description, PDO::PARAM_STR],
            ':priorite' => [$priorite, PDO::PARAM_INT]
        ];
        return $this->con->executeQuery($query, $parameters);
    }

    /**
     * @param $id
     * @param $titre
     * @param $description
     * @param $priorite
     * @return bool
     */
    public function update($id, $titre, $description, $priorite)
    {
        $query = "UPDATE tache SET titre = :titre, description = :description, updated_at = now(), priorite = :priorite WHERE id = :id";
        $parameters = [
            ':id' => [$id, PDO::PARAM_INT],
            ':titre' => [$titre, PDO::PARAM_STR],
            ':description' => [$description, PDO::PARAM_STR],
            ':priorite' => [$priorite, PDO::PARAM_INT]
        ];
        return $this->con->executeQuery($query, $parameters);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $query = "DELETE FROM tache WHERE id = :id";
        $parameters = [
            ':id' => [$id, PDO::PARAM_INT]
        ];

        return $this->con->executeQuery($query, $parameters);
    }

    /**
     * @return void
     */
    public function findAll() : array
    {
        $query = "SELECT * FROM tache";
        $this->con->executeQuery($query);
        $results = $this->con->getResults();

        $taches = [];
        foreach ($results as $row) {
            $taches[] = new Tache($row['id'], $row['titre'], $row['description'], $row['created_at'], $row['updated_at'], $row['priorite']);
        }
        return $taches;
    }
}