<?php


//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/AutoLoader.php');
Autoload::charger();

//chargement config
require_once(__DIR__.'/config/config.php');

session_start();

$controleurs= new FrontController();