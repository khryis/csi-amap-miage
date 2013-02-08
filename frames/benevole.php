<?php 
	//$con = connexion($LOGIN, $MDP);
 ?>

<!-- 
select nomBene, prenomBene, adresseBene, numTelBene, loginU from Benevole, Users
where Benevole.idBenevol = Users.idUser
and loginU = '$USERNAME'
-->

  	<form class="form">
		<h2>Mon Compte</h2>
		<br>
		<p><h3>Mes informations :</h3><br>
		<?php 
		ficheBenevole($CONNEXION);
		?>
		<br>
		<br>
		<a href="#"> Modifier mes informations </a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="#"> Changer le mot de passe </a>
		<br><br>
		<a href="index.php">Retour à l'accueil </a>
	</form>
</body>
</html>