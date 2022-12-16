<?php


require_once "ListeGateway.php";

/**
 *
 */
class Model
{
    /**
     * @param $currentPage
     * @param $nbListeParPage
     * @return iterable
     */
    public function getListPublic($currentPage, $nbListeParPage) : iterable // $page ?
    {
        global $conBd;
        $tab = array();

        $g=new ListeGateway($conBd);
        $publicListFromDB=$g->getListPublic($currentPage, $nbListeParPage);
        $g=new TaskGateway($conBd);
        foreach ($publicListFromDB as $tabList) {
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
     * @return int
     */
    public function getNbListPublic() : int
    {
        global $conBd;
        $g=new ListeGateway($conBd);
        $nbListeTotal=$g->getNbListPublic();
        return $nbListeTotal;
    }

    /**
     * @param string $nom
     * @return void
     */
    public function addPublicList(string $nom) : void
    {
        global $conBd;
        try{
            $g=new ListeGateway($conBd);
            $liste = new Liste(0, $nom, 0,0);
            $g->insertPublic($liste);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePublicList(int $id) : void
    {
        global $conBd;
        $g=new ListeGateway($conBd);
        $g->deletePublicList($id);
    }

    /**
     * @param int $listeId
     * @param String $nom
     * @return void
     */
    public function addPublicTask (int $listeId, String $nom) : void
    {
        global $conBd;
        $g=new TaskGateway($conBd);
        $nom = Clean::cleanString($nom);

        if (strlen($nom) > 0) {
            $task = new Task(0, $nom, "description", 0, 0, 0, $listeId, False);
            $g->insertPublic($task);
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePublicTask(int $id) : void
    {
        global $conBd;
        $g=new TaskGateway($conBd);
        $g->deletePublicTask($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function changeDonePublicTask(int $id) : void
    {
        global $conBd;
        $g=new TaskGateway($conBd);
        $g->changeDone($id);
    }
}