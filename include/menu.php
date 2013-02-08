<?php
    if(($IS_LOGGED_IN)and($TYPE == 4)){
?>
    <ul id="nav">
        <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" />
        <li class="current"><a href="index.php">Accueil</a></li>
        <li class="current"><a href="contact.php">Nous contacter</a></li>
        <li><a href="benevole.php" rel="group" class="popup">Mes options</a>
            <ul>
                <li><a href="benevoleStock.php">Liste des stocks</a></li>
                <li><a href="benevoleGestion.php">Gestion des clients</a></li>
                <li><a href="benevoleProposition.php">Proposition</a></li>
            </ul>
        </li>
        <li>    
            <form name="login" id="deconnexion" action="auth/logout.php" method="post">
                <input type="submit" class="myButton current" value=""></input>
            </form>
        </li>       
    </ul>
<?php
    }elseif(($IS_LOGGED_IN)and($TYPE==1)){
?>
    <ul id="nav">
        <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" />
        <li class="current"><a href="index.php">Accueil</a></li>
        <li class="current"><a href="contact.php">Nous contacter</a></li>
        <li><a class="current" href="panier.php">Panier</a></li>
        <li><a href="client.php" rel="group" class="popup">Mes options</a>
            <ul>
                <li><a href="client.php">Mon compte</a></li>
                <li><a href="clientEtatAbo.php">Etat Abonnement</a></li>
            </ul>
        </li>
        <li>    
            <form name="login" id="deconnexion" action="auth/logout.php" method="post">
                <input type="submit" class="myButton current" value=""></input>
            </form>
        </li>
    </ul>
<?php
	}elseif (($IS_LOGGED_IN)and($TYPE==2)) {
?>
    <ul id="nav">
        <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" />
        <li class="current"><a href="index.php">Accueil</a></li>
        <li class="current"><a href="contact.php">Nous contacter</a></li>
        <li><a href="fournisseur.php" rel="group" class="popup">Mes options</a>
            <ul>
                <li><a href="fournisseur.php">Mon compte</a></li>
                <li><a href="fournisseurProposition.php">Proposition</a></li>
            </ul>
        </li>
        <li>    
            <form name="login" id="deconnexion" action="auth/logout.php" method="post">
                <input type="submit" class="myButton current" value=""></input>
            </form>
        </li>
    </ul>
<?php
    }elseif (($IS_LOGGED_IN)and($TYPE==3)) {
?>
    <ul id="nav">
        <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" />
        <li class="current"><a href="index.php">Accueil</a></li>
        <li class="current"><a href="contact.php">Nous contacter</a></li>
        <li><a href="amap.php" rel="group" class="popup">Mes options</a>
            <ul>
                <li><a href="amap.php">Mon compte</a></li>
                <li><a href="amapProposition.php">Demandes</a></li>
            </ul>
        </li>
        <li>    
            <form name="login" id="deconnexion" action="auth/logout.php" method="post">
                <input type="submit" class="myButton current" value=""></input>
            </form>
        </li> 
    </ul>
<?php
    }elseif (isset($_SESSION["username"])){
        if($_SESSION["username"] == 'anyEAT') {
?>
            <ul id="nav">
                <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" /> 
                <li class="current"><a href="index.php">Accueil</a></li>
                <li class="current"><a href="contact.php">Nous contacter</a></li>
                <li><a href="#" rel="group" class="popup">Admin</a>
                    <ul>
                        <li><a href="panier.php">Panier</a></li>
                        <li><a href="benevoleGestion.php">Bénévole Gestion</a></li>
                        <li><a href="benevoleProposition.php">Bénévole Proposition</a></li>
                        <li><a href="benevoleStock.php">Bénévole Stock</a></li>
                        <li><a href="fournisseurProposition.php">Fournisseur Proposition</a></li>
                        <li><a href="client.php">Fiche Client</a></li>
                        <li><a href="amap.php">Fiche AMAP</a></li>
                        <li><a href="fournisseur.php">Fiche Fournisseur</a></li>
                        <li><a href="clientEtatAbo.php">Etat Abonnement Client</a></li>
                        <li><a href="amapProposition.php">Proposition pour une AMAP</a></li>
                    </ul>
                </li>
                <li>
                    <a class="site" href="panier.php?iframe">Panier</a>
                </li>
                <li>    
                    <form name="login" id="deconnexion" action="auth/logout.php" method="post">
                        <input type="submit" class="myButton current" value=""></input>
                    </form>
                </li>
            </ul>
        <?php 
        }    
        ?>    
<?php
    }else{
        if(!$IS_LOGGED_IN){
?>
    <ul id="nav">
        <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" />
        <li class="current"><a href="index.php">Accueil</a></li>
        <li class="current"><a href="contact.php">Nous contacter</a></li>
        <li><a class="site" href="panier.php?iframe">Panier</a></li>
    </ul>
<?php
        }
    }    
?>
