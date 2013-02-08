<?php
	if((($idPage == 1)or(($idPage == 2)))and(!isset($_SESSION["username"]))){
?>
    <ul id="nav">
        <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" />
        <li class="current"><a href="index.php">Accueil</a></li>
        <li class="current"><a href="contact.php">Nous contacter</a></li>
        <li><a class="site" href="panier.php?iframe">Panier</a></li>
    </ul>
<?php
	}elseif(($idPage == 3)or($idPage == 4)or($idPage == 5)or($idPage == 6)or($TYPE==4)){
?>
    <ul id="nav">
        <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" />
        <li class="current"><a href="index.php">Accueil</a></li>
        <li class="current"><a href="contact.php">Nous contacter</a></li>
        <li><a href="benevole.php" rel="group" class="popup">Mes options</a>
            <ul>
                <li><a href="benevolStock.php">Liste des stocks</a></li>
                <li><a href="benevoleGestion.php">Gestion des clients</a></li>
                <li><a href="benevoleProposition.php">Proposition</a></li>
                <li><a href="benevole.php">Mon compte</a></li>
            </ul>
        </li>
        <li class="current"><a href="index.php?logout=true">Deconnexion</a></li>
    </ul>
<?php
    }elseif(($idPage == 6)or($idPage == 9)or($TYPE==1)){
?>
    <ul id="nav">
        <img src="images/logo.jpg" title="Green Solutions" alt="Green Solutions" width="204" height="57" border="0" />
        <li class="current"><a href="index.php">Accueil</a></li>
        <li class="current"><a href="contact.php">Nous contacter</a></li>
        <li><a href="client.php" rel="group" class="popup">Mes options</a>
            <ul>
                <li><a href="client.php">Mon compte</a></li>
                <li><a href="clientEtatAbo.php">Etat Abonnement</a></li>
            </ul>
        </li>
        <li class="current"><a href="index.php?logout=true">Deconnexion</a></li>  
    </ul>
<?php
	}elseif (($idPage == 7)or($idPage == 8)or($TYPE==2)) {
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
        <li class="current"><a href="index.php?logout=true">Deconnexion</a></li>
    </ul>
<?php
    }elseif (($idPage == 7)or($idPage == 8)or($TYPE==3)) {
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
        <li class="current"><a href="index.php?logout=true">Deconnexion</a></li>
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
                <li><a class="site" href="panier.php?iframe">Panier</a></li>
                <li class="current"><a href="index.php?logout=true">Deconnexion</a></li>
            </ul>
        <?php 
        }    
        ?>    
<?php
    }else{
?>
    <!-- Some Code -->
<?php
    }
?>     

