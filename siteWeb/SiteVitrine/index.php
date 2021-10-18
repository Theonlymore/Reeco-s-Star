<?php
session_start();
include 'connexion.php'; 
try { 
	if (isset($_SESSION['id'])) {
		$req = $pdo->prepare("SELECT utilprenom FROM utilisateur WHERE utilpseudos = '".$_SESSION['id']."' ;");
		$req->execute();
		$result = $req->fetchAll();
	}
} catch (PDOException $e) {
	print "Erreur !:".$e->getMessage(). "<br/>";
	die();
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link href="index_styles.css" rel="stylesheet">
<link href="all.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@700&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet"> 
</head>

<body>
	<header>
		<div id="menu">
			<nav id="logo">
				<div><a>Reeco's Star</a></div>
			</nav>
			<nav id="objet">
				<div><a href="#objet1">Piano</a></div>
				<div><a href="#objet2">Guitare</a></div>
				<div><a href="#objet3">Thoramine</a></div>
				<div><a href="#objet4">Ocarina</a></div>

			</nav>		
			<nav id="ident">
				 <?php if (isset($_SESSION['id'])) { echo '<a href="compte.php"> Mon Compte </a>'; } else echo '<a href="login.php"> Identification </a>'; ?>
			</nav>
		</div>
	</header>
	<!-- Objet 1 -->
	<div id="objet1">
		<div id=titleObjet>
			<a> PIANO </a>
		</div>	
			<div id="infBouton">
				<button id="info"> <a href="objet1.php">Information</a></button>
				<!-- <button id="commande">Commande</button> -->
			</div>
		</div>
	</div>	
		<!-- Objet 2 -->
	<div id="objet2">
		<div id=titleObjet>
			<a>Guitare</a>
		</div>
		<div id="infBouton">
			<button id="info"><a href="objet2.html">Information</a></button>
			<!-- <button id="commande">Commande</button> -->
		</div>
	</div>
	<!-- Objet 3 -->
	<div id="objet3">
		<div id=titleObjet>
			<a>Thoramine</a>
		</div>
		<div id="infBouton">
			<button id="info"><a href="objet3.html">Information</a></button>
			<!-- <button id="commande">Commande</button> -->
		</div>
	</div>
	<!-- Objet 4 -->
	<div id="objet4">
		<div id=titleObjet>
			<a>Ocarina</a>
		</div>
		<div id="infBouton">
			<button id="info"><a href="objet4.html">Information</a></button>
			<!-- <button id="commande">Commande</button> -->
		</div>
	</div>


</body>
</html>
