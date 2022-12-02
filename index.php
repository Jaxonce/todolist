<html lang="fr">

<body>
<?php


//chargement config
require_once(__DIR__.'/config/config.php');

//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/AutoLoader.php');
Autoload::charger();

try{
    $co = new Connection($base,$login,$mdp);
    $gatewayListe=new ListeGateway($co);
    echo "ici <BR>";
    $lesListesPublic=$gatewayListe->getAllPublic();
    echo "ici <BR>";

    $gatewayTache=new TacheGateway($co);
    foreach ($lesListesPublic as $uneListe){
        $lesTaches=$gatewayTache->getTachesByListeId($uneListe->getId());
        echo "<br>";
        echo "<h1>".$uneListe->getNom()."</h1>";
        foreach ($lesTaches as $uneTache){
            echo "<br>";
            echo $uneTache->getNom();
        }

    }
}catch (PDOException $e){
    echo "<h3> Erreur PDO : " . $e->getMessage() . "</h3>";
}catch (Exception $e){
    echo "<h3> Erreur : " . $e->getMessage() . "</h3>";
}







?>

</body>
</html>