<div id="leftPan">
	<div id="leftmemberPan">
		<h2>Espace <span>membre</span></h2>
		<?php  
			if ($IS_LOGGED_IN){
				?>
				<form name="login" id="login" action="auth/logout.php" method="post">
					<span>Bonjour <?php echo $USERNAME; ?></span>
					<input type="hidden" name='deconnexion' value='deconnexion'></input>
					<input type="submit" class="gobutton" value="Bye"></input>
				</form>		
				<?php
			}else{
				?>
				<form name="login" id="login" action="auth/check.php" method="post">
					<label>Identifiant</label>
				  	<input type="text" name="username" />
				  	<label class="mdppadding">Mdp</label>
				   	<input class="fieldpadding" type="password" name="password" />
				   	<input type="hidden" name='connexion' value='connexion'></input>
				   	<div id="leftPango"><p class="textposition"><a href="inscription.php">S'inscrire</a></p><input type="submit" class="gobutton" value="GO" />
				   	</div>
				</form>	
				<?php
			}
		?> 
	</div>
</div>