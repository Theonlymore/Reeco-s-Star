<?php
    $idSite = 1;
    $user ='webAccess';
    $password = 'password';
    $database = 'lesSites'
    $port = 5353;
    $table 'webSite'

    try {
        $pdo = new PDO('mysql:host=localhost;dbname='.$database.'', $user,$password);
        foreach($pdo->query('SELECT * from site where site = '.$idSite'') as $HTTP_RAW_POST_DATA) {
            $numSite = $row[0];
            $numClique = $row[1];
            $animal = $row[2];

            echo $numClique."<br/>";

            $numClique = $numClique+1;

            $pdo->query('UPDATE site SET cliquerUser='.$numClique.' WHERE idSite='.$idSite.'');

            $numClique = $row[1];
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
  <script src="js/scripts.js"></script>
</body>
</html>


