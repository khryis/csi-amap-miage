<?php 
	//$con = connexion($LOGIN, $MDP);

/************* On récupère les données ****************/
if (isset($_POST['produit']) and isset($_POST['qte']) and isset($_POST['prix']) and isset($_POST['date'])){
	$produit = $_POST['produit'];
	$qte = $_POST['qte'];
	$prix = $_POST['prix'];
	$date = $_POST['date'];
	
	proposition($CONNEXION, $produit, $qte, $prix, $date);
}

?>

<form class="form">
	<div id="panier">
		<p><h2>Les produits proposés sont : </h2></p>
		<br>
		<?php 
			produit($CONNEXION);
		?>
	</div>
</form>

<div id="bodyPan">
  	<form method="post" action="fournisseurProposition.php" class="form">
		<h2>Envoie des propositions</h2>
		<h3>Indiquez les quantités à vendre pour chaque produit</h3>
		<br>
		<div>
			<p>Produit :</p>
			<label for="prod1">Nom du produit :</label>
			<select name="produit" id="produit" required>
			<?php
				//echo $LOGIN;echo $MDP; echo $USERNAME;
				listProd($CONNEXION);
			?>
			</select><br>
			<label for="qte1">Quantité :</label>
			<input type="text" name="qte" id="qte" required/><br>
			<label for="prix1">Prix : </label>
			<input type="text" name="prix" id="prix" required/><br>
			<label for="date1">Date de péremption :</label>
			<input type="date" name="date" id="date" required/><br><br>
		</div>
		
		<a href="ajoutProduit.php">Ajouter un nouveau produit</a>
		
		<div class="button">
		<button type="submit">Valider</button>
	</div>
	</form>
</div>
<?php

?>

