<!-- Liste des Stocks, Propositions, Gestion des clients -->
<?php 
	//$con = connexion($LOGIN, $MDP);
 ?>

<form class="form">
	<h2>Demandes occasionnelles, statistiques pour le trimestre</h2>
	<br>
	<p>Clients qui ont payé : <?php paye($CONNEXION); ?></p>
	<br>
	<p>Clients qui n'ont pas payé : <?php nonpaye($CONNEXION); ?></p>
	<br>
	<p>Gagné : <?php argentGagne($CONNEXION); ?></p>
	<br>
</form>






