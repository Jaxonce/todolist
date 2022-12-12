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
                    $this->displayPublicList();
                    break;
                case 'afficherListePrive':
                    $this->displayPrivateList();
                    break;
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($rep . $vues['erreur']);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function displayPrivateList() : void
    {
        global $vues;
        $user = ModelUser::isUser();
        
        $listes = $this->mdlUser->getListePrive($user->getId());
        require($vues['listePrive']);
    }

    
}