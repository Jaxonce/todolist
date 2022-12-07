<?php

class UserGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function insert(Utilisateur $utilisateur)
    {
        $query = 'INSERT INTO utilisateur (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)';
        $this->con->executeQuery($query, array(
            ':nom' => array($utilisateur->getNom(), PDO::PARAM_STR),
            ':prenom' => array($utilisateur->getPrenom(), PDO::PARAM_STR),
            ':email' => array($utilisateur->getEmail(), PDO::PARAM_STR),
            ':mot_de_passe' => array($utilisateur->getMotDePasse(), PDO::PARAM_STR)
        ));
    }

    public function update(Utilisateur $utilisateur)
    {
        $query = 'UPDATE utilisateur SET nom=:nom, prenom=:prenom, email=:email WHERE id=:id';
        $this->con->executeQuery($query, array(
            ':id' => array($utilisateur->getId(), PDO::PARAM_INT),
            ':nom' => array($utilisateur->getNom(), PDO::PARAM_STR),
            ':prenom' => array($utilisateur->getPrenom(), PDO::PARAM_STR),
            ':email' => array($utilisateur->getEmail(), PDO::PARAM_STR)
        ));
    }

    public function getCredentials(string $nom)
    {
        $query = 'SELECT password FROM utilisateur WHERE nom=:nom';
        $this->con->executeQuery($query, array(
            ':nom' => array($nom, PDO::PARAM_STR)
        ));
        return $this->con->getResults();
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
