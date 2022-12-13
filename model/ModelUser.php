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

    public function inscription($username, $email, $password) :?User
    {
        global $dsn, $login, $mdp;
        $g = new UserGateway(new Connection($dsn, $login, $mdp));
        $username = Clean::cleanString($username);
        $email = Clean::cleanMail($email);
        $password = Clean::cleanString($password);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        try{
            $g->insert($username, $email, $passwordHash);
        }catch (Exception $e){
            return null;
        }
        return $this->connexion($username, $password);
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

    public function getListePrive(int $id,int $pageActuelle, int $nbListeParPage) : array
    {
        global $dsn, $login, $mdp;
        $tab = array();
        
        $g = new ListeGateway(new Connection($dsn, $login, $mdp));
        $listFromDB = $g->getPrivateList($id,$pageActuelle,$nbListeParPage);
        $g = new TaskGateway(new Connection($dsn,$login,$mdp));
        foreach ($listFromDB as $tabList) {
            $tasksTmp = $g->getTachesByListeId($tabList['id']);
            $tasks = array();
            foreach ($tasksTmp as $task) {
                $tasks[] = new Task($task['id'], $task['nom'],$task["descriptionTache"] ?? "",$task["importance"], $task['dateCreation'], $task['dateModification'], $task['listeId'], $task['fait']);
            }
            $tab[] = new Liste($tabList['id'], $tabList['nom'], $tabList['dateModification']?? 0,$tabList['possesseur']??0, $tasks);
        }
        return $tab;
    }

    public function getNbListePrive(int $id) : int
    {
        global $dsn, $login, $mdp;
        $g = new ListeGateway(new Connection($dsn, $login, $mdp));
        $nbListe = $g->getNbPrivateList($id);
        return $nbListe;
    }

    public function addTachePrive(int $listeId,String $nom) : void
    {
        global $dsn, $login, $mdp;
        $g = new TaskGateway(new Connection($dsn, $login, $mdp));
        $nom = Clean::cleanString($nom);
        if ($nom != "") {
            $g->insert(new Task(0, $nom, "", 1, 0, 0, $listeId,False));
        }
    }

    public function addListePrive(int $id,String $nom) : void
    {
        global $dsn, $login, $mdp;
        $g = new ListeGateway(new Connection($dsn, $login, $mdp));
        $nom = Clean::cleanString($nom);
        if ($nom != "") {
            $g->insert($nom,$id);
        }
    }

    public function deleteListePrive(int $idUser, int $idListe) : void
    {
        global $dsn, $login, $mdp;
        $g = new ListeGateway(new Connection($dsn, $login, $mdp));
        $g->delete($idUser,$idListe);
    }

    public function deleteTachePrive(int $idUser, int $idTache) : void
    {
        global $dsn, $login, $mdp;
        $g = new TaskGateway(new Connection($dsn, $login, $mdp));
        $g->delete($idUser,$idTache);
    }

    public function changeDonePrive(int $idTache) : void
    {
        global $dsn, $login, $mdp;
        $g = new TaskGateway(new Connection($dsn, $login, $mdp));
        $g->changeDone($idTache);
    }

}