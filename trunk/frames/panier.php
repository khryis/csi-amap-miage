<?php 
	$con = connexion();
 ?>

<form class="form">
	<div id="panier">
	<p><h2>Le panier de cette semaine est composé de : </h2></p>
	<br>
	<?php 
		panier($con);
	?>
	</div>
</form>
