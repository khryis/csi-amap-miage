<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Rechargement du fichier sans passer par le cache
	//header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	//header("Cache-Control: no-store, no-cache, must-revalidate");
	//header("Cache-Control: post-check=0, pre-check=0",false);
	//header("Pragma: no-cache");
	//session_cache_limiter ('private_no_expire, must-revalidate');
	session_cache_limiter ('private, must-revalidate'); 
	$cache_limiter = session_cache_limiter();
    session_cache_expire(5); // in minutes

	ob_start("ob_gzhandler"); // Activation du tampon de compression gzip
	header("Content-type: text/html; charset=utf-8");
	$cachePeriod = 3600; //délai (sec) avant expiration (= 0 pour l'utilisation de cookie ou de variable session)
	$Expiration = "Expires: ".gmdate("D, d M Y H:i:s",time() + $cachePeriod)." GMT";
	header($Expiration);
	
	require_once("include/library.php");
	require_once("include/dbconnexion.php");
	require_once("param/param.php");
	require_once("include/session.php");
	

	if(strtoupper(substr(PHP_OS,0,3) == "WIN")){ // Retour à la ligne selon l'OS du serveur
		$eol = "\r\n"; // Pour Win World
	}elseif(strtoupper(substr(PHP_OS,0,3) == "MAC")){
		$eol = "\r"; // Pour Mac World
	}else{
		$eol = "\n"; // Pour Unix World
	}

	
?>