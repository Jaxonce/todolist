<?php

class ModelUser
{
    private $gateway;
    public function __construct()
    {
        $gateway = new AdminGateway();
    }
    public function connexion($login, $password){
        global $dsn, $login, $mdp;
        $g = new UserGateway(new Connection($dsn, $login, $mdp));
        $login = Clean::cleanString($login);
        $mdp = Clean::cleanString($mdp);
        if (password_verify($login, $g->getCredentials($login)))
        {
            $_SESSION['role']='user';
            $_SESSION['login'] = $login;
            $info = $g->getInfo($login);
            $_SESSION['prenom'] = $info['prenom'];
            $_SESSION['email'] = $info['email'];
            $_SESSION['id'] = $info['id'];
            return new User($info['id'],$login, $info['prenom'], $info['email']);
        }
        return NULL;

    }

    public static function isUser(){
        if (isset($_SESSION['login']) && isset($_SESSION['role'] && $_SESSION['prenom'] && $_SESSION['email'] && $_SESSION["id"])){
            $login=Clean::cleanString($_SESSION['login']);
            $role=Clean::cleanString($_SESSION['role']);
            $prenom=Clean::cleanString($_SESSION['prenom']);
            $email=Clean::cleanMail($_SESSION['email']);
            $id=Clean::cleanInt($_SESSION['id']);
            
            if ($role=='user'){
                return new User($id,$login, $prenom, $email);
            }
        } else
            return null;

    }
}