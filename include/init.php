<?php
	switch($NomPage){ // Configuration des pages
		case "404":
			$TitrePage = "404 Error";
			$descPage = "Url not found on Tarkett Awards website";
			break;
		case "index":
			$idPage = 1;
			$IsTitre = false;
			$TitrePage = "AnyEAT";
			$descPage = "Bienvenue sur le site de anyEAT";
			break;
		case "contact":
			$idPage = 2;
			$TitrePage = "Page Contact";
			$descPage = "La page de contact";
			break;
		case "fournisseur":
			$idPage = 3;
			$TitrePage = "Page Fornisseur";
			$descPage = "Le meilleur moyen de rendre votre production profitable";
			break;
		case "benevoleStock":
			$idPage = 3;
			$TitrePage = "Page Benevol";
			$descPage = "La gestion d'une Amap est entre vos mains";
			break;	
		case "benevoleProposition":
			$idPage = 4;
			$TitrePage = "Proposition des bénévoles";
			$descPage = "";
			break;
		case "benevoleGestion":
			$idPage = 5;
			$TitrePage = "Gestion de la page benevole";
			$descPage = "";
			break;
		case "client":
			$idPage = 6;
			$TitrePage = "Page Client";
			$descPage = "Votre page de connexion cher membre";
		case "fournisseur":
			$idPage = 7;
			$TitrePage = "Votre abonnnement";
			$descPage = "";
		case "fournisseurProposition":
			$idPage = 8;
			$TitrePage = "inscription";
			$descPage = "";
		case "clientEtatAbo":
			$idPage = 9;
			$TitrePage = "inscriptionAMAP";
			$descPage = "";
		case "inscription":
			$idPage = 10;
			$TitrePage = "inscriptionBenevole";
			$descPage = "";
		case "inscriptionBenevole":
			$idPage = 11;
			$TitrePage = "inscriptionBenevole";
			$descPage = "";
		case "inscriptionClient":
			$idPage = 12;
			$TitrePage = "inscriptionClient";
			$descPage = "";
		case "inscriptionFournisseur":
			$idPage = 13;
			$TitrePage = "inscriptionFournisseur";
			$descPage = "";
		case "inscriptionAMAP":
			$idPage = 14;
			$TitrePage = "inscriptionBenevole";
			$descPage = "";
		case "panier":
			$idPage = 15;
			$TitrePage = "Panier de la semaine";
			$descPage = "";
		case "benevole":
			$idPage = 16;
			$TitrePage = "Mon compte benevol";
			$descPage = "";

	}

	if(isset($TitrePage)){ // Titre de fenetre (fil d'Ariane inverse)
		if(($idPage != 1) && (strlen($TitrePage) > 0)){
			$HeadTitle .= $TitrePage." - ";
		}
	}
	$HeadTitle .= "AnyEAT";
?>