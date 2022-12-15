<?php
require_once('config/config.php');

class VisitorControl{
    private Model $mdl;

    public function __construct(){
        global $vues,$rep;
        $this->mdl = new Model();

        try {
            if (isset($_REQUEST['action'])){
                $action = $_REQUEST['action'];
            }
            else $action = NULL;

            switch($action){
                case NULL:
                    $this->displayPublicList();
                    break;
                case 'afficherListePublic':
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
                case 'inscriptionUser':
                    $this->inscriptionUser();
                    break;
                case 'connexion':
                    $this->connexionPage();
                    break;
                case 'connexionUser':
                    $this->connexionUser();
                    break;
                case 'changeDonePublic':
                    $this->changeDonePublicTask();
                    break;
                default:
                    throw new Exception("Action non valide");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    

    private function inscriptionPage() : void
    {
        global $vues;

        require($vues['inscription']);
    }

    private function connexionPage() : void
    {
        global $vues;
        require($vues['connexion']);
    }
    
    private function displayPublicList(){
        global $vues;
        $nbListeTotal=$this->mdl->getNbListPublic();
        $nbListeParPage=2;
        $nbPages=ceil($nbListeTotal/$nbListeParPage);
        $type= "Public";

        if (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
            $pageActuelle = (int) Clean::cleanInt($_REQUEST['page']);
        } else {
            $pageActuelle = 1;
        }
        $todoList=$this->mdl->getListPublic($pageActuelle,$nbListeParPage);
        require($vues['vueListe']);
    }

    // documentation de la fonction displayPublicList
    // affiche la liste des listes publiques
    // paramètres : aucun
    // résultat : aucun
    // effets de bord : aucun
    // préconditions : aucun
    // postconditions : aucun
    // remarques : aucun

    private function deletePublicList(){
        $id=$_REQUEST['idList'];
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->deletePublicList($id);
        header('Location: index.php?page='.$pageActuelle);
    }          

    public function addPublicList(){
        $name=$_REQUEST['nomListe'];
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->addPublicList($name);
        header('Location: index.php?page='.$pageActuelle);
    }

    public function addPublicTask(){
        $idList=$_REQUEST['idList'];
        $name=$_REQUEST['nameTask'];
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->addPublicTask($idList,$name);
        header('Location: index.php?page='.$pageActuelle);
    }

    public function deletePublicTask(){
        $idTask=$_REQUEST['idTask'];
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->deletePublicTask($idTask);
        header('Location: index.php?page='.$pageActuelle);
    }

    public function connexionUser(){
        global $vues;
        $mdlUser=new ModelUser();
        $username = $_REQUEST['username'];
        $user = $mdlUser->connexion($username, $_REQUEST['password']);
        if($user == null){
            $erreurConnexion = "Erreur de connexion";
                
            require($vues['connexion']);
        }
        else{
            $this->displayPublicList();
        }
    }

    public function inscriptionUser(){
        global $vues;
        $mdlUser=new ModelUser();
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $user = $mdlUser->inscription($username, $email, $password);
        if($user == null){
            $erreurConnexion = "Cet utilisateur existe deja";
            require($vues['inscription']);
        }
        else{
            $this->connexionUser();
        }
    }

    public function changeDonePublicTask(){
        $idTask=$_REQUEST['idTask'];
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->changeDonePublicTask($idTask);
        header('Location: index.php?page='.$pageActuelle);
    }
}