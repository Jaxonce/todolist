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
            $listeActionUser = ['deconnexionUser', 'b' ];
            $action = $_REQUEST['action'];
            var_dump($action);

            if(in_array($action, $listeActionUser)){
                $user = ModelUser::isUser();
                var_dump($user);
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