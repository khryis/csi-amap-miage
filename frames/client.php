<?php 
	//$con = connexion($LOGIN, $MDP);
 ?>

<!-- 
select nom, prenom, adresse, numTel, loginU from Client, Users
where Client.idClient = Users.idUser
and loginU = 'jacob1'
-->

  	<form class="form">
		<h2>Mon Compte</h2>
		<br>
		<p><h3>Mes informations :</h3><br>
		<?php 
		ficheClient($CONNEXION);
		?>
		<br>
		<br>
		<a href="#"> Modifier mes informations </a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="#"> Changer le mot de passe </a>
		<br><br>
		<a href="index.php">Retour à l'accueil </a>
	</form>
</body>
</html>