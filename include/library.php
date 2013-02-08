<?php
/* Récupérer l'extension d'un fichier */
	function extensionFichier($fich){
		$extension = explode(".",$fich);	
		$extension = array_reverse($extension);
		$extension = $extension[0];
		$extension = strtolower($extension);
		return($extension);
	}

/* Enregistrer les fichiers image */
	function enregistreFichier($categorie, $tmp_name, $real_name, $nompre, $AncienFichier){
		$extension = extensionFichier($real_name);
		if(substr($categorie,-1) == "/"){
			$categorie = substr($categorie, 0, -1);
		}
		if(($extension == "jpg") || ($extension == "jpeg") || ($extension == "png") || ($extension == "gif") || ($extension == "flv") || ($extension == "xml") || ($extension == "mov") || ($extension == "avi") || ($extension == "mpg") || ($extension == "mpeg") || ($extension == "wmv")){
			$savefile = $nompre."_".date("YmdHis").".".$extension; // Nom de fichier horodaté
			//$savefile = normalise_fichier($real_name); // Nom réel du fichier avec normalisation
			if(is_file($categorie."/".$AncienFichier)){
				unlink($categorie."/".$AncienFichier);
			}
			if(is_file($categorie."/".$savefile)){
				unlink($categorie."/".$savefile);
			}
			move_uploaded_file($tmp_name, $categorie."/".$savefile);
			chmod($categorie."/".$savefile,0777);
			$file = $categorie."/".$savefile;
		}else{
			$savefile = "0";
		}
		return($savefile);
	}

/* Enlever les caractères spéciaux d'une chaine */
	function vireAccents($text){
		$text = str_replace("à","a",$text);
		$text = str_replace("á","a",$text);
		$text = str_replace("â","a",$text);
		$text = str_replace("ä","a",$text);
		$text = str_replace("ã","a",$text);
		$text = str_replace("å","a",$text);
		$text = str_replace("ç","c",$text);
		$text = str_replace("è","e",$text);
		$text = str_replace("é","e",$text);
		$text = str_replace("ê","e",$text);
		$text = str_replace("ë","e",$text);
		$text = str_replace("ì","i",$text);
		$text = str_replace("í","i",$text);
		$text = str_replace("î","i",$text);
		$text = str_replace("ï","i",$text);
		$text = str_replace("ñ","n",$text);
		$text = str_replace("ò","o",$text);
		$text = str_replace("ó","o",$text);
		$text = str_replace("ô","o",$text);
		$text = str_replace("ö","o",$text);
		$text = str_replace("õ","o",$text);
		$text = str_replace("ð","o",$text);
		$text = str_replace("ø","o",$text);
		$text = str_replace("š","s",$text);
		$text = str_replace("ù","u",$text);
		$text = str_replace("ú","u",$text);
		$text = str_replace("û","u",$text);
		$text = str_replace("ü","u",$text);
		$text = str_replace("ý","y",$text);
		$text = str_replace("ÿ","y",$text);
		$text = str_replace("ž","z",$text);
		return($text);
	}

/* Normaliser le nom d'un fichier */
	function normalise_fichier($NomComplet){
		$valRetour = str_replace("'","",$NomComplet);
		$valRetour = str_replace(" ","_",$valRetour);
		$valRetour = str_replace("-","_",$valRetour);
		$valRetour = str_replace(",","_",$valRetour);
		$valRetour = str_replace("¦","_",$valRetour);
		$valRetour = str_replace("/","_",$valRetour);
		$valRetour = str_replace("+","_",$valRetour);
		$valRetour = str_replace("=","_",$valRetour);
		$valRetour = str_replace("!","_",$valRetour);
		$valRetour = str_replace("?","_",$valRetour);
		$valRetour = str_replace("œ","oe",$valRetour);
		$valRetour = str_replace("æ","ae",$valRetour);
		$valRetour = mb_convert_encoding($valRetour,"iso-8859-1","UTF-8");
		$valRetour = strtolower($valRetour);
		$valRetour = vireAccents($valRetour);
		return($valRetour);
	}

