<?php
        #$userDataBase ='root';
        #$passwordDatabase = '';
        $database = 'lesSites';
        $tableDataBase = 'srvuser';

        $userDataBase ='webAccess';
        $passwordDatabase = 'password';
        $database = 'lesSites';


        $yearSelect = "tout";



        if(isset($_GET['userRemove']) AND isset($_GET['portRemove'])) {
            $userRemove = $_GET['userRemove'];
            $portRemove = $_GET['portRemove'];
            if(!empty($userRemove) AND !empty($portRemove)){
                pdoRemoverUser($userRemove,$portRemove);
                echo($userRemove);
                echo($portRemove);
            }
        }


        #verif variable existe et pas vide
        if(isset($_POST['DataBase_User']) AND isset($_POST['DataBase_Year']) AND isset($_POST['DataBase_Port']) AND isset($_POST['DataBase_Password']) ){
            $DataBase_User = $_POST['DataBase_User'];
            $DataBase_Year = $_POST['DataBase_Year'];
            $DataBase_Port = $_POST['DataBase_Port'];
            $DataBase_Password = $_POST['DataBase_Password'];
            if(!empty($DataBase_User) AND !empty($DataBase_Year) AND !empty($DataBase_Port) AND !empty($DataBase_Password)){
                echo("Les 3 var existe");
                echo($DataBase_User);
                echo($DataBase_Year);
                echo($DataBase_Port);
                echo($DataBase_Password);
                pdoSendUser($DataBase_User,$DataBase_Year,$DataBase_Port,$DataBase_Password);
            }            
        }

        if (isset($_POST['DataBaseYearFilter'])){
            $yearSelect = $_POST['DataBaseYearFilter'];
        }

        #tableau auto en fonction du query (connect a la base)
    function pdoToTable($whereQuery){
        echo(" 
        <table>
            <tr>
                <th>Utilisateurs :</th>
                <th>AnnÃ©e :</th>
                <th>Port :</th>
                <th>Remove :</th>

            </tr>

        ");
        

        try {
            $pdo = new PDO('mysql:host=localhost;dbname='.$GLOBALS['database'].'', $GLOBALS['userDataBase'],$GLOBALS['passwordDatabase']);
            foreach($pdo->query('SELECT * from '.$GLOBALS['tableDataBase'].' where '.$whereQuery.' ;' ) as $row) {

            echo("
            <tr> 
            <td>".$row[0]."  </td>
            <td>".$row[1]."  </td>
            <td>".$row[2]."  </td>
			<td><a href=pageConfig.php?userRemove=".$row[0]."&portRemove=".$row[2]."> yolo</td>

            </tr>"
            );


            

    
            }
        } catch (PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function pdoRemoverUser($userRemoveFunction,$portRemoveFunction){
        $pdo = new PDO('mysql:host=localhost;dbname='.$GLOBALS['database'].'', $GLOBALS['userDataBase'],$GLOBALS['passwordDatabase']);
        $pdo->query('DELETE FROM `srvuser` WHERE `user` = "'.$userRemoveFunction.'"');
        echo("user remove !!!");
        $cmd = "sudo bash /root/Script/removeUser ".$userRemoveFunction." ".$portRemoveFunction."";
        shell_exec($cmd);
        $_GET = NULL;

        echo('<meta http-equiv="refresh" content="0;URL=pageConfig.php"> ');


    }
    function pdoSendUser($user,$year,$port,$password){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname='.$GLOBALS['database'].'', $GLOBALS['userDataBase'],$GLOBALS['passwordDatabase']);
            $pdo->query("INSERT INTO `srvuser`(`user`, `year`, `port`) VALUES ('$user','$year','$port');");
            $cmd = "sudo bash /root/Script/addUserAll ".$user." ".$password." ".$port."";

            echo($cmd);
            
            shell_exec($cmd);
            echo("Ajoute User");
            unset($_POST);
            unset($DataBase_User);
            unset($DataBase_Year);
            unset($DataBase_Port);
            unset($DataBase_Password);
            echo('<meta http-equiv="refresh" content="0;URL=pageConfig.php"> ');

            }
        catch (PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

    }

    if ($yearSelect == "tout"){
        $whereQuery = "1 = 1";
    }
    else {
    $whereQuery = "year = ".$yearSelect." ";
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
<?php
    pdoToTable($whereQuery);
?>

<h1>Gestion de service utilisateur :</h1>
<hr>

<FORM action="pageConfig.php" method="post" name="yearSelect">
    <h2> Ajoute d'utilisateur :</h2>
    </br>

    User : <input type="text" name="DataBase_User" value="">
    Year : <input type="number" name="DataBase_Year" value="">
    Port : <input type="number" name="DataBase_Port" value="">
    Password : <input type="password" name="DataBase_Password" value="">
    <input type="submit" value="send">
    </br>


<FORM>



<hr>
<FORM action="pageConfig.php" method="post" name="yearSelect">
    Gestion des sites de l'annÃ©e :
    <SELECT name="DataBaseYearFilter" size="1">
        <OPTION>2018
        <OPTION>2019
        <OPTION selected>2020
        <OPTION>2021
        <OPTION>2022
        <OPTION>tout
    </SELECT>
<input type="submit" value="Envoyer">
</FORM>




    <!-- <a>site numÃ©ro : <?php echo $numSite ?></a> <br/>
    <a>Nombre de visite : <?php echo $visiteOnSite ?></a><br/>
    <a>Animal pref : <?php echo $animal ?></a><br/> -->


</body>
</html>


