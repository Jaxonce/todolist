<?php

class ModelUser
{
    public function connexion($username, $password) :?User
    {
        global $dsn, $login, $mdp;
        $g = new UserGateway(new Connection($dsn, $login, $mdp));
        $username = Clean::cleanString($username);
        $password = Clean::cleanString($password);
        if ($password == $g->getCredentials($username))
        {
            setcookie('role', 'user', time()+365*24*3600);
            setcookie('username', $username, time()+365*24*3600);
            $info = $g->getInfo($username)[0];
            setcookie('email', $info['email'], time()+365*24*3600);
            setcookie('id', $info['id'], time()+365*24*3600);
            var_dump($info);
            return new User($info['id'], $username, $info['email']);
        }
        return null;

    }

    public static function isUser(): ?User
    {
        if (isset($_COOKIE['username']) && isset($_COOKIE['role']) && isset($_COOKIE['email']) && isset($_COOKIE["id"])){
            $username=Clean::cleanString($_COOKIE['username']);
            $role=Clean::cleanString($_COOKIE['role']);
            $email=Clean::cleanMail($_COOKIE['email']);
            $id=Clean::cleanInt($_COOKIE['id']);
            
            if ($role=='user'){
                return new User($id, $username, $email);
            }
        }
        return null;

    }
}