/* Mettre le mois en toute lettre */
	function MoisEnLettre($mois){
		$moisLettre = "";
		switch($mois){
			case "1": $moisLettre = "janvier"; break;
			case "2": $moisLettre = "f&eacute;vrier"; break;
			case "3": $moisLettre = "mars"; break;
			case "4": $moisLettre = "avril"; break;
			case "5": $moisLettre = "mai"; break;
			case "6": $moisLettre = "juin"; break;
			case "7": $moisLettre = "juillet"; break;
			case "8": $moisLettre = "ao&ucirc;t"; break;
			case "9": $moisLettre = "septembre"; break;
			case "10": $moisLettre = "octobre"; break;
			case "11": $moisLettre = "novembre"; break;
			case "12": $moisLettre = "d&eacute;cembre"; break;
		}
		return($moisLettre);
	}

/* Mettre les premières lettres du mois */
	function MoisEnLettreInit($mois){
		$moisLettre = "";
		switch($mois){
			case "1": $moisLettre = "jan"; break;
			case "2": $moisLettre = "f&eacute;v"; break;
			case "3": $moisLettre = "mars"; break;
			case "4": $moisLettre = "avr"; break;
			case "5": $moisLettre = "mai"; break;
			case "6": $moisLettre = "juin"; break;
			case "7": $moisLettre = "juil"; break;
			case "8": $moisLettre = "ao&ucirc;t"; break;
			case "9": $moisLettre = "sept"; break;
			case "10": $moisLettre = "oct"; break;
			case "11": $moisLettre = "nov"; break;
			case "12": $moisLettre = "d&eacute;c"; break;
		}
		return($moisLettre);
	}

/* Découper une chaine de caractères trop longue */
	function DecoupeTexte($Chaine, $debut, $fin){
		$laChaine = "";
		if(strlen($Chaine) > $fin){ // Découper CHAINE si sa longueur est supérieure à FIN
			$Chaine = substr($Chaine,$debut,$fin); 
			$position_espace = strrpos($Chaine," "); // Trouver l'emplacement du dernier espace dans CHAINE
			$laChaine = substr($Chaine,$debut,$position_espace); // Redécouper au dernier espace
			$laChaine = $laChaine."...";
		}else{
			$laChaine = $Chaine;
		}
		return($laChaine);
	}

/* Supprimer les balises classiques d'une chaine de caractères */
	if(!function_exists("StripHTML")){
		function StripHTML($contenu){
			$contenu = preg_replace("@<[\/\!]*?[^<>]*?>@si","",$contenu);
			$contenu = preg_replace("@<img[\/\!]*?[^<>]*>@si","",$contenu);
			$contenu = preg_replace("@<a[\/\!]*?[^<>]*>@si","",$contenu);
			$contenu = preg_replace("@<obj[\/\!]*?[^<>]*>@si","",$contenu);
			$contenu = preg_replace("@<emb[\/\!]*?[^<>]*>@si","",$contenu);
			$contenu = preg_replace("@<p[\/\!]*?[^<>]*>@si","",$contenu);
			$contenu = preg_replace("@<spa[\/\!]*?[^<>]*>@si","",$contenu);
			$contenu = preg_replace("@<h[\/\!]*?[^<>]*>@si","",$contenu);
			$contenu = preg_replace("@<[\/\!]*?[^<>]*>@si","",$contenu);
			return($contenu);
		}
	}

	/* Supprimer les balises de script d'une chaine de caractères */
	if(!function_exists("EsquiveCSS_SCRIPT")){
		function EsquiveCSS_SCRIPT($chaine){
			$debut = 0;
			$debut = strpos(strtolower($chaine),"<style");
			if($debut !== false){
				$fin = strpos(strtolower($chaine),"</style>");
				if($fin !== false){
					$chaineDebut = substr($chaine,0,$debut);
					$chaineFin = substr($chaine,($fin + 8),strlen($chaine));
					$chaine = $chaineDebut." ".$chaineFin;
				}
			}
			$debut = 0;
			$debut = strpos(strtolower($chaine),"<script");
			if($debut !== false){
				$fin = strpos(strtolower($chaine),"</script>");
				if($fin !== false){
					$chaineDebut = substr($chaine,0,$debut);
					$chaineFin = substr($chaine,($fin + 9),strlen($chaine));
					$chaine = $chaineDebut." ".$chaineFin;
				}
			}
			$debut = 0;
			$debut = strpos(strtolower($chaine),"<?php");
			if($debut !== false){
				$fin = strpos(strtolower($chaine),"?>");
				if($fin !== false){
					$chaineDebut = substr($chaine,0,$debut);
					$chaineFin = substr($chaine,($fin + 2),strlen($chaine));
					$chaine = $chaineDebut." ".$chaineFin;
				}
			}
			return($chaine);
		}
	}

