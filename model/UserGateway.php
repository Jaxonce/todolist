<?php

class UserGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function insert(User $utilisateur)
    {
        $query = 'INSERT INTO utilisateur (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)';
        $this->con->executeQuery($query, array(
            ':nom' => array($utilisateur->getNom(), PDO::PARAM_STR),
            ':email' => array($utilisateur->getEmail(), PDO::PARAM_STR),
            ':mot_de_passe' => array($utilisateur->getPassword(), PDO::PARAM_STR)
        ));
    }

    public function update(User $utilisateur)
    {
        $query = 'UPDATE utilisateur SET nom=:nom, email=:email WHERE id=:id';
        $this->con->executeQuery($query, array(
            ':id' => array($utilisateur->getId(), PDO::PARAM_INT),
            ':nom' => array($utilisateur->getNom(), PDO::PARAM_STR),
            ':email' => array($utilisateur->getEmail(), PDO::PARAM_STR)
        ));
    }

    public function getCredentials(string $nom)
    {
        $query = 'SELECT password FROM utilisateur WHERE nom=:nom';
        $this->con->executeQuery($query, array(
            ':nom' => array($nom, PDO::PARAM_STR)
        ));
        return $this->con->getResults()[0];
    }

    public function getInfo(string $nom)
    {
        $query = 'SELECT id, prenom, email FROM utilisateur WHERE nom=:nom';
        $this->con->executeQuery($query, array(
            ':nom' => array($nom, PDO::PARAM_STR)
        ));
        return $this->con->getResults();
    }
}
