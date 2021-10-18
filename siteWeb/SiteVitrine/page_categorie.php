<?php

include 'connexion.php';

$req = $pdo->prepare("SELECT * FROM categorie;");
$req->execute();
$result = $req->fetchAll();

//var_dump($result);

echo'<table border="1px">';
echo'<tr><td>num</td><td>libell&eacute;</td><td>modifier</td><td>supprimer</td><td>ajouter</td></tr>';
for($i=0; $i<count($result); $i++) {
    echo'<tr><td>'.$result[$i]['id_categorie'].'</td><td>'.$result[$i]['lib_categorie'].'</td><td><a href="page_categorie.php?action=1&id='.$result[$i]['id_categorie'].'">modifier</a></td><td><a href="page_categorie.php?action=2&id='.$result[$i]['id_categorie'].'">supprimer</a></td><td><a href="page_categorie.php?action=3&id='.$result[$i]['id_categorie'].'">ajouter</a></td></tr>';
}
echo'</table>';

if(isset($_GET['action'])) 
{
    switch($_GET['action']) {
        case 1: {//bloc pour modifier
                if(isset($_GET['id']) && isset($_GET['lib'])) {
                    //mise à jour de la table
                    $req = $pdo->prepare("UPDATE categorie set lib_categorie='".$_GET['lib']."' WHERE id_categorie=". $_GET['id'].";");
                    $req->execute();
                } else {
                    //afficher la ligne concernée
                    $req = $pdo->prepare("SELECT * FROM categorie where id_categorie=".$_GET['id'].";");
                    $req->execute();
                    $result = $req->fetchAll();
                }
?>
                <form action="page_categorie.php" method="GET">
                    <p><input type="hidden" name="action"value="1"/></p>
                    <p><label for="id">ID : </label><input name="id"value="<?=$result[0]['id_categorie']?>" /></p>
                    <p><label for="lib">libell&eacute: </label><input name="lib"value="<?=$result[0]['lib_categorie']?>" /></p>
                    <p><input type="submit"value="MODIFIER"/></p>
                    </form>';
<?php
                break;}

        case 2: {//bloc pour supprimer
                $req = $pdo->prepare("DELETE FROM categorie WHERE id_categorie=".$_GET['id']."");
                if($req->execute()) echo "suppresion ok";
                break;}

        case 3: { //bloc pour ajouter
                echo '<form action="page_categorie.php" method="GET">
                    <p><input type="hidden" name="action"value="3"/></p>
                    <p><label for="lib">libell&eacute : </label><input name="lib"/></p>
                    <p><input type="submit"value="AJOUTER"/></p>
                    </form>';
                $req = $pdo->prepare("INSERT INTO categorie (lib_categorie) values('".$_GET['lib']."')");
                if($req->execute()) echo "maj ok";else echo "maj echec";
                break;}
    }
}

$pdo=null;
?>