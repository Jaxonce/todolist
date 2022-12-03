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
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($rep.$vues['authentication']);
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
        echo "on est la";
        require($vues['vuephp1']);
    }

}