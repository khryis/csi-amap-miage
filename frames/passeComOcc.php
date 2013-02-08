<?php 
	//$con = connexion($LOGIN, $MDP);

/************* On récupère les données ****************/
if (isset($_POST['nbpanier']) and isset($_POST['jourL'])){
	$nbpanier = $_POST['nbpanier'];
	$jourL = $_POST['jourL'];
	
	comOcc($CONNEXION, $nbpanier, $jourL);
}

?>

<form class="form" method="post">
	<h2>Faire une demande occasionnelle</h2><br>
	<div>
		<label for="nbpanier">Nombre de paniers à commander</label><input type="text" name="nbpanier" /><br><br>
	</div>
	<div>
		<label for="jourL">Jour de livraison</label>
		<select name="jourL">
			<option>mardi</option>
			<option>jeudi</option>
		</select>
	</div>
	<a href="clientEtatAbo.php">Retourner à l'état de l'abonnement </a>
	<div class="button">
		<button type="submit">Valider</button>
	</div>
</form>

