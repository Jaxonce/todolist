<?php
require_once('config/config.php');
class UserControl
{
    private ModelUser $mdlUser;


    public function __construct()
    {
        global $vues, $rep;
        $this->mdl = new ModelUser();
        $dVueErreur = array();
        try {
            $action = $_REQUEST['action'];

            switch ($action) {
                case NULL:
                    $this->displayPublicList();
                    break;
                case 'connexionUser':
                    echo "jesuis bien dans UserControl";
//                    $this->connexionUser();
                    break;
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($rep . $vues['erreur']);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function connexionUser(){
        global $vues;
        $username = $_REQUEST['username'];
        var_dump($username);
        $user = $this->mdlUser->connexion($username, $_REQUEST['password']);
        if($user == null){
            require($vues['connexion']);
        }
        else{
            require($vues['accueil']);
        }
    }
}