<?php
    $idSite = 1;
    $user ='webAccess';
    $password = 'password';
    $database = 'lesSites';
    $port = 5353;
    $table = 'webSite';

    try {
        $pdo = new PDO('mysql:host=localhost;dbname='.$database.'', $user,$password);
        foreach($pdo->query('SELECT * from '.$table.' where idSite ='.$idSite.'') as $row) {
            $numSite = $row[0];
            $visiteOnSite = $row[1];
            $animal = $row[2];

            $visiteOnSite = $visiteOnSite+1;

            $pdo->query('UPDATE '.$table.' SET visiteOnSite='.$visiteOnSite.' WHERE idSite='.$idSite.'');

            $visiteOnSite = $row[1];
        }
    } catch (PDOException $e){
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>site du premier site</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>

<body>
    <a>site numéro : <?php echo $numSite ?></a> <br/>
    <a>Nombre de visite : <?php echo $visiteOnSite ?></a><br/>
    <a>Animal pref : <?php echo $animal ?></a><br/>


</body>
</html>


