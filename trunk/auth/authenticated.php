<?php
  	session_start();
	
	if (!isset($_SESSION['is_logged_in'])) {
		header("Location:login.php");
		die();
	}
	
	/*print_r($_REQUEST);
	print_r("session_id(): ".session_id());
	print_r($_SESSION);
	echo "<br>";*/
	//print_r($_COOKIE["PHPSESSID"]);
	?>
	<!--	
		<h1>You are logged</h1>
		<br>
		<form action="logout.php" method="post" accept-charset="utf-8">
			<input type="hidden" name="is_logged_in" value=0>
			<input type="submit" value="Deconnexion"></p>
		</form>
	-->	
	<?php
?>

