<?php

//gen
$rep=__DIR__.'/../';

//BD

$dsn="mysql:host=localhost;dbname=TO_DO_LIST";
$login="malanone";
$mdp="azertyuiop";
$conBd = new Connection($dsn, $login, $mdp);

//Vues

$vues['erreur']='view/erreur.php';
$vues['vueListe']='view/vueListe.php';
$vues['inscription']='view/inscription.php';
$vues['connexion']='view/connexion.php';