/* Générer un mot de passe automatiquement */
	function GenerePassword($nb_car, $chaine = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789"){
		$nb_lettres = strlen($chaine) - 1;
		$generation = "";
		for($i = 0; $i < $nb_car; $i++){
			$pos = mt_rand(0,$nb_lettres);
			$car = $chaine[$pos];
			$generation = $generation.$car;
		}
		return($generation);
	}

/* Vérifier une adresse mail */
	function VerifierMail($adresse){
		$Syntaxe = "#^([a-zA-Z0-9]+(([\.\-\_]?[a-zA-Z0-9]+)+)?)\@([a-zA-Z0-9]+(([\.\-\_]?[a-zA-Z0-9]+)+)?)\.[a-zA-Z]{2,4}$#";
		if(preg_match($Syntaxe,$adresse)){
			return(true);
		}else{
			return(false);
		}
	}

/* Redimensionner une image */
	function smart_resize_image($file, $width = 0, $height = 0, $proportional = false, $output = "file", $delete_original = true, $use_linux_commands = false){
		if(($height <= 0) && ($width <= 0)){
			return(false);
		}
		$info = getimagesize($file); // Paramètres par défaut de l'image
		$image = "";
		$final_width = 0;
		$final_height = 0;
		list($width_old,$height_old) = $info;
		$trop_petite = false;
		if(($height > 0) && ($height > $height_old)){
			$trop_petite = true;
		}
		if(($width > 0) && ( $width > $width_old)){
			$trop_petite = true;
		}else{
			$trop_petite = false;
		}
		if($trop_petite){
			return(false);
		}
		if($proportional){ // Calculer la proportionnalité
			if($width == 0){
				$factor = $height / $height_old;
			}elseif($height == 0){
				$factor = $width / $width_old;
			}else{
				$factor = min($width / $width_old,$height / $height_old);
			}
			$final_width = round($width_old * $factor);
			$final_height = round($height_old * $factor);
		}else{
			$final_width = ($width <= 0) ? $width_old : $width;
			$final_height = ($height <= 0) ? $height_old : $height;
		}
		switch($info[2]){ // Charger l'image en mémoire en fonction du format
			case IMAGETYPE_GIF:
				$image = imagecreatefromgif($file); break;
			case IMAGETYPE_JPEG:
				$image = imagecreatefromjpeg($file); break;
			case IMAGETYPE_PNG:
				$image = imagecreatefrompng($file); break;
			default:
				return(false);
		}
		$image_resized = imagecreatetruecolor($final_width, $final_height); // Transparence pour les gif et les png
		if(($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)){
			$transparency = imagecolortransparent($image);
			if($transparency >= 0){
				$transparent_color = imagecolorsforindex($image,$trnprt_indx);
				$transparency = imagecolorallocate($image_resized,$trnprt_color["red"],$trnprt_color["green"],$trnprt_color["blue"]);
				imagefill($image_resized,0,0,$transparency);
				imagecolortransparent($image_resized,$transparency);
			}elseif($info[2] == IMAGETYPE_PNG){
				imagealphablending($image_resized,false);
				$color = imagecolorallocatealpha($image_resized,0,0,0,127);
				imagefill($image_resized,0,0,$color);
				imagesavealpha($image_resized,true);
			}
		}
		imagecopyresampled($image_resized,$image,0,0,0,0,$final_width,$final_height,$width_old,$height_old);
		if($delete_original){ // Suppression de l'image d'origine éventuelle
			if($use_linux_commands){
				exec("rm ".$file);
			}else{
				@unlink($file);
			}
		}
		switch(strtolower($output)){
			case "browser": // Envoyer l'image par http avec son type MIME
				$mime = image_type_to_mime_type($info[2]); header("Content-type: $mime"); $output = NULL; break;
			case "file": // Ecraser l'image donnée (cas défaut)
				$output = $file; break;
			case "return": // Retourner les infos de l'image redimensionnée en conservant celles de l'image d'origine
				return($image_resized); break;
			default:
				break;
		}
		switch($info[2]){ // Retourner l'image redimensionnée en fonction de son format
			case IMAGETYPE_GIF:
				imagegif($image_resized,$output); break;
			case IMAGETYPE_JPEG:
				imagejpeg($image_resized,$output); break;
			case IMAGETYPE_PNG:
				imagepng($image_resized,$output); break;
			default:
				return(false);
		}
		return(true);
	}

