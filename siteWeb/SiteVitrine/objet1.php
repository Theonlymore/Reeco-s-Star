<?php
session_start();
include 'connexion.php';
$req = $pdo->prepare("SELECT * FROM produit");
$req->execute();
$produit = $req->fetchAll();
$req2 = $pdo->prepare("SELECT * FROM enchere");
$req2->execute();
$enchere = $req2->fetchAll();

/* table enchere status
	si =0 alors enchere en cours
	si =1 enchere terminer il faut contacter le client
	si =2 enchere conclue
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link href="all_objet_styles.css" rel="stylesheet">
<link href="all.css" rel="stylesheet">
<link href="connexion.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet"> 

	<!-- Mise en place le l'image de fond au sein de la page html	 -->
<style> 
	body{
    background-image: url(image/piano.jpg);
    background-size: cover;
    background-position: center;
	}
</style>
<!-- fin de la mise en place de l'image de fond au sein de la page html -->
</head>
<body>
	<header> 
		<div id="menu">
			<nav id="logo">
				<div><a href="index.php">Reeco's star</a></div>
			</nav>	
			<nav id="ident">
				<a href="login.php">Identification</a>
			</nav>
	</header>


	<article>
		<div id="info">
			<div id="titreInfo">
				<a> <?php for($i=0; $i<count($produit); $i++) { echo $produit[$i]['prodtitre']; } ?> </a>
			</div>
			<div id="desc">
				<a><?php for($i=0; $i<count($produit); $i++) { echo $produit[$i]['proddetail']; } ?> </a>
			</div>
		</div>
			
		<div id="enchere">
			<div id="headEnchere">
                <a id="EnchereEnchereSize">Enchère</a>
                <?php $req = $pdo->prepare("SELECT * FROM enchere");
                $req->execute();
                $enchere = $req->fetchAll();
                ?>
				<a>du <?php echo $enchere[0]['encheredate'];  ?> </a>
			</div>
			
				<div id="prix">
					<p id="OffreAct"><a>Offre actuelle</a></p>
					<p id="EuroAct"><a> 
                        <?php echo $produit[0]['prodprixencours'].'€'; ?> 
                     </a></p>
                </div>
	

			<div id="marge">	
				<div id="fermeDans">
					<a>Ferme le</a>
				</div>

				<div id="FermeHeure">
					<a> <?php echo $enchere[0]['encherdatefin'] ?> 
					
					<div id="affiche">Temps avant fin des enchères.</div>
 
						<script type="text/javascript">
						var finTemps = <? php echo $donnees['finEnchere']; ?>; // < ?php echo $donnees['finEnchere']; ? >
						var timestampActuel = <?php echo time(); ?>; // donne le timestamp actuel
						var duree = finTemps - timestampActuel; // durée = temps total - temps actuel
						var dureeHeure, dureeMinute, dureeSeconde; // initialise variable, pour qu'elles ne soient pas global
						var div = document.getElementById("affiche"); // récupère la div affiche
						
						// fait un interval régulier de 1s
						var timer = setInterval(function(){
														
								// boucle tant que la durée est supérieur à 0
								if(duree>0)
								{
									dureeHeure = parseInt(duree/3600);
									dureeMinute = parseInt((duree-(dureeHeure*3600))/60);
									dureeSeconde = duree-((dureeHeure*3600)+(dureeMinute*60));
									var old_contenu = div.firstChild; // récup le premier enfant (le texte)
									div.removeChild(old_contenu); // supprime l'ancien contenu
									var texte = document.createTextNode(dureeHeure+":"+dureeMinute+":"+dureeSeconde); // crée un node texte valeur de la durée
									div.appendChild(texte); // affiche le node
									
									duree -= 1; // diminue la durée de l'enchère
								}
								// si l'enchère est finis
								else
								{
									var old_contenu = div.firstChild;
									div.removeChild(old_contenu); // supprime le contenu
									var texte = document.createTextNode('Enchère finis !'); // affiche message de fin, voir une alert
									div.appendChild(texte);
									clearInterval(timer); // interrompt la boucle de setInterval
								}
							}, 1000); // 1000ms
						</script>
					</a>
				</div>
				<!-- barre de progression -->
				<div id="progress">	
					<div></div>
				</div>
				<!-- Barre d'ecriture -->
				<form method="GET">
                <input type="text" id="prix" name="prix" requiredminlength="4" maxlength="8" size="10">
                <input id="BoutonCompte" type="submit" name='ENCHERIR' value='ENCHERIR'/>
        		</form>

				<?php
				if(isset($_SESSION['id'])) {
					if(isset($_GET['ENCHERIR'])){
						$req = $pdo->prepare("INSERT INTO enchere (encheredate, prodnum, utilpseudo, montant, encherdatefin) VALUES ('1', '".$_SESSION['id']."', '".$_GET['prix']."');");
						// $req = $pdo->prepare('SELECT * FROM utilisateur WHERE utilemail="'.$_GET['login'].'" and mdp=md5("'.$_GET['mdp'].'")');
						if($req->execute()) {
							echo '<a> Vous avez enchéri !</a>';
						
						}
						else echo "<a> Erreur quand echérisser !</a>";
						//header('Location: compte.php');
						// var_dump($produit);
					}
				}
				else echo "<a> Vous devez être connecter !</a>"

				?>

			</div>
		</div>
	</article>
</body>
</html>
