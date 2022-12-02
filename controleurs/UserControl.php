<?php

class UserControl{
    private Model $mdl;
    public function __construct(){
        $this->mdl = new Model();
        session_start();

        try{
            $action=$_REQUEST['action'];

            switch($action){
                case NULL:
                    $this->afficherConnexion();
                    break;
                case 'afficherListePerso':
                    $this->afficherListePerso();
                    break;
                case 'afficherListePublique':
                    $this->afficherListePublique();
                    break;
                case 'deconnexion':
                    $this->deconnexion();
                    break;
            }
        }catch(Exception $e){
            $this->afficherErreur($e->getMessage());
        }
    }

}