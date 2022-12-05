<?php
require_once('config/config.php');
class UserControl{
    private Model $mdl;


    public function __construct(){
        global $vues,$rep;
        $this->mdl = new Model();
        $dVueErreur=array();
        try{
            $action=$_REQUEST['action'];

            switch($action){
                case NULL:
                    visitorControl();
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

}