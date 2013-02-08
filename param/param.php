<?php
	// PARAMETRES DU SITE

	$amap  = 'anyEAT';
	$odbc  = 'anyEAT';
	$HOST  = 'amapland';
	$BASE  = 'anyEAT';

	$TYPEUSER[1] = 'Client';
	$TYPEUSER[2] = 'Fournisseur';
	$TYPEUSER[3] = 'AMAP';
	$TYPEUSER[4] = 'Benevole';

	$IDENTIFIANT[1]['login'] = "AE_Client";
	$IDENTIFIANT[1]['mdp'] = "client";

	$IDENTIFIANT[2]['login'] = "AE_Fournisseur";
	$IDENTIFIANT[2]['mdp'] ="fournisseur";

	$IDENTIFIANT[3]['login'] = "AE_AMAP";
	$IDENTIFIANT[3]['mdp'] ="amapae";

	$IDENTIFIANT[4]['login'] = "AE_Benevole";
	$IDENTIFIANT[4]['mdp'] ="benevole";

	
	// a changer en fonction des users après
	$LOGIN = '';
	$MDP   = '';
	$TYPE = 0;
	$CONNEXION = 0;
	$USERNAME = '';
	$IS_LOGGED_IN = 0;
	
	
?>