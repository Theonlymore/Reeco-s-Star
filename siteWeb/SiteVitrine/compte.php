<?php
session_start();
include 'connexion.php';
if ($_SESSION['connexion']=1) {
	$req = $pdo->prepare("SELECT * FROM utilisateur WHERE utilpseudos = '".$_SESSION['id']."' ;");
	$req->execute();
	$result = $req->fetchAll();
}


$req = $pdo->prepare("SELECT * FROM produit;");
$req->execute();
$produit = $req->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link href="infoCompte.css" rel="stylesheet">
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
				<a href="unlog.php" type="submit">DECONNEXION</a>
			</nav>
	</header>
	<div id="infoPersonnel">
		<h1 id="textInfoPersoTitle">Info personnel</h1>

		<p id="textInfoPersoNom">Nom :  <?php echo $result[0]['utilnom'];  ?></p> 
		<p id="textInfoPersoPrenom">Prénom : <?php echo $result[0]['utilprenom'];  ?></p>
		<p id="textInfoPersoEmail">Adresse e-mail : <?php echo $result[0]['utilemail']; ?></p>
	</div>

	<div id="mesEncheres">

		<h1 id="textMesEncheres">Mes enchères</h1>

		<div id="articleEnchere">
			<div id="enchere1">
				<a id="articleObjetEnchere">Ocarina</a>
				<img src="image/ocarina.jpg">
				<a id="EnchereTextStatue">Enchère gagné</a>
			</div>
			<div id="enchere2">
				<a id="articleObjetEnchere">Thoramine</a>
				<img src="image/tesla.jpg">
				<a id="EnchereTextStatue">Enchère en attente</a>
			</div>
			<div id="enchere3">
				<a id="articleObjetEnchere">Guitar</a>
				<img src="image/kurtwithguitar.jpg">
				<a id="EnchereTextStatue">Enchère en attente</a>
			</div>
			<div id="enchere4">
				<a id="articleObjetEnchere">Piano</a>
				<img src="image/piano.jpg">
				<a id="EnchereTextStatue"> <?php for($i=0; $i<count($produit); $i++) {
													if ($produit[$i]['catcode']=1) {
														echo 'Enchère en cours'; } 
													else { 
														echo 'Enchère finis';
													}
														 
												} 
											?> 
				</a>
												
			</div>
		</div>
	</div>
 <a>CONTACT : <br> </a>
 <?php include 'contact.php'; ?>



</body>
</html>
