<?php
	function connexion($user='anyEAT', $pass='anygonz'){
		global $HOST, $BASE;

		$co = sybase_connect($HOST,$user,$pass,"utf8");
		// test co 
		if (!$co) { 
			//echo "Impossible de se connecter !";
		
			$co = -1;
			exit; 
		}

		// select database 
		$db = sybase_select_db($BASE, $co); 

		// test selection 
		if (!$db) { 
		 	//echo "Couldn't select database!"; 
		 	$co = -1;
		 	exit; 
		}
		return $co; 
	}

	function panier($co){
		$query = "SELECT tp.nomProd, u.quantiteProd, tp.mesure 
					FROM Panier as p, ProduitCommande as pc, Utilise as u, Produit as pr, TypeProduit as tp
					WHERE datePanier between dateadd(dd,-6,getdate()) and getdate()
					AND p.idPanier = u.id_Panier
					AND pc.idProdCom = u.id_ProduitCommande
					AND pr.numP = pc.num_Produit
					AND pr.id_TypeProduit = tp.idType ";			
		$result = sybase_query($query, $co);
		
		echo 	"<table border=1>
				<tr>
					<th>Nom Produit</th>
					<th>Quantite du produit</th>
					<th>Mesure du Produit</th>
				</tr>";

		// formattage des résultats sous forme de tableau
		while ($row = sybase_fetch_array($result)) { 
			$nomProd 	= $row["nomProd"];
			$quantiteProd 	= $row["quantiteProd"];
			$mesure 	= $row["mesure"];
			echo "<tr><td>$nomProd</td><td>$quantiteProd</td><td>$mesure</td></tr>"; 
 		}
 		// libération de la ressource et fermeture de la connexion 
		

		sybase_free_result($result); 
		sybase_close($co); 
		echo "</table>";

		//return $result;
	}

	function affTabResultat($resultQuery, $attr1, $attr2){
		// en-tête du tableau
		echo 	"<table border=1>
				<tr>
					<th>id</th>
					<th>Nom</th>
				</tr>";

		// formattage des résultats sous forme de tableau
		while ($row = sybase_fetch_array($resultQuery)) { 
			$id 	= $row["id"];
			$nom 	= $row["nom"];
			echo "<tr><td>$id</td><td>$nom</td></tr>"; 
 		}
 		// libération de la ressource et fermeture de la connexion 
		sybase_free_result($sql_result); 
		sybase_close($connexion); 
		echo "</table>";
	}

	function getUser($CONNEXION, $username, $password){
		
		$query = "SELECT typeU
					FROM Users as u
					WHERE u.loginU = '$username'
					AND u.mdpU = '$password'";
		
		$result = sybase_query($query, $CONNEXION);
		$typeU = 0;
		while ($row = sybase_fetch_array($result)) { 
			$typeU 	= $row["typeU"];
 		}
		//$row = sybase_fetch_array($result); 
		//$typeU = $row["typeU"];
		sybase_free_result($result);

		return $typeU;
	}

	function stock($CONNEXION){
		$query = "SELECT idType, nomProd, sum(quantiteComRestante) quantite, mesure from ProduitCommande as pc, Produit, TypeProduit
					where pc.num_Produit=Produit.numP
					and Produit.id_TypeProduit=TypeProduit.idType
					and quantiteComRestante > 0
					group by idType, nomProd";

		$result = sybase_query($query, $CONNEXION);
		
		echo 	"<table border=1>
				<tr>
					<th>Nom Produit</th>
					<th>Quantite du produit</th>
					<th>Mesure du Produit</th>
				</tr>";

		// formattage des résultats sous forme de tableau
		while ($row = sybase_fetch_array($result)) { 
			$nomProd 	= $row["nomProd"];
			$quantite 	= $row["quantite"];
			$mesure 	= $row["mesure"];
			echo "<tr><td>$nomProd</td><td>$quantite</td><td>$mesure</td></tr>"; 
 		}
 		// libération de la ressource et fermeture de la connexion 
		
		sybase_free_result($result); 
		//sybase_close($CONNEXION); 
		echo "</table>";			
	}
	
	function proposition($CONNEXION, $produit, $qte, $prix, $date){
		/* 	$USERNAME= LOGIN
		*	$TYPE */
		global $USERNAME;
		
		/* si pas de commande pour cette date, création*/
		$query="SELECT idCom FROM Commande
				WHERE dateCom=getdate()";
		$result = sybase_query($query, $CONNEXION);
		if ($result){
			$query="INSERT INTO Commande VALUES (getdate())";
			$res=sybase_query($query, $CONNEXION);
		}
		sybase_free_result($result);
		
		
		/* select pour récupérer le RCS du fournisseur à partir de la table Users avec $USERNAME= LOGIN */
		$queryRCS="SELECT idUser, typeU from vue_users
					WHERE typeU=2
					AND loginU= '$USERNAME' ";
		$res2=sybase_query($queryRCS, $CONNEXION);
		$rcs=sybase_result($res2, 0, 'idUser');
		sybase_free_result($res2);
		
		/* select pour id du produit à partir du nom! */
		$queryID="SELECT idType FROM TypeProduit
					WHERE nomProd='$produit' ";
		$result=sybase_query($queryID, $CONNEXION);
		$idProd=sybase_result($result, 0, 'idType');
		sybase_free_result($result);
	
		$query = "INSERT INTO Produit VALUES (getdate(), $qte, $prix, '$date', $rcs, null, $idProd)";
		$res3 = sybase_query($query, $CONNEXION);
		if (!$res3)
			echo 'erreur';
		// libération de la ressource et fermeture de la connexion 
		
		//sybase_close($CONNEXION); 
	}
	
	function produit($CONNEXION){
		global $USERNAME;
		/* select pour récupérer le RCS du fournisseur à partir de la table Users avec $USERNAME= LOGIN */
		/* select pour récupérer le RCS du fournisseur à partir de la table Users avec $USERNAME= LOGIN */
		$queryRCS="SELECT idUser, typeU from vue_users
					WHERE typeU=2
					AND loginU= '$USERNAME' ";
		$res2=sybase_query($queryRCS, $CONNEXION);
		$rcs=sybase_result($res2, 0, 'idUser');
		sybase_free_result($res2);
		
		$query = "SELECT nomProd, quantiteProp, mesure, prixProp, datePeremption FROM Produit, TypeProduit
					WHERE idType=id_TypeProduit
					and dateProp=getdate()
					and RCS_Fournisseur= $rcs ";
		$result = sybase_query($query, $CONNEXION);
		
		echo 	"<table border=1>
				<tr>
					<th>Nom Produit</th>
					<th>Quantite du produit</th>
					<th>Prix du produit</th>
					<th>Mesure du produit</th>
					<th>Date de péremption des produits</th>
				</tr>";
		
		while ($row = sybase_fetch_array($result)) { 
			$nomProd 	= $row["nomProd"];
			$quantite 	= $row["quantiteProp"];
			$mesure 	= $row["mesure"];
			$prix 	= round(($row["prixProp"]),2);
			$prix =  round($prix,2);
			$datePeremption 	= $row["datePeremption"];
			echo "<tr><td>$nomProd</td><td>$quantite</td><td>$prix</td><td>$mesure</td><td>$datePeremption</td></tr>"; 
 		}
 		
 		// libération de la ressource et fermeture de la connexion 
		sybase_free_result($result); 
		//sybase_close($connexion); 
		echo "</table>";
	}
	
	function listProd($CONNEXION){
		$query="SELECT nomProd, mesure FROM TypeProduit";
		$result=sybase_query($query, $CONNEXION);
		while ($row = sybase_fetch_array($result)) { 
			$nomProd = $row["nomProd"];
			$mesure = $row["mesure"];
			echo "<option class='optionReset' value=$nomProd>$nomProd ($mesure)</option>";
		}
		// libération de la ressource et fermeture de la connexion 
		sybase_free_result($result); 
		//sybase_close($connexion); 
		
	}
	
	function ficheClient($CONNEXION){
		global $USERNAME;
		$query = " SELECT nom, prenom, adresse, numTel, loginU from Client, vue_users
				WHERE Client.idClient = vue_users.idUser
				AND loginU = '$USERNAME' ";
				
		$result = sybase_query($query, $CONNEXION);
		
		echo 	"<table border=1>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Adresse</th>
					<th>Numéro de téléphone</th>
					<th>Login</th>
				</tr>";

		// formattage des résultats sous forme de tableau
		while ($row = sybase_fetch_array($result)) { 
			$nom 	= $row["nom"];
			$prenom 	= $row["prenom"];
			$adresse	= $row["adresse"];
			$numTel	= $row["numTel"];
			$login	= $row["loginU"];
			echo "<tr><td>$nom</td><td>$prenom</td><td>$adresse</td><td>$numTel</td><td>$login</td></tr>"; 
 		}
 		// libération de la ressource et fermeture de la connexion 
		
		sybase_free_result($result); 
		//sybase_close($CONNEXION); 
		echo "</table>";
	}
	
	function ficheAMAP($CONNEXION){
		global $USERNAME;
		$query = " select adresseAmap, numTelAmap, loginU from Amap, vue_users
					where Amap.idAmap = vue_users.idUser
					and loginU = '$USERNAME' ";
				
		$result = sybase_query($query, $CONNEXION);
		
		echo 	"<table border=1>
				<tr>
					<th>Adresse</th>
					<th>Numéro de téléphone</th>
					<th>Login</th>
				</tr>";

		// formattage des résultats sous forme de tableau
		while ($row = sybase_fetch_array($result)) { 
			$adresse = $row["adresseAmap"];
			$numTelAmap 	= $row["numTelAmap"];
			$login	= $row["loginU"];
			echo "<tr><td>$adresse</td><td>$numTelAmap</td><td>$login</td></tr>"; 
 		}
 		// libération de la ressource et fermeture de la connexion 
		
		sybase_free_result($result); 
		//sybase_close($CONNEXION); 
		echo "</table>";
	}
	
	function ficheFour($CONNEXION){
		global $USERNAME;
		$query = " select nomF, adresseF, numTelF, ibanF, loginU from Fournisseur, vue_users
					where Fournisseur.RCS = vue_users.idUser
					and loginU = '$USERNAME' ";
				
		$result = sybase_query($query, $CONNEXION);
		
		echo 	"<table border=1>
				<tr>
					<th>Nom</th>
					<th>Adresse</th>
					<th>Numéro de téléphone</th>
					<th>Iban</th>
					<th>Login</th>
				</tr>";

		// formattage des résultats sous forme de tableau
		while ($row = sybase_fetch_array($result)) { 
			$nom 	= $row["nomF"];
			$adresse	= $row["adresseF"];
			$numTel	= $row["numTelF"];
			$iban	= $row["ibanF"];
			$login	= $row["loginU"];
			echo "<tr><td>$nom</td><td>$adresse</td><td>$numTel</td><td>$iban</td><td>$login</td></tr>"; 
 		}
 		// libération de la ressource et fermeture de la connexion 
		
		sybase_free_result($result); 
		//sybase_close($CONNEXION); 
		echo "</table>";
	}


	function solde($CONNEXION){

		$query="SELECT prixPanier*12.0 as prix FROM Trimestre
				WHERE debutTrimestre BETWEEN dateadd(mm, -3, getdate()) AND getdate()";
		$result=sybase_query($query,$CONNEXION);
		$budget=sybase_result($result, 0, 'prix');
		sybase_free_result($result); 
		
		$query="SELECT sum(prixTot) as prixP FROM Panier, Trimestre
				WHERE numTrimestre=num_Trimestre
				AND debutTrimestre between dateadd(mm, -3, getdate()) and getdate()
				GROUP BY numTrimestre";
		$result=sybase_query($query,$CONNEXION);
		$prixP=sybase_result($result, 0, 'prixP');
		
		echo round(($budget-$prixP),2);
		
		sybase_free_result($result); 
		//sybase_close($connexion); 
	}

	function nbPanier($CONNEXION){
		$query="SELECT nbPanierFait FROM Panier
				WHERE datePanier= getdate() ";
		$result=sybase_query($query,$CONNEXION);
		$nbP=sybase_result($result, 0, 'nbPanierFait');
		sybase_free_result($result);
		echo $nbP;

		return $nbP;
		//sybase_close($connexion); 
	}

	function getNbPanier($CONNEXION){
		$query="SELECT nbPanierFait FROM Panier
				WHERE datePanier= getdate() ";
		$result=sybase_query($query,$CONNEXION);
		$nbP=sybase_result($result, 0, 'nbPanierFait');
		sybase_free_result($result);

		return $nbP;
		//sybase_close($connexion); 
	}
	
	function comOcc($CONNEXION, $nbpanier, $jourL){
		global $USERNAME;
		/* select pour récupérer l'id du client à partir de la table Users avec $USERNAME= LOGIN */
		$queryID="SELECT idUser, typeU from vue_users
					WHERE typeU=1
					AND loginU= '$USERNAME' ";
		echo $queryID;
		$res2=sybase_query($queryID, $CONNEXION);
		if (!$res2)
			echo 'erreur';
		$id=sybase_result($res2, 0, 'idUser');
		sybase_free_result($res2);
		
		/* select pour récupérer l'id du panier */
		$queryP = "SELECT idPanier
					FROM vue_panier
					WHERE datePanier between dateadd(dd,-6,getdate()) and getdate() ";
		$result = sybase_query($queryP, $CONNEXION);
		$idP=sybase_result($result, 0, 'idPanier');
		sybase_free_result($result);
		
		
		$query ="insert into passeDemandeOcc values ($nbpanier, '$jourL', 0, $id, $idP)";
		echo $query;
		$res = sybase_query($query, $CONNEXION);
		if (!$res)
			echo 'erreur';
		// libération de la ressource et fermeture de la connexion 
		
		//sybase_close($CONNEXION);
	}
	
	function afficheProp($CONNEXION){
		/*$queryStock="select idType, nomProd, sum(quantiteComRestante) quantite, mesure from ProduitCommande, Produit, TypeProduit
						where ProduitCommande.num_Produit=Produit.numP
						and Produit.id_TypeProduit=TypeProduit.idType
						and quantiteComRestante > 0
						group by idType, nomProd";
		$resultStock=sybase_query($queryStock, $connexion);*/
		$nbPanier = getNbPanier($CONNEXION);

		$queryProd="select distinct(id_TypeProduit), nomProd, mesure from Produit, TypeProduit
					where id_TypeProduit=idType
					and dateProp=getdate()";
		$resultProd=sybase_query($queryProd, $CONNEXION);

		$compteur = 0;
		while ($row = sybase_fetch_array($resultProd)) {
			$idType=$row["id_TypeProduit"];
			$nomType=$row["nomProd"];
			$mesure = $row["mesure"];
			echo "<div id='typeProduit'>
					<br><span id='NomProduit' class='colGauche'>$nomType</span>";
			
			$queryStock="select sum(quantiteComRestante) quantite from ProduitCommande, Produit, TypeProduit
						where ProduitCommande.num_Produit=Produit.numP
						and id_TypeProduit= $idType
						and Produit.id_TypeProduit=TypeProduit.idType
						and quantiteComRestante > 0
						group by idType, nomProd";
			$resultStock=sybase_query($queryStock, $CONNEXION);
			$row = sybase_fetch_array($resultStock);
			$quantite = $row["quantite"];
			
			echo "<div id='stockProp' class='colGauche'> Stock : ";
			if ($quantite > 0)
				echo "<span>$quantite</span>";
			else
				echo "<span>0</span>";	
			echo "<span> $mesure</span></div>";	
			echo "<div class='finLigne'></div>";
			
			$queryList="select numP, nomProd, quantiteProp, mesure, prixProp
						from Produit, TypeProduit
						where dateProp=getdate()
						and id_TypeProduit=$idType
						and id_TypeProduit=idType
						order by prixProp";
			$resultList=sybase_query($queryList, $CONNEXION);
			echo "<span>Proposition(s):</span><br>";
			while ($row = sybase_fetch_array($resultList)) {
				$quantiteProp=$row["quantiteProp"];
				$prixProp=round(($row["prixProp"]),2);
				$mesure=$row["mesure"];
				$numP=$row["numP"];
				$maxRange = $quantiteProp/$nbPanier;
				echo "<div id='choixQuantiteProp'>
						<span>Quantité: $quantiteProp	à $prixProp € ($mesure)</span>
						<div class='finLigne'></div>
						<span class='showRange' id='textInput$compteur'>0</span>
						<input type=range";
				if ($mesure == 'kg'){
					echo " step=0.01"; 
				}	
				echo " min=0 max=$maxRange name=qte id=qte value=0 onchange='updateTextInput(this.value, $compteur);' />
					</div>
					<div class='finLigne'></div>";
				$compteur = $compteur + 1;	
			}
			echo "</div>";
			sybase_free_result($resultList);
			sybase_free_result($resultStock);

		}

		// libération de la ressource et fermeture de la connexion 
		sybase_free_result($resultProd); 
		//sybase_close($connexion);
		
	}

	function affichePropStock($CONNEXION){
		$query = "SELECT idType, nomProd, sum(quantiteComRestante) quantite, mesure from ProduitCommande as pc, Produit, TypeProduit
					where pc.num_Produit=Produit.numP
					and Produit.id_TypeProduit=TypeProduit.idType
					and quantiteComRestante > 0
					group by idType, nomProd";

		$result = sybase_query($query, $CONNEXION);
		
		$compteur = 0;
		// formattage des résultats sous forme de tableau
		while ($row = sybase_fetch_array($result)) { 
			$nomProd 	= $row["nomProd"];
			$quantite 	= $row["quantite"];
			$mesure 	= $row["mesure"];

			$nbPanier = getNbPanier($CONNEXION);
			$maxRange = $quantite/$nbPanier;
			echo "<div id='typeProduit'>
					<br><span id='NomProduit' class='colGauche'>$nomProd</span>
					<div id='choixQuantiteProp'>
						<div class='finLigne'></div>
						<span>Quantité: $quantite ($mesure)</span>
						<div class='finLigne'></div>
						<span class='showRange' id='stockInput$compteur'>0</span>
						<input type=range";
						if ($mesure == 'kg'){
							echo " step=0.01"; 
						}	
						echo " min=0 max=$maxRange name=qte id=qte value=0 onchange='updateStockInput(this.value, $compteur);' />
							</div>
							<div class='finLigne'></div>
						</div>";
						$compteur = $compteur + 1;
 		}
 		// libération de la ressource et fermeture de la connexion 
		
		sybase_free_result($result); 
		//sybase_close($CONNEXION); 			
	}

	function paye($connexion){
		$query="SELECT COUNT(id_Client) as paye FROM passeDemandeOcc, Panier, Trimestre
				WHERE debutTrimestre BETWEEN dateadd(mm, -3, getdate()) AND getdate()
				AND numTrimestre=num_Trimestre
				AND idPanier=id_Panier
				AND payeOcc=1";
		$result=sybase_query($query, $connexion);
		$row = sybase_fetch_array($result);
		$paye = $row["paye"];
		echo "$paye";
		sybase_free_result($result);
	}
	
	function nonpaye($connexion){
		$query="SELECT COUNT(id_Client) as nonpaye FROM passeDemandeOcc, Panier, Trimestre
				WHERE debutTrimestre BETWEEN dateadd(mm, -3, getdate()) AND getdate()
				AND numTrimestre=num_Trimestre
				AND idPanier=id_Panier
				AND payeOcc=0";
		$result=sybase_query($query, $connexion);
		$row = sybase_fetch_array($result);
		$nonpaye = $row["nonpaye"];
		echo "$nonpaye";
		sybase_free_result($result);
	}
	
	function argentGagne($connexion){
		$querypaye="SELECT nbPanierOcc, prixTot FROM passeDemandeOcc, Panier, Trimestre
				WHERE debutTrimestre BETWEEN dateadd(mm, -3, getdate()) AND getdate()
				AND numTrimestre=num_Trimestre
				AND idPanier=id_Panier
				AND payeOcc=1";
		$resultpaye=sybase_query($querypaye, $connexion);
		$gagne=0;
		while ($row = sybase_fetch_array($resultpaye)){
			$prix = $row["prixTot"];
			$nbP = $row["nbPanierOcc"];
			$gagne=$gagne+$prix*$nbP;
		}
		//echo round($gagne,2);
		
		$querynnpaye="SELECT nbPanierOcc, prixTot FROM passeDemandeOcc, Panier, Trimestre
				WHERE debutTrimestre BETWEEN dateadd(mm, -3, getdate()) AND getdate()
				AND numTrimestre=num_Trimestre
				AND idPanier=id_Panier
				AND payeOcc=0";
		$resultnnpaye=sybase_query($querynnpaye, $connexion);
		$perdu=0;
		while ($row = sybase_fetch_array($resultnnpaye)){
			$nnprix = $row["prixTot"];
			$nbPnn = $row["nbPanierOcc"];
			$perdu=$perdu+$nnprix*$nbPnn;
		}
		//echo round($perdu,2);
		
		echo round(($gagne-$perdu),2)." €";
		sybase_free_result($resultpaye);
		sybase_free_result($resultnnpaye);
	}

	function infoClient($connexion){
		global $USERNAME;
		/* select pour récupérer l'id du client à partir de la table Users avec $USERNAME= LOGIN */
		$queryID="SELECT idUser, typeU from vue_users
					WHERE typeU=1
					AND loginU= '$USERNAME' ";
		$res=sybase_query($queryID, $connexion);
		$id=sybase_result($res, 0, 'idUser');
			
		$query="SELECT debutTrimestre, dateadd(mm, 3, debutTrimestre) as dateFin, jourLiv, nbPanierAbo FROM Trimestre, estAbonne, Client
		WHERE debutTrimestre BETWEEN dateadd(mm, -3, getdate()) AND getdate()
		and numTrimestre=num_Trimestre
		and idClient=id_Client
		and idClient=$id ";
		$result=sybase_query($query, $connexion);
		$row=sybase_fetch_array($result); 
		$dateDeb=$row['debutTrimestre'];
		$dateFin = $row['dateFin'];
		$jour=$row['jourLiv'];
		$nb=$row['nbPanierAbo'];
		
		echo "Date de début de l'abonnement : $dateDeb<br>
			Date de fin de l'abonnement : $dateFin<br>
			Jour de livraison : $jour<br>
			Nombre de paniers voulu : $nb<br>";
				
		sybase_free_result($res);
		sybase_free_result($result);
	}
	
	function amapProp($CONNEXION){
		// on effectue le calcul de la quantité à proposer
		$affichage ="";
		
		$queryProd="select distinct(id_TypeProduit), nomProd from Produit, TypeProduit
						where id_TypeProduit=idType
						and dateProp=getdate()";
		$resultProd=sybase_query($queryProd, $CONNEXION);
		while ($row = sybase_fetch_array($resultProd)) {
			$div1fois = 0;
			$idType=$row["id_TypeProduit"];
			$nomType=$row["nomProd"];
			
			// quantité en stock:
			$querystock="select idType, sum(quantiteComRestante) as quantite from ProduitCommande, Produit, TypeProduit
								where ProduitCommande.num_Produit=Produit.numP
								and id_TypeProduit= $idType
								and Produit.id_TypeProduit=TypeProduit.idType
								and quantiteComRestante > 0
								group by idType, nomProd";
			$resultStock=sybase_query($querystock, $CONNEXION);
			$row = sybase_fetch_array($resultStock);
			$quantite = $row["quantite"];
			
			/*quantité moyenne des produits déjà commandés*/
			$querymoy="select TypeProduit.idType, avg(quantiteCom) as moy from ProduitCommande, Produit, TypeProduit
						where ProduitCommande.num_Produit=Produit.numP
						and id_TypeProduit= $idType
						and Produit.id_TypeProduit=TypeProduit.idType
						group by TypeProduit.idType";
			$resultmoy=sybase_query($querymoy, $CONNEXION);
			$row = sybase_fetch_array($resultmoy);
			$moy = $row["moy"];
			
			// on enlève la quantité en sotck à la quantité moyenne habituellement commandée
			$moy=$moy-$quantite;
			
			/* on récupère le nb de paniers à faire pour cette date*/
			$querynbP="select nbPanierFait from Panier
						where datePanier=getdate()";
			$resultnbP=sybase_query($querynbP, $CONNEXION);
			$row = sybase_fetch_array($resultnbP);
			$nb = $row["nbPanierFait"];
			
			$moy=$moy*$nb;
			
			//on récupère les quantités proposées pour ce type de produit auxquelles on soustrait $moy
			$queryList="select numP, nomProd, quantiteProp, mesure, prixProp
							from Produit, TypeProduit
							where dateProp=getdate()
							and id_TypeProduit=$idType
							and id_TypeProduit=idType
							order by prixProp";
			$resultList=sybase_query($queryList, $CONNEXION);
			while ($row = sybase_fetch_array($resultList)) {
				$quantiteProp=$row["quantiteProp"];
				$prixProp=round(($row["prixProp"]),2);
				$numP=$row["numP"];
				$mesure=$row["mesure"];
				$quantiteProp=round(($quantiteProp-$moy),2);
				if ($quantiteProp > 0){
					if (!$div1fois){
						$affichage.= "<div id='typeProduit'><br><span id='NomProduit' class='colGauche'>$nomType</span>";
						$affichage.= "<div class='finLigne'></div>";
						$div1fois = 1;
					}
				$affichage.= "<span>Proposé:</span><br>
						<span>Quantité: $quantiteProp $mesure	pour $prixProp €</span>
						<input type=text name=qte id=qte required/>
						<div class='finLigne'></div>";

				}
			}
			if ($div1fois){
				$affichage.= "</div>";
			}
			$div1fois = 0;
			sybase_free_result($resultList);
			sybase_free_result($resultnbP);
			sybase_free_result($resultmoy);
			sybase_free_result($resultStock);
		}
		echo $affichage;
		sybase_free_result($resultProd);	
		
	}

	/* 
	SELECT quantiteComRestante FROM ProduitCommande, Produit
	WHERE num_Produit=numP
	AND datePeremption<dateadd(dd, 15, getDate())

	select nbPanierAbo from Trimestre, estAbonne
	where Trimestre.numTrimestre=estAbonne.num_Trimestre
	and getdate() BETWEEN debutTrimestre AND dateadd(mm, 3, debutTrimestre)

	select nbPanierOcc from Panier, passeDemandeOcc
	where getdate()=dateadd(dd, -1, datePanier)
	and Panier.idPanier=passeDemandeOcc.id_Panier

	select * from ProduitCommande
	where quantiteComRestante > 0

	select TypeProduit.idType, avg(quantiteCom) from ProduitCommande, Produit, TypeProduit
	where ProduitCommande.num_Produit=Produit.numP
	and Produit.id_TypeProduit=TypeProduit.idType
	group by TypeProduit.idType

	select nbPanierFait from Panier
	where datePanier=getdate()

	select * from Produit, ProduitCommande
	where dateProp=getdate()
	and numP=num_Produit
	group by Produit.id_TypeProduit

	select * from ProduitCommande, TypeProduit
	where numP not in select num_Produit from Produit, ProduitCommande where numP=num_Produit
	and id_TypeProduit=idType
	and mesure='piece'
	*/

?>