<?php
require_once('config/config.php');
class UserControl{
    private Model $mdl;
    public function __construct(){
        global $vues,$rep;
        $this->mdl = new Model();
        session_start();
        $dVueErreur=array();
        try{
            $action=$_REQUEST['action'];

            switch($action){
                case NULL:
                    $this->displayPublicList();
                    break;
                case 'ajoutListe':
                    $this->addPublicList();
                    break;
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($rep.$vues['erreur']);
            }
        }catch(PDOException $e){
            $dVueErreur[] = "Erreur inattendue PDO";
            echo $e->getMessage();
        }
    }
    public function displayPublicList(){
        global $vues;
        $mdl = new Model();
        $todoListPublic=array();

        $todoListPublic=$mdl->getListPublic();
        require($vues['vuephp1']);
    }

    public function addPublicList(){
        global $vues;
        $mdl = new Model();
        $name=$_REQUEST['nameNewListPublic'];
        $mdl->addList($name,1);
        $todoListPublic=array();

        $todoListPublic=$mdl->getListPublic();
        require($vues['vuephp1']);
    }

}