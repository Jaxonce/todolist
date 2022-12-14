<?php

class UserGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function insert(string $nom, string $email, string $mot_de_passe)
    {
        $query = 'INSERT INTO Utilisateur (nom, email, password) VALUES (:nom, :email, :mot_de_passe)';
        $this->con->executeQuery($query, array(
            ':nom' => array($nom, PDO::PARAM_STR),
            ':email' => array($email, PDO::PARAM_STR),
            ':mot_de_passe' => array($mot_de_passe, PDO::PARAM_STR)
        ));
    }

    public function update(User $utilisateur)
    {
        $query = 'UPDATE Utilisateur SET nom=:nom, email=:email WHERE id=:id';
        $this->con->executeQuery($query, array(
            ':id' => array($utilisateur->getId(), PDO::PARAM_INT),
            ':nom' => array($utilisateur->getNom(), PDO::PARAM_STR),
            ':email' => array($utilisateur->getEmail(), PDO::PARAM_STR)
        ));
    }

    public function getCredentials(string $nom)
    {
        $query = 'SELECT password FROM Utilisateur WHERE nom=:nom';
        $this->con->executeQuery($query, array(
            ':nom' => array($nom, PDO::PARAM_STR)
        ));
        $result = $this->con->getResults();
        return $result;
    }

    public function getInfo(string $nom)
    {
        $query = 'SELECT id, email FROM Utilisateur WHERE nom=:nom';
        $this->con->executeQuery($query, array(
            ':nom' => array($nom, PDO::PARAM_STR)
        ));
        return $this->con->getResults();
    }
}
