<?php 
	$con = connexion($LOGIN, $MDP);
 ?>
  	<form class="form">
		<h2>Etat de mon abonnement</h2>
		<br>
		<p><?php infoClient($con) ?> 
		</p>
		<br>
		<br>
		<a href="#"> Modifier le nombre de paniers voulu </a>
		<br>
		<br>
		<a href="passeComOcc.php"> Faire une demande occasionnelle </a> &nbsp; &nbsp; <a href="#"> S'abonner pour un trimestre </a>
		<br><br>
		<a href="index.php">Retour à l'accueil </a>
	</form>
</body>
</html>

