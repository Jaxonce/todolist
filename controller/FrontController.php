<?php

class FrontController{
    private ModelUser $mdl;


    public function __construct()
    {
        global $rep,$vues;

        try{
            $listeActionUser = ['deconnexion', 'afficherListePrive','ajoutTachePrive','ajoutListePrive','supprimerListePrive','supprimerTachePrive','changeDonePrive' ];
            
            if (isset($_REQUEST['action']))
            {
                $action = $_REQUEST['action'];
            }
            else $action = NULL;
            if(in_array($action, $listeActionUser)){
                $user = ModelUser::isUser();
                if($user == null){
                    require ($rep.$vues['connexion']);
                }
                else new UserControl();
            }
            
            else new VisitorControl();

        }catch (Exception $e){
            require ($rep.$vues['erreur']);
        }
    }


}