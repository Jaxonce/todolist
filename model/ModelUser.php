<?php

class ModelUser
{
    public function connexion($username, $password) :?User
    {
        global $dsn, $login, $mdp;
        $g = new UserGateway(new Connection($dsn, $login, $mdp));
        echo "je suis co a la base";
        $username = Clean::cleanString($username);
        $password = Clean::cleanString($password);
        if (password_verify($password, $g->getCredentials($username)))
        {
            setcookie('role', 'user', time()+365*24*3600);
            setcookie('username', $username, time()+365*24*3600);
            $info = $g->getInfo($username);
            setcookie('prenom', $info['prenom'], time()+365*24*3600);
            setcookie('email', $info['email'], time()+365*24*3600);
            setcookie('id', $info['id'], time()+365*24*3600);
            return new User($info['id'], $username, $info['prenom'], $info['email']);
        }
        return null;

    }

    public static function isUser(): ?User
    {
        if (isset($_COOKIE['username']) && isset($_COOKIE['role']) && isset($_COOKIE['prenom']) && isset($_COOKIE['email']) && isset($_COOKIE["id"])){
            $username=Clean::cleanString($_COOKIE['username']);
            $role=Clean::cleanString($_COOKIE['role']);
            $prenom=Clean::cleanString($_COOKIE['prenom']);
            $email=Clean::cleanMail($_COOKIE['email']);
            $id=Clean::cleanInt($_COOKIE['id']);
            
            if ($role=='user'){
                return new User($id, $username, $prenom, $email);
            }
        }
        return null;

    }
}