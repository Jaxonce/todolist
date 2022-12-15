<?php
require_once('config/config.php');
class UserControl
{
    private ModelUser $mdlUser;


    public function __construct()
    {
        global $vues, $rep;
        $this->mdlUser = new ModelUser();
        $dVueErreur = array();
        try {
            
            if (isset($_REQUEST['action'])) {
                $action = $_REQUEST['action'];
            } else $action = NULL;

            switch ($action) {
                case NULL:
                    
                    break;
                case 'afficherListePrive':
                    $this->displayPrivateList();
                    break;
                case "deconnexion":
                    $this->deconnexion();
                    break;
                case 'ajoutTachePrive':
                    $this->addPrivateTask();
                    break;
                case 'ajoutListePrive':
                    $this->addPrivateList();
                    break;
                case 'supprimerListePrive':
                    $this->deletePrivateList();
                    break;
                case 'supprimerTachePrive':
                    $this->deletePrivateTask();
                    break;
                case 'changeDonePrive':
                    $this->changeDonePrivateTask();
                    break;
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($rep . $vues['erreur']);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function displayPrivateList() : void
    {
        global $vues;
        $user = ModelUser::isUser();

        $nbListeTotal=$this->mdlUser->getNbListePrive($user->getId());
        $nbListeParPage=2;
        $nbPages=ceil($nbListeTotal/$nbListeParPage);
        $type = "Prive";

        if (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
            $pageActuelle = (int) Clean::cleanInt($_REQUEST['page']);
        } else {
            $pageActuelle = 1;
        }
        $todoList=$this->mdlUser->getListePrive($user->getId(),$pageActuelle,$nbListeParPage);
        require($vues['vueListe']);
    }

    private function deconnexion() : void
    {
        session_destroy();
        session_unset();
        header('Location: index.php');
    }

    private function addPrivateTask() : void
    {
        $user = ModelUser::isUser();
        $idListe = Clean::cleanInt($_REQUEST['idList']);
        $nomTache = Clean::cleanString($_REQUEST['nameTask']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdlUser->addTachePrive($idListe, $nomTache);
        header('Location: index.php?action=afficherListePrive&page='.$pageActuelle);
    }

    private function addPrivateList() : void
    {
        $user = ModelUser::isUser();
        $nomListe = Clean::cleanString($_REQUEST['nomListe']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdlUser->addListePrive($user->getId(), $nomListe);
        header('Location: index.php?action=afficherListePrive&page='.$pageActuelle);
    }

    private function deletePrivateList() : void
    {
        $user = ModelUser::isUser();
        $idListe = Clean::cleanInt($_REQUEST['idList']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        var_dump($user->getId());
        var_dump($idListe);
        $this->mdlUser->deleteListePrive($user->getId(), $idListe);
        header('Location: index.php?action=afficherListePrive&page='.$pageActuelle);
    }

    private function deletePrivateTask() : void
    {
        $user = ModelUser::isUser();
        $idTache = Clean::cleanInt($_REQUEST['idTask']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);

        
        $this->mdlUser->deleteTachePrive($user->getId(), $idTache);
        header('Location: index.php?action=afficherListePrive&page='.$pageActuelle);
    }

    private function changeDonePrivateTask() : void
    {
        $idTache = Clean::cleanInt($_REQUEST['idTask']);
        $pageActuelle=Clean::cleanInt($_REQUEST['pageActuelle']);
        $this->mdlUser->changeDonePrive($idTache);
        header('Location: index.php?action=afficherListePrive&page='.$pageActuelle);
    }


    
}