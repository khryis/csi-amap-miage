<?php

	function panier($connexion){
		$query = "SELECT tp.nomProd, u.quantiteProd, tp.mesure 
					FROM Panier as p, ProduitCommande as pc, Utilise as u, Produit as pr, TypeProduit tp
					WHERE datePanier between dateadd(dd,-6,getdate()) and getdate()
					AND p.idPanier = u.id_Panier
					AND pc.idProdCom = u.id_ProduitCommande
					AND pr.numP = pc.num_Produit
					AND pr.id_TypeProduit = tp.idType";
		$result = sybase_query($query, $connexion);
		
		echo 	"<table border=1>
				<tr>
					<th>Nom Produit</th>
					<th>Quantite du produit</th>
					<th>Mesure du Produit</th>
				</tr>";

		// formatage des résultats sous forme de tableau
		while ($row = sybase_fetch_array($result)) { 
			$nomProd 	= $row["nomProd"];
			$quantiteProd 	= $row["quantiteProd"];
			$mesure 	= $row["mesure"];
			echo "<tr><td>$nomProd</td><td>$quantiteProd</td><td>$mesure</td></tr>"; 
 		}
 		// libération de la ressource et fermeture de la connexion 
		

		sybase_free_result($result); 
		sybase_close($connexion); 
		echo "</table>";

		//return $result;
	}
	
	function solde($connexion){

		$query="SELECT prixPanier*12.0 as prix FROM Trimestre
				WHERE debutTrimestre BETWEEN dateadd(mm, -3, getdate()) AND getdate()";
		$result=sybase_query($query,$connexion);
		$budget=sybase_result($result, 0, 'prix');
		sybase_free_result($result); 
		
		$query=SELECT sum(prixTot) as prixP FROM Panier, Trimestre
				WHERE numTrimestre=num_Trimestre
				AND debutTrimestre between dateadd(mm, -3, getdate()) and getdate()
				GROUP BY numTrimestre";
		$result=ybase_query($query,$connexion);
		$prixP=sybase_result($result, 0, 'prixP');
		
		echo $budget-$prixP;
		
		sybase_free_result($result); 
		sybase_close($connexion); 
	}

	/*function affTabResultat($resultQuery, $attr1, $attr2){
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

	function argumentFonction()
	{
	    $numargs = func_num_args();
	    echo "Nombre d'arguments : $numargs<br />\n";
	    if ($numargs >= 2) {
	        echo "Le second argument est : " . func_get_arg(1) . "<br />\n";
	    }
	    $arg_list = func_get_args();
	    for ($i = 0; $i < $numargs; $i++) {
	        echo "L'argument $i est : " . $arg_list[$i] . "<br />\n";
	    }
	}*/


	function stock($CONNEXION){
		$query = "SELECT idType, nomProd, sum(quantiteComRestante) quantite, 			mesure from ProduitCommande, Produit, TypeProduit
					where ProduitCommande.num_Produit=Produit.numP
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
		sybase_close($CONNEXION); 
		echo "</table>";			
	}

	function proposition($CONNEXION, $PRODUIT, $QTE, $PRIX, $DATE){
		/* 	$USERNAME= LOGIN
		*	$TYPE */

		/* select pour id du produit à partir du nom! */
		$queryID="SELECT idType FROM TypeProduit
					WHERE nomProd=".$PRODUIT.";"
		$result=sybase_query($queryID, $CONNEXION);
		$idProd=sybase_result($result);
	
		/* select pour récupérer le RCS du fournisseur à partir de la table Users avec $USERNAME= LOGIN */
		$queryRCS="SELECT idU from Users
					WHERE typeU=2
					AND loginU=".$USERNAME";"
		$result=sybase_query($queryRCS, $CONNEXION);
		$RCS=SYBASE_RESULT($result);
		
	
		$query = "INSERT INTO Produit VALUES (getdate(), ".$qte.", ".$prix.", ".$date.", ".$RCS.", null, ".$idProd.";
		$result = sybase_query($query, $CONNEXION);

	}
	
	function produit($connexion){
		/* select pour récupérer le RCS du fournisseur à partir de la table Users avec $USERNAME= LOGIN */
		/* select pour récupérer le RCS du fournisseur à partir de la table Users avec $USERNAME= LOGIN */
		$queryRCS="SELECT idUser, typeU from Users
					WHERE typeU=2
					AND loginU= '$USERNAME' ";
		$res2=sybase_query($queryRCS, $CONNEXION);
		$rcs=sybase_result($res2, 0, 'idUser');
		sybase_free_result($res2);
		
		$query = "SELECT nomProd, quantiteProp, mesure, prixProp, datePeremption FROM Produit, TypeProduit
					WHERE id_Type=idTypeProduit
					and dateProp=getdate()
					and RCS_Fournisseur= $rcs ";
		$result = sybase_query($query, $connexion);
		
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
			$prix 	= $row["prixProp"];
			$datePeremption 	= $row["datePeremption"];
			echo "<tr><td>$nomProd</td><td>$quantite</td><td>$prix</td><td>$mesure</td><td>$datePeremption</td></tr>"; 
 		}
 		
 		// libération de la ressource et fermeture de la connexion 
		sybase_free_result($result); 
		sybase_close($connexion); 
		echo "</table>";
	}
	
	function listProd($connexion){
		$query="SELECT nomProd FROM TypeProduit";
		$result=sybase_query($query, $connexion);
		while ($row = sybase_fetch_array($result)) { 
			$nomProd = $row["nomProd"];
			echo "<li>$nomProd</li>"
		}
		// libération de la ressource et fermeture de la connexion 
		sybase_free_result($result); 
		sybase_close($connexion); 
		
	}	
	
	function afficheProp($connexion){
		/*$queryStock="select idType, nomProd, sum(quantiteComRestante) quantite, mesure from ProduitCommande, Produit, TypeProduit
						where ProduitCommande.num_Produit=Produit.numP
						and Produit.id_TypeProduit=TypeProduit.idType
						and quantiteComRestante > 0
						group by idType, nomProd";
		$resultStock=sybase_query($queryStock, $connexion);*/
		
		$queryProd="select id_TypeProduit, nomProd, mesure from Produit, TypeProduit
					where id_TypeProduit=idType
					and dateProp=getdate()";
		$resultProd=sybase_query($queryProd, $connexion);
		while ($row = sybase_fetch_array($resultProd)) {
			$idType=$row["id_TypeProduit"];
			$nomType=$row["nomProd"];
			$mesure = $row["mesure"];
			echo "<br><label>$nomType</label>";
			
			$queryStock="select sum(quantiteComRestante) quantite from ProduitCommande, Produit, TypeProduit
						where ProduitCommande.num_Produit=Produit.numP
						and id_TypeProduit= $idType
						and Produit.id_TypeProduit=TypeProduit.idType
						and quantiteComRestante > 0
						group by idType, nomProd";
			$resultStock=sybase_query($queryStock, $connexion);
			$row = sybase_fetch_array($resultStock);
			$quantite = $row["quantite"];
			echo "<label>	$quantite </label>";
			
			echo "<label> $mesure</label><br>";
			
			$queryList="select numP, nomProd, quantiteProp, mesure, prixProp
						from Produit, TypeProduit
						where dateProp=getdate()
						and id_TypeProduit=$idType
						and id_TypeProduit=idType
						order by prixProp";
			$resultList=sybase_query($queryList, $connexion);
			while ($row = sybase_fetch_array($resultList)) {
				$quantiteProp=$row["quantiteProp"];
				$prixProp=$row["prixProp"];
				$numP=$row["numP"];
				echo "<label>Proposé:</label><br>
						<label>Quantité: $quantiteProp	pour $prixProp €</label>
						<input type="checkbox"  value=$numP/><input type="text" name="qte" id="qte" required/><br> <br>";
			}

		}
		
		// libération de la ressource et fermeture de la connexion 
		sybase_free_result($resultProd);
		sybase_free_result($resultStock);
		sybase_free_result($resultList); 
		sybase_close($connexion);
		
	}
	
	function comOcc($CONNEXION, $nbpanier, $jourL){
		global $USERNAME;
		/* select pour récupérer l'id du client à partir de la table Users avec $USERNAME= LOGIN */
		$queryID="SELECT idUser, typeU from Users
					WHERE typeU=1
					AND loginU= '$USERNAME' ";
		$res2=sybase_query($queryID, $CONNEXION);
		$id=sybase_result($res2, 0, 'idUser');
		sybase_free_result($res2);
		
		/* select pour récupérer l'id du panier */
		$queryP = "SELECT idPanier
					FROM Panier
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
		
		sybase_close($CONNEXION);
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