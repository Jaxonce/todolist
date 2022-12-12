<?php
//Hash
//password_verify ( string $password , string $hash ) : bool
//password_hash ( string $password , int $algo [, array $options ] ) : string

class FrontController{
    private ModelUser $mdl;


    public function __construct()
    {
        global $rep,$vues;

        try{
            $listeActionUser = ['deconnexionUser', 'afficherListePrive' ];
            
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