<?php

//gen
$rep=__DIR__.'/../';

// liste des modules à inclure

//$dConfig['includes']= array('controleur/Validation.php');



//BD

$dsn="mysql:host=localhost;dbname=TO_DO_LIST";
$login="malanone";
$mdp="azertyuiop";

//Vues

$vues['erreur']='view/erreur.php';
$vues['vuephp1']='view/vuephp1.php';
$vues['inscription']='view/inscription.php';
$vues['connexion']='view/connexion.php';
