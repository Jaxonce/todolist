<?php

class ModelUser
{
    public function connexion($username, $password) :?User
    {
        global $dsn, $login, $mdp;
        $g = new UserGateway(new Connection($dsn, $login, $mdp));
        $username = Clean::cleanString($username);
        $password = Clean::cleanString($password);
        $passwordInDb = $g->getCredentials($username);
        if (isset($passwordInDb[0]['password']) && password_verify($password, $passwordInDb[0]['password']))
        {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'user';
            $info = $g->getInfo($username)[0];
            $_SESSION['email'] = $info['email'];
            $_SESSION['id'] = $info['id'];
            return new User($info['id'], $username, $info['email']);
        }
        return null;

    }

    public static function isUser(): ?User
    {
        if (isset($_SESSION['username']) && isset($_SESSION['role']) && isset($_SESSION['email']) && isset($_SESSION["id"])){
            $username=Clean::cleanString($_SESSION['username']);
            $role=Clean::cleanString($_SESSION['role']);
            $email=Clean::cleanMail($_SESSION['email']);
            $id=Clean::cleanInt($_SESSION['id']);
            
            if ($role=='user'){
                return new User($id, $username, $email);
            }
        }
        return null;

    }

    public function getListePrive(int $id) : array
    {
        global $dsn, $login, $mdp;
        $g = new ListeGateway(new Connection($dsn, $login, $mdp));
        $listes = $g->getPrivateList($id);
        $arrayListe = array();
        foreach ($listes as $liste) {
            $arrayListe[] = new Liste($liste['id'], $liste['nom'], $liste['dateModification'], $liste['userId']);
        }
        return $arrayListe;
    }
}