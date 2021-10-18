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
				<div><a href="index.php">Reeco's star</a></div>
			</nav>	
			<nav id="ident">
			
			</nav>
	</header>

	<form method="GET" id="BlocConnexion">
		<div><a id="TextConnexion">Créer un compte</a></div>
				<div id="margeConnexion">
					<a id="Nom">Nom</a>
					<br>
					<input name="nom" type="text">
					<br>

					<a id="Prenom">Prénom</a>
					<br>
					<input name="prenom" type="text">
					<br>

					<a id="rue">Adresse</a>
					<br>
					<input name="rue" type="text">
					<br>

					<a id="ville">Ville</a>
					<br>
					<input name="ville" type="text">
					<br>

					<a id="cp">Code Postale</a>
					<br>
					<input name="cp" type="text">
					<br>

					<a id="tel">Téléphone</a>
					<br>
					<input name="tel" type="text">
					<br>

					<a id="pseudo">Pseudo</a>
					<br>
					<input name="pseudo" type="text">
					<br>

					<a id="email">Adresse e-mail</a>
					<br>
					<input name="email" type="email">
					<br>

					<a id="password">Mots de passe</a>
					<br>
					<input name="pwd" type="password">
					<br>
                    <input id="BoutonCompte" type="submit" value='INSCRIPTION' name='INSCRIPTION'/>
                </div>
		</div>
	</form>
		
		<?php
        if(isset($_GET['INSCRIPTION'])){
			$req = $pdo->prepare("INSERT INTO utilisateur (utilpseudos, utilnom, utilprenom, utilrue, utilcp, utilville, utiltel, utilemail, mdp) VALUES ('".$_GET['pseudo']."', '".$_GET['nom']."', '".$_GET['prenom']."', '".$_GET['cp']."', '".$_GET['rue']."', '".$_GET['ville']."', '".$_GET['tel']."', '".$_GET['email']."', MD5('".$_GET['pwd']."'));");
            // $req = $pdo->prepare('SELECT * FROM utilisateur WHERE utilemail="'.$_GET['login'].'" and mdp=md5("'.$_GET['mdp'].'")');
			if($req->execute()) {
				$_SESSION["id"]=$_GET['pseudo'];
				echo $_SESSION['id'];
				header('Location: compte.php');
			
			}
			else echo "Erreur inscription";
            //header('Location: compte.php');
            // var_dump($result);
        }
        ?>

</body>
</html>
