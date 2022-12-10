<?php

class ModelUser
{
    public function connexion($email, $password){
        global $dsn, $login, $mdp;
        $g = new UserGateway(new Connection($dsn, $login, $mdp));
        $email = Clean::cleanMail($email);
        $password = Clean::cleanString($password);
        var_dump($email);
        var_dump($password);
        var_dump($g->getCredentials($email));

        if (password_verify($password, $g->getCredentials($email)[0]["password"]))
        {
            $_SESSION['role']='user';
            $_SESSION['login'] = $info['nom'];
            $info = $g->getInfo($email);
            $_SESSION['prenom'] = $info['prenom'];
            $_SESSION['email'] = $info['email'];
            $_SESSION['id'] = $info['id'];
            return new User($info['id'],$info['nom'], $info['prenom'], $info['email']);
        }
        return NULL;

    }

    public static function isUser(): ?User
    {
        if (isset($_SESSION['login']) && isset($_SESSION['role']) && isset($_SESSION['prenom']) && isset($_SESSION['email']) && isset($_SESSION["id"])){
            $login=Clean::cleanString($_SESSION['login']);
            $role=Clean::cleanString($_SESSION['role']);
            $prenom=Clean::cleanString($_SESSION['prenom']);
            $email=Clean::cleanMail($_SESSION['email']);
            $id=Clean::cleanInt($_SESSION['id']);
            
            if ($role=='user'){
                return new User($id,$login, $prenom, $email);
            }
        }
        return null;

    }

    public function inscription($nom, $prenom, $email, $mdpUser)
    {
        global $dsn, $login, $mdp;
        $g = new UserGateway(new Connection($dsn, $login, $mdp));
        $mdpUser = password_hash($mdpUser, PASSWORD_DEFAULT);
        $u = new User(0, $nom, $prenom, $email);
        
        var_dump($this->isUser($nom));
        var_dump($g->exists($email));
        if ($this->isUser($nom) == NULL && !$g->exists($email) ){
            $g->insert($u, $mdpUser);
        }
        return $this->connexion($nom, $mdpUser);
            
    }
}