<html lang="fr">

<body>
<?php

require_once("Connection.php");
require_once("TacheGateWay.php");

$user= 'trbarlet';
$pass='achanger';
$dsn='mysql:host=localhost;dbname=dbtrbarlet';

try{
    $gateway=new TacheGateway(new Connection($dsn,$user,$pass));
    $gateway->insertTache("test","test",1);
    //echo "insertion réussie";
    // affichage des taches
    $taches=$gateway->getTaches();
    //echo "affichage des taches";
    //echo $taches;
    foreach ($taches as $tache){
        //echo $tache;
    }
    foreach($taches as $tache){
        echo $tache->getNom();
        echo $tache->getDescriptionTache();
        echo $tache->getImportance();
        echo $tache->getDateCreation();
        echo $tache->getDateModification();
        echo "<br>";
    }
}catch (PDOException $e){
    echo "<h3> Erreur PDO : " . $e->getMessage() . "</h3>";
}catch (Exception $e){
    echo "<h3> Erreur : " . $e->getMessage() . "</h3>";
}







?>

</body>
</html>