<?php

require_once 'config/config.php';
class ListeGateway
{
    protected $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function insert(Liste $liste): void
    {
        $query = "INSERT INTO Liste (nom, possesseur) VALUES (:nom, :user_id)";
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
        $query = "SELECT * FROM Liste";
        $this->con->executeQuery($query);

        $result = $this->con->getResults();
        return $result;
    }

    public function getAllByUserId (int $possesseur): array
    {
        $query = "SELECT * FROM Liste WHERE possesseur = :possesseur";
        $this->con->executeQuery($query, array(
            ':possesseur' => array($possesseur, PDO::PARAM_INT)
        ));
        return $this->con->getResults();
    }
}