/* Créer un fichier zip */
	class zipfile{
		var $datasec = array();
		var $ctrl_dir = array();
		var $eof_ctrl_dir = "\x50\x4b\x05\x06\x00\x00\x00\x00";
		var $old_offset = 0;

		function unix2DosTime($unixtime = 0){
			$timearray = ($unixtime == 0) ? getdate() : getdate($unixtime);
			if($timearray['year'] < 1980){
				$timearray['year'] = 1980;
				$timearray['mon'] = 1;
				$timearray['mday'] = 1;
				$timearray['hours'] = 0;
				$timearray['minutes'] = 0;
				$timearray['seconds'] = 0;
			}
			return((($timearray['year'] - 1980) << 25) | ($timearray['mon'] << 21) | ($timearray['mday'] << 16) | ($timearray['hours'] << 11) | ($timearray['minutes'] << 5) | ($timearray['seconds'] >> 1));
		}

/* Ajouter un fichier dans l'archive */
		function addFile($data, $name, $time = 0){
			$name = str_replace('\\','/',$name);
			$dtime = dechex($this -> unix2DosTime($time));
			$hexdtime = '\x'.$dtime[6].$dtime[7].'\x'.$dtime[4].$dtime[5].'\x'.$dtime[2].$dtime[3].'\x'.$dtime[0].$dtime[1];
			eval('$hexdtime = "'.$hexdtime.'";');

			$fr = "\x50\x4b\x03\x04";
			$fr .= "\x14\x00";
			$fr .= "\x00\x00";
			$fr .= "\x08\x00";
			$fr .= $hexdtime;

			$unc_len = strlen($data);
			$crc = crc32($data);
			$zdata = gzcompress($data);
			$zdata = substr(substr($zdata,0,strlen($zdata) - 4),2);
			$c_len = strlen($zdata);

			$fr .= pack('V',$crc);
			$fr .= pack('V',$c_len);
			$fr .= pack('V',$unc_len);
			$fr .= pack('v',strlen($name));
			$fr .= pack('v',0);
			$fr .= $name;
			$fr .= $zdata;
			$this -> datasec[] = $fr;

			$cdrec = "\x50\x4b\x01\x02";
			$cdrec .= "\x00\x00";
			$cdrec .= "\x14\x00";
			$cdrec .= "\x00\x00";
			$cdrec .= "\x08\x00";
			$cdrec .= $hexdtime;
			$cdrec .= pack('V',$crc);
			$cdrec .= pack('V',$c_len);
			$cdrec .= pack('V',$unc_len);
			$cdrec .= pack('v',strlen($name));
			$cdrec .= pack('v',0);
			$cdrec .= pack('v',0);
			$cdrec .= pack('v',0);
			$cdrec .= pack('v',0);
			$cdrec .= pack('V',32);
			$cdrec .= pack('V',$this -> old_offset);
			$this -> old_offset += strlen($fr);
			$cdrec .= $name;
			$this -> ctrl_dir[] = $cdrec;
		}

		function file(){
			$data = implode('',$this -> datasec);
			$ctrldir = implode('',$this -> ctrl_dir);
			return($data.$ctrldir .
				$this -> eof_ctrl_dir .
				pack('v',sizeof($this -> ctrl_dir)) .
				pack('v',sizeof($this -> ctrl_dir)) .
				pack('V',strlen($ctrldir)) .
				pack('V',strlen($data)) .
				"\x00\x00"
			);
		}
	}

	/* Fonction pour la lecture de fichiers XML */
	if(!function_exists('XML_unserialize')){
		function XML_unserialize($xml){
			$xml_parser = new XML();
			$data = $xml_parser->parse($xml);
			$xml_parser->destruct();
			return $data;
		}

		###################################################################################
		class XML{
			var $parser;   #a reference to the XML parser
			var $document; #the entire XML structure built up so far
			var $parent;   #a pointer to the current parent - the parent will be an array
			var $stack;    #a stack of the most recent parent at each nesting level
			var $last_opened_tag; #keeps track of the last tag opened.

			function XML(){
				$this->parser = &xml_parser_create();
				xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, false);
				xml_set_object($this->parser, $this);
				xml_set_element_handler($this->parser, 'open','close');
				xml_set_character_data_handler($this->parser, 'data');
			}

			function destruct(){
				xml_parser_free($this->parser);
			}

			function &parse(&$data){
				$this->document = array();
				$this->stack = array();
				$this->parent = &$this->document;
				return xml_parse($this->parser,$data,true) ? $this->document : NULL;
			}

			function open(&$parser, $tag, $attributes){
				$this->data = ''; #stores temporary cdata
				$this->last_opened_tag = $tag;
				if(is_array($this->parent) and array_key_exists($tag, $this->parent)){ #if you've seen this tag before
					if(is_array($this->parent[$tag]) and array_key_exists(0, $this->parent[$tag])){ #if the keys are numeric
						#this is the third or later instance of $tag we've come across
						$key = count_numeric_items($this->parent[$tag]);
					}else{
						#this is the second instance of $tag that we've seen. shift around
						if(array_key_exists("$tag attr", $this->parent)){
							$arr = array('0 attr' => &$this->parent["$tag attr"], &$this->parent[$tag]);
							unset($this->parent["$tag attr"]);
						}else{
							$arr = array(&$this->parent[$tag]);
						}
						$this->parent[$tag] = &$arr;
						$key = 1;
					}
					$this->parent = &$this->parent[$tag];
				}else{
					$key = $tag;
				}
				if($attributes)
					$this->parent["$key attr"] = $attributes;
				$this->parent = &$this->parent[$key];
				$this->stack[] = &$this->parent;
			}

			function data(&$parser, $data){
				if($this->last_opened_tag != NULL) #you don't need to store whitespace in between tags
					$this->data .= $data;
			}

			function close(&$parser, $tag){
				if($this->last_opened_tag == $tag){
					$this->parent = $this->data;
					$this->last_opened_tag = NULL;
				}
				array_pop($this->stack);
				if($this->stack)
					$this->parent = &$this->stack[count($this->stack)-1];
			}
		}

		function count_numeric_items(&$array){
			return is_array($array) ? count(array_filter(array_keys($array),'is_numeric')) : 0;
		}
	}

	function alert($txt)
	{
	 ?>
	    	<script language=javascript>
			alert('<?php echo addslashes($txt); ?>');
		</script>
	 <?php 
	}
?>