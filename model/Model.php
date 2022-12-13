<?php


require_once "ListeGateway.php";

class Model
{
    public function getListPublic($currentPage, $nbListeParPage) : iterable // $page ?
    {
        global $dsn, $login, $mdp;
        $tab = array();

        $g=new ListeGateway(new Connection($dsn,$login,$mdp));
        $publicListFromDB=$g->getListPublic($currentPage, $nbListeParPage);
        $g=new TaskGateway(new Connection($dsn,$login,$mdp));
        foreach ($publicListFromDB as $tabList) {
            $tasksTmp = $g->getTachesByListeId($tabList['id']);
            $tasks = array();
            foreach ($tasksTmp as $task) {
                $tasks[] = new Task($task['id'], $task['nom'],$task["descriptionTache"] ?? "",$task["importance"], $task['dateCreation'], $task['dateModification'], $task['listeId']);
            }
            $tab[] = new Liste($tabList['id'], $tabList['nom'], $tabList['dateModification']?? 0,$tabList['possesseur']??0, $tasks);
        }
        return $tab;
    }

    public function getNbListPublic() : int
    {
        global $dsn, $login, $mdp;
        $g=new ListeGateway(new Connection($dsn,$login,$mdp));
        $nbListeTotal=$g->getNbListPublic();
        return $nbListeTotal;
    }

//    public function getListByUserId(int $userId) : array
//    {
//        global $base, $login, $mdp;
//        $g=new ListeGateway(new Connection($base,$login,$mdp));
//        $result = $g->getAllByUserId($userId);
//        foreach ($result as $row) {
//            $tabList[] = new Liste($row['id'], $row['nom'], $row['dateModification'], $userId);
//        }
//        return $tabList;
//    }
//
//    public function getListById(int $id) : Liste
//    {
//        global $base, $login, $mdp;
//        $g=new ListeGateway(new Connection($base,$login,$mdp));
//        $result = $g->getById($id);
//        $liste = new Liste($result['id'], $result['nom'], $result['dateModification'], $result['possesseur']);
//        return $liste;
//    }
//
    public function addList(string $nom, int $userId) : void
    {
        global $dsn, $login, $mdp;
        try{
            $g=new ListeGateway(new Connection($dsn,$login,$mdp));
            $liste = new Liste(0, $nom, 0, $userId);
            $g->insert($liste);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
    public function addPublicList(string $nom) : void
    {
        global $dsn, $login, $mdp;
        try{
            $g=new ListeGateway(new Connection($dsn,$login,$mdp));
            $liste = new Liste(0, $nom, 0,0);
            $g->insertPublic($liste);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function deletePublicList(int $id) : void
    {
        global $dsn, $login, $mdp;
        $g=new ListeGateway(new Connection($dsn,$login,$mdp));
        $g->deletePublicList($id);
    }

    public function addPublicTask (int $listeId,String $nom) : void
    {
        global $dsn, $login, $mdp;
        $g=new TaskGateway(new Connection($dsn,$login,$mdp));
        $nom = Clean::cleanString($nom);

        if (strlen($nom) > 0) {
            $task = new Task(0, $nom, "description", 0, 0, 0, $listeId);
            $g->insertPublic($task);
        }
    }

    public function deletePublicTask(int $id) : void
    {
        global $dsn, $login, $mdp;
        $g=new TaskGateway(new Connection($dsn,$login,$mdp));
        $g->deletePublicTask($id);
    }
}