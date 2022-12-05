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
                    $action = NULL;
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
        $mdl = new Model();
        $name=$_REQUEST['nameNewListPublic'];
        $mdl->addList($name,1);
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'ajoutListe') {
            // do the insert
            /* redirect after the insert */
            header('Location: index.php');
            exit();
        }

    }

}