<?php

/**
 *
 */
class ModelUser
{
    /**
     * @param $username
     * @param $password
     * @return User|null
     */
    public function connexion($username, $password) :?User
    {
        global $conBd;
        $g = new UserGateway($conBd);
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

    /**
     * @param $username
     * @param $email
     * @param $password
     * @return User|null
     */
    public function inscription($username, $email, $password) :?User
    {
        global $conBd;
        $g = new UserGateway($conBd);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        try{
            $g->insert($username, $email, $passwordHash);
        }catch (Exception $e){
            return null;
        }
        return $this->connexion($username, $password);
    }

    /**
     * @return User|null
     */
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

    /**
     * @param int $id
     * @param int $pageActuelle
     * @param int $nbListeParPage
     * @return array
     */
    public function getListePrive(int $id, int $pageActuelle, int $nbListeParPage) : array
    {
        global $conBd;
        $tab = array();
        
        $g = new ListeGateway($conBd);
        $listFromDB = $g->getPrivateList($id,$pageActuelle,$nbListeParPage);
        $g = new TaskGateway($conBd);
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

    /**
     * @param int $id
     * @return int
     */
    public function getNbListePrive(int $id) : int
    {
        global $conBd;
        $g = new ListeGateway($conBd);
        $nbListe = $g->getNbPrivateList($id);
        return $nbListe;
    }

    /**
     * @param int $listeId
     * @param String $nom
     * @return void
     */
    public function addTachePrive(int $listeId, String $nom) : void
    {
        global $conBd;
        $g = new TaskGateway($conBd);
        $nom = Clean::cleanString($nom);
        if ($nom != "") {
            $g->insert(new Task(0, $nom, "", 1, 0, 0, $listeId,False));
        }
    }

    /**
     * @param int $id
     * @param String $nom
     * @return void
     */
    public function addListePrive(int $id, String $nom) : void
    {
        global $conBd;
        $g = new ListeGateway($conBd);
        $nom = Clean::cleanString($nom);
        if ($nom != "") {
            $g->insert($nom,$id);
        }
    }

    /**
     * @param int $idUser
     * @param int $idListe
     * @return void
     */
    public function deleteListePrive(int $idUser, int $idListe) : void
    {
        global $conBd;
        $g = new ListeGateway($conBd);
        $g->delete($idUser,$idListe);
    }

    /**
     * @param int $idUser
     * @param int $idTache
     * @return void
     */
    public function deleteTachePrive(int $idUser, int $idTache) : void
    {
        global $conBd;
        $g = new TaskGateway($conBd);
        $g->delete($idUser,$idTache);
    }

    /**
     * @param int $idTache
     * @return void
     */
    public function changeDonePrive(int $idTache) : void
    {
        global $conBd;
        $g = new TaskGateway($conBd);
        $g->changeDone($idTache);
    }

}