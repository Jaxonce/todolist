<?php
require_once('config/config.php');

/**
 *
 */
class VisitorControl{
    /**
     * @var Model
     */
    private Model $mdl;

    /**
     *
     */
    public function __construct(){
        global $vues,$rep;
        $this->mdl = new Model();

        try {
            if (isset($_REQUEST['action'])){
                $action = Clean::cleanString($_REQUEST['action']);
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
                    break;
                case 'ajoutTachePublic':
                    $this->addPublicTask();
                    break;
                case 'supprimerListePublic':
                    $this->deletePublicList();
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
        }catch (PDOException $e){
            $message="500 : Erreur serveur PDO";
            require($rep.$vues['erreur']);
        }
        catch(Exception $e){
            $message=$e->getMessage();
            require($rep.$vues['erreur']);
        }
    }


    /**
     * @return void
     */
    private function inscriptionPage() : void
    {
        global $vues;

        require($vues['inscription']);
    }

    /**
     * @return void
     */
    private function connexionPage() : void
    {
        global $vues;
        require($vues['connexion']);
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    private function deletePublicList(){
        $id=Clean::cleanInt($_REQUEST['idList']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->deletePublicList($id);
        header('Location: index.php?page='.$pageActuelle);
    }

    /**
     * @return void
     */
    private function addPublicList(){
        $name=Clean::cleanString($_REQUEST['nomListe']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->addPublicList($name);
        header('Location: index.php?page='.$pageActuelle);
    }

    /**
     * @return void
     */
    private function addPublicTask(){
        $idList=Clean::cleanInt($_REQUEST['idList']);
        $name=Clean::cleanString($_REQUEST['nameTask']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->addPublicTask($idList,$name);
        header('Location: index.php?page='.$pageActuelle);
    }

    /**
     * @return void
     */
    private function deletePublicTask(){
        $idTask=Clean::cleanInt($_REQUEST['idTask']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->deletePublicTask($idTask);
        header('Location: index.php?page='.$pageActuelle);
    }

    /**
     * @return void
     */
    private function connexionUser(){
        global $vues;
        $mdlUser=new ModelUser();
        $username = Clean::cleanString($_REQUEST['username']);
        $user = $mdlUser->connexion($username, $_REQUEST['password']);
        if($user == null){
            $erreurConnexion = "Erreur de connexion";
                
            require($vues['connexion']);
        }
        else{
            $this->displayPublicList();
        }
    }

    /**
     * @return void
     */
    private function inscriptionUser(){
        global $vues;
        $mdlUser=new ModelUser();
        $erreurConnexion = array();
        $username = Clean::cleanString($_REQUEST['username']);
        $email = Clean::cleanMail($_REQUEST['email']);
        $password = Clean::cleanString($_REQUEST['password']);
        if (empty($username)) {
            $erreurConnexion[] = "Le nom d'utilisateur est vide";
        }
        if (empty($email)) {
            $erreurConnexion[] = "L'email est vide";
        }
        if (empty($password)) {
            $erreurConnexion[] = "Le mot de passe est vide";
        }
        if (! Verif::verifMail($email) && !empty($email)) {
            $erreurConnexion[] = "L'email n'est pas valide";
        }
        if (count($erreurConnexion) > 0){
            require($vues['inscription']);
            return;
        }
        $user = $mdlUser->inscription($username, $email, $password);
        if($user == null){
            $erreurConnexion[] = "Cet utilisateur existe deja";
            require($vues['inscription']);
        }
        else{
            $this->connexionUser();
        }
    }

    /**
     * @return void
     */
    private function changeDonePublicTask(){
        $idTask=Clean::cleanInt($_REQUEST['idTask']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdl->changeDonePublicTask($idTask);
        header('Location: index.php?page='.$pageActuelle);
    }
}