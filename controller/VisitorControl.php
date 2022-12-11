<?php
require_once('config/config.php');

class VisitorControl{
    private Model $mdl;

    public function __construct(){
        global $vues,$rep;
        $this->mdl = new Model();

        try {
            $action=$_REQUEST['action'];

            switch($action){
                case NULL:
                    $this->displayPublicList();
                    break;
                case 'ajoutListePublic':
                    $this->addPublicList();
                    $action = NULL;
                    break;
                case 'ajoutTachePublic':
                    $this->addPublicTask();
                    break;
                case 'supprimerListePublic':
                    $this->deletePublicList();
                    $action = NULL;
                    break;
                case 'supprimerTachePublic':
                    $this->deletePublicTask();
                    break;
                case 'inscription':
                    $this->inscriptionPage();
                    break;
                case 'connexion':
                    $this->connexionPage();
                    break;
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($rep.$vues['erreur']);
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    

    function inscriptionPage() : void
    {
        global $vues;

        require($vues['inscription']);
    }

    function connexionPage() : void
    {
        global $vues;
        require($vues['connexion']);
    }
    
    public function displayPublicList(){
        global $vues;
        $todoListPublic=array();

        $todoListPublic=$this->mdl->getListPublic();
        require($vues['vuephp1']);
    }

    public function deletePublicList(){
        $id=$_REQUEST['idList'];
        $this->mdl->deletePublicList($id);
        header('Location: index.php');
    }          

    public function addPublicList(){
        $name=$_REQUEST['nameNewListPublic'];
        $this->mdl->addPublicList($name);
        header('Location: index.php');
    }

    public function addPublicTask(){
        $idList=$_REQUEST['idList'];
        $name=$_REQUEST['nameTask'];
        var_dump($idList);
        $this->mdl->addPublicTask($idList,$name);
        header('Location: index.php');
    }

        public function deletePublicTask(){
        $idTask=$_REQUEST['idTask'];
        $this->mdl->deletePublicTask($idTask);
        header('Location: index.php');
    }
}