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
            $listeAction = ['login', 'add' ];
            $admin = ModelAdmin::isAdmin();
            $action = $_REQUEST['action'];

            if(in_array($action, $listeAction)){
                if($admin == null){
                    require ($rep.$vues['authentification']);
                }
                else new AdminController();
            }
            else new UserControl();

        }catch (Exception $e){
            require ($rep.$vues['erreur']);
        }
    }


}