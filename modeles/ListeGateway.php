<?php

class ListeGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function insert(Liste $liste): void
    {
        $query = "INSERT INTO Liste (nom, user_id) VALUES (:nom, :user_id)";
        $this->con->executeQuery($query, array(
            ':nom' => array($liste->getNom(), PDO::PARAM_STR),
            ':user_id' => array($liste->getUserId(), PDO::PARAM_INT)
        ));
    }

    public function update(Liste $liste): void
    {
        $query = "UPDATE Liste SET nom = :nom WHERE id = :id";
        $this->con->executeQuery($query, array(
            ':nom' => array($liste->getNom(), PDO::PARAM_STR),
            ':id' => array($liste->getId(), PDO::PARAM_INT)
        ));
    }

    public function delete(Liste $liste): void
    {
        $query = "DELETE FROM Liste WHERE id = :id";
        $this->con->executeQuery($query, array(
            ':id' => array($liste->getId(), PDO::PARAM_INT)
        ));
    }

    public function getAllPublic (): array
    {
        $query = "SELECT * FROM Liste WHERE possesseur IS NULL";
        $this->con->executeQuery($query);
        $results = $this->con->getResults();
        $liste = [];
        foreach ($results as $result) {
            echo $result['id'], $result['nom'], $result['dateCreation'], $result['dateModification'], $result['possesseur']. "<br>";
            if ($result['possesseur'] == null) {
                $liste[] = new Liste($result['id'], $result['nom'], $result['dateCreation'], $result['dateModification'], null);
            }
            else {
                $liste[] = new Liste($result['id'], $result['nom'], $result['dateCreation'], $result['dateModification'], $result['possesseur']);
            }
        }
        echo "jusqu'ici tout va bien ! <br>";
        return $liste;
    }

    public function getAllByUserId (int $possesseur): array
    {
        $query = "SELECT * FROM Liste WHERE possesseur = :possesseur";
        $this->con->executeQuery($query, array(
            ':possesseur' => array($possesseur, PDO::PARAM_INT)
        ));
        $results = $this->con->getResults();
        $liste = [];
        foreach ($results as $result) {
            $liste[] = new Liste($result['id'], $result['nom'], $result['date_creation'], $result['date_modification'], $result['possesseur']);
        }
        return $liste;
    }
}