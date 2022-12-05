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
                case 'ajoutListePublic':
                    $this->addPublicList();
                    $action = NULL;
                    break;
                case 'ajoutTache':
                    $this->addTask();
                    break;
                case 'supprimerListe':
                    $this->deletePublicList();
                    $action = NULL;
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
        }catch(PDOException $e){
            $dVueErreur[] = "Erreur inattendue PDO";
            echo $e->getMessage();
        }
    }

    public function deletePublicList(){
        $id=$_REQUEST['idList'];
        $this->mdl->deletePublicList($id);
        header('Location: index.php');

    }
    

    public function displayPublicList(){
        global $vues;
        $todoListPublic=array();

        $todoListPublic=$this->mdl->getListPublic();
        require($vues['vuephp1']);
    }

    public function addPublicList(){
        $name=$_REQUEST['nameNewListPublic'];
        $this->mdl->addPublicList($name);
        header('Location: index.php');
        exit();
        

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

}