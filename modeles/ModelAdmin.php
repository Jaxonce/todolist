<?php

class ModelAdmin
{
    private $gateway;
    public function __construct()
    {
        $gateway = new AdminGateway();
    }
    public function connexion($login, $password){
        global $dsn, $login, $mdp;
        $g = new AdminGateway(new Connection($dsn, $login, $mdp));
        $login = Validation::cleanString($login);
        $mdp = Validation::cleanString($mdp);
        if (password_verify($login, $g->getCredentials($login)))
        {
            $_SESSION['role']='admin';
            $_SESSION['login'] = $login;
            return new Admin($login,'admin');
        }
        else
        {
            throw new Exception("Login ou mot de passe incorrect");
        }

    }

    public function isAdmin(){
        if (isset($_SESSION['login']) && isset($_SESSION['role'])){
            $login=Nettoyer::nettoyer_string($_SESSION['login']); $role=Nettoyer::nettoyer_string($_SESSION['role']);
            return new Admin($login,$role);
        } else
            return null;

    }
}