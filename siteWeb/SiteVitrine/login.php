<?php
    session_start();
    include 'connexion.php';
    
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link href="connexion.css" rel="stylesheet">
<link href="all.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet"> 

</head>
<body>
	<header> 
		<div id="menu">
			<nav id="logo">
				<div><a href="index.html">Reeco's star</a></div>
			</nav>	
			<nav id="ident">
				<a href="compte.php">...</a>
			</nav>
	</header>

	<div id="BlocConnexion">
        <div><a id="TextConnexion">Connexion</a></div>
        <form method="GET">
				<div id="margeConnexion">
				<a id="email">Pseudo</a>
				<br>
				<input name="login" type="text">
				<br>
				<a id="password">Mots de passe</a>
				<br>
                <input name="pwd" type="password">
                <input id="BoutonCompte" type="submit" value='CONNEXION'/>
        </form>
        <a id="ConnexionOu">Ou</a>
        <br>
        <button id="BoutonWhiteToBlack"><a href="register.php">Créer un compte</a></button>
        <?php
        if(isset($_GET['login'])){
            $req = $pdo->prepare('SELECT utilpseudos,mdp FROM utilisateur WHERE utilpseudos="'.$_GET['login'].'" and mdp=md5("'.$_GET['pwd'].'")');
            $req->execute();
            $result = $req->fetchAll();
            if(isset($result[0]['utilpseudos'])) {
                if($_GET['login']=$result[0]['utilpseudos'] && $_GET['pwd']=$result[0]['mdp']) {
                    echo "les logs correspondes";
                    $_SESSION['id']=$result[0]['utilpseudos'];
                    echo $_SESSION['id'];
                    header('Location: compte.php');
                }
            }
            else {
                echo "pseudo ou mot de passe sont incorrects";
            }
        }
            
        ?>


			</div>
	</div>


</body>
</html>



