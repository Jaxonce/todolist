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
                    
                    break;
                case 'deconnexionUser':
                    echo "jesuis bien dans UserControl";
                    break;
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($rep . $vues['erreur']);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    
}