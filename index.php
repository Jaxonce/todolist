<html>

<body>
test

<?php

require_once("Connection.php");

//A CHANGER
$user = 'malanone';
$pass = 'azertyuiop';
$dsn = 'mysql:host=localhost;dbname=to_do_list';
try {
    $con = new Connection($dsn, $user, $pass);
    $tacheGateway = new ArtisteGateway($con);


    echo $tacheGateway->insert("test", "test", 1);

    $results = $tacheGateway->findAll();
    foreach ($results as $row) {
        print "<br>";
        print "Id : " . $row['id'] . "<br>";
        print "Titre :" . $row['titre'] . "<br>";
        print "Description :" . $row['description'] . "<br>";
        print "Cree le : " . $row['created_at']  . "<br>";
        print "Derniere modif le : " . $row['updated_at'] . "<br>";
        print "Priorite : " . $row['priorite']  . "<br>";
    }
} catch (PDOException $Exception) {
    echo 'erreur';
    echo $Exception->getMessage();
}


?>

</body>

</html>