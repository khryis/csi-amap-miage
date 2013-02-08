<?php 
	//$con = connexion($LOGIN, $MDP);
 ?>
 
 
<!-- 
select adresseAmap, numTelAmap, loginU from Amap, Users
where Amap.idAmap = Users.idUser
and loginU = 'AMAPrestige'
-->

<form class="form">
	<h2>Mon Compte</h2>
	<br>
	<p><h3>Mes informations :</h3><br>
	<?php 
		ficheAMAP($CONNEXION);
	?>
	<br>
	<br>
	<a href="#"> Modifier mes informations </a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="#"> Changer le mot de passe </a>
	<br><br>
	<a href="index.php">Retour à l'accueil </a>
</form>