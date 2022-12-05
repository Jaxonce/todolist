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
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($rep.$vues['erreur']);
            }
        }catch(PDOException $e){
            $dVueErreur[] = "Erreur inattendue PDO";
        }
    }
}