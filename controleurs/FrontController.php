<?php
//Hash
//password_verify ( string $password , string $hash ) : bool
//password_hash ( string $password , int $algo [, array $options ] ) : string

class FrontController{
    private ModelAdmin $mdl;

    public function __construct()
    {
        global $rep,$vues;

        try{
            $listeActionUser = ['inscription', 'connexion' ];
            $action = $_REQUEST['action'];

            if(in_array($action, $listeActionUser)){
                $user = ModelUser::isUser();
                if($admin == null){
                    require ($rep.$vues['authentification']);
                }
                else new AdminController();
            }
            else new VisitorControl();

        }catch (Exception $e){
            require ($rep.$vues['erreur']);
        }
    }


}