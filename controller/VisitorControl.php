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

    public function deletePublicList(){
        $id=$_REQUEST['idList'];
        $this->mdl->deletePublicList($id);
        header('Location: index.php');
    }          

    public function addPublicList(){
        $name=$_REQUEST['nomListe'];
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
        var_dump($username);
        $email = $_REQUEST['email'];
        var_dump($email);
        $password = $_REQUEST['password'];
        var_dump($password);
        $user = $mdlUser->inscription($username, $email, $password);
        if($user == null){
            $erreurConnexion = "Erreur d'inscription";
                
            require($vues['inscription']);
        }
        else{
            $this->connexionUser();
        }
    }

    public function changeDonePublicTask(){
        $idTask=$_REQUEST['idTask'];
        $this->mdl->changeDonePublicTask($idTask);
        header('Location: index.php');
    }
}