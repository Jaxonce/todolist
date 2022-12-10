<?php

class UserGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function insert(User $utilisateur, string $mdp )
    {
        $query = 'INSERT INTO utilisateur (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :mot_de_passe)';
        $this->con->executeQuery($query, array(
            ':nom' => array($utilisateur->getNom(), PDO::PARAM_STR),
            ':prenom' => array($utilisateur->getPrenom(), PDO::PARAM_STR),
            ':email' => array($utilisateur->getEmail(), PDO::PARAM_STR),
            ':mot_de_passe' => array($mdp, PDO::PARAM_STR)
        ));
    }

    public function exists(string $email)
    {
        $query = 'SELECT COUNT(*) FROM utilisateur WHERE email=:email';
        $this->con->executeQuery($query, array(
            ':email' => array($email, PDO::PARAM_STR)
        ));
        var_dump($this->con->getResults());
        return $this->con->getResults()[0][0] > 0;
    }

    public function update(User $utilisateur)
    {
        $query = 'UPDATE utilisateur SET nom=:nom, prenom=:prenom, email=:email WHERE id=:id';
        $this->con->executeQuery($query, array(
            ':id' => array($utilisateur->getId(), PDO::PARAM_INT),
            ':nom' => array($utilisateur->getNom(), PDO::PARAM_STR),
            ':prenom' => array($utilisateur->getPrenom(), PDO::PARAM_STR),
            ':email' => array($utilisateur->getEmail(), PDO::PARAM_STR)
        ));
    }

    public function getCredentials(string $email)
    {
        $query = 'SELECT password FROM utilisateur WHERE email=:email';
        $this->con->executeQuery($query, array(
            ':email' => array($email, PDO::PARAM_STR)
        ));
        return $this->con->getResults();
    }

    public function getInfo(string $email)
    {
        $query = 'SELECT id, nom, prenom, email FROM utilisateur WHERE email=:email';
        $this->con->executeQuery($query, array(
            ':email' => array($email, PDO::PARAM_STR)
        ));
        return $this->con->getResults()[0];
    }
}
