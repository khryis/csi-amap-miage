<?php 
	//$con = connexion($LOGIN, $MDP);
 ?>
 
<form class="form">
	<h2>Préparation du panier</h2>
	<h3>Indiquez les quantités pour chaque produit</h3>
	<br>
	<p> Solde restant : 
	<?php 
		solde($CONNEXION);
	?> €</p>
	<br>
	<p> Nombre de paniers à faire : 
	<?php 
		nbPanier($CONNEXION);
	?></p>
	<br>
	
	
	<div id="panier">
		<p>Le panier de cette semaine est composé de : </p>
		<br>
		<?php 
			panier($CONNEXION);
		?>
		<a href="#"><img src="../images/modif.png"/>&nbsp; Modifier le panier<a>
	</div>
	
	<div id="propositionFournisseur">
		<h2>Proposition des fournisseurs</h2>
		<?php
			afficheProp($CONNEXION);
		?>
	</div>
	<div id="propositionStock">
		<h2>Nos stocks</h2>
		<?php
			affichePropStock($CONNEXION);
		?>
	</div>
	<div class="finLigne"></div>
	
	<div class="button">
		<button type="submit">Valider</button>
	</div>
</form>
