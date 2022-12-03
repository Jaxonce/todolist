<?php

use Liste;

require_once "ListeGateway.php";

class Model
{
    public function getListPublic() : iterable // $page ?
    {
        global $dsn, $login, $mdp;

        $tabList=array();

        $g=new ListeGateway(new Connection($dsn,$login,$mdp));
        $publicListFromDB =array();
        $publicListFromDB = $g->getAllPublic();


        foreach ($tabList as $publicListFromDB) {
            $tabList[] = new Liste(
                $tabList['id'],
                $tabList['nom'],
                $tabList['dateModification'],
                $tabList['userId']);
        }
        return $tabList;
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
//    public function addList(string $nom, int $userId) : void
//    {
//        global $base, $login, $mdp;
//        $g=new ListeGateway(new Connection($base,$login,$mdp));
//        $liste = new Liste(0, $nom, date("Y-m-d H:i:s"), $userId);
//        $g->insert($liste);
//    }
//
//    public function updateList(int $id, string $nom) : void
//    {
//        global $base, $login, $mdp;
//        $g=new ListeGateway(new Connection($base,$login,$mdp));
//        $liste = new Liste($id, $nom, date("Y-m-d H:i:s"), 0);
//        $g->update($liste);
//    }
//
//    public function deleteList(int $id) : void
//    {
//        global $base, $login, $mdp;
//        $g=new ListeGateway(new Connection($base,$login,$mdp));
//        $liste = new Liste($id, "", date("Y-m-d H:i:s"), 0);
//        $g->delete($liste);
//    }
}