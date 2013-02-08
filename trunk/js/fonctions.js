/**BOITE A OUTILS**/
/* Trouver un objet Html selon son ID */
function GetId(myId){
	return(document.getElementById(myId));
}

/* Trouver un tableau d'objets Html selon leur Name */
function GetName(myName){
	return(document.getElementsByName(myName));
}

/* Trouver un navigateur selon son nom */
function GetBrowser(){
	return(navigator.appName + " " + navigator.appVersion);
}

/* Trouver la version d'Internet Explorer */
function GetVersionIe(){
	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if(msie > 0) // Pour Internet Explorer
		return(parseInt(ua.substring(msie + 5,ua.indexOf(".",msie))));
	else // Pour les autres navigateurs
		return(0);
}

/* Trouver un objet Flash selon son ID */
function GetMovieName(movieName){
	if(GetVersionIe > 0)
		return(window[movieName]);
	else
		return(document[movieName]);
}

/* Trouver un objet Ajax */
function GetXHR(){
	var objXHR = null;

	if(window.XMLHttpRequest) // Pour les autres navigateurs
		objXHR = new XMLHttpRequest();
	else if(window.ActiveXObject){ // Pour Internet Explorer
		try{ // Pour IE6+
			objXHR = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){ // Pour IE5.5
			objXHR = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}else{ // Composant XMLHttpRequest non supporté
		alert("Votre navigateur ne gère pas le composant XmlHttpRequest.");
		objXHR = false;
	}
	return(objXHR);
}

/* Trouver le dossier d'une Url */
function GetUrlFic(dossier){
	var strUrl = window.location.href;

	if(strUrl.search(dossier) != -1)
		return(true);
	else
		return(false);
}

/* Changer la classe CSS d'un objet Html */
function CssChanger(action, object, className){
	if(action == "add"){ // Ajouter une classe
		if(!CssChanger("check",object,className))
			object.className += object.className ? " " + className : className;
	}else if(action == "remove"){ // Supprimer la classe
		var rep = object.className.match(" " + className) ? " " + className : className;

		object.className = object.className.replace(rep,"");
	}else if(action == "check") // Vérifier l'existence de la classe
		return(new RegExp("\\b" + className + "\\b").test(object.className));
	return(true);
}

/* Supprimer le noeud vide d'un arbre Xml */
function XmlSupprimer(arbre){
	if(!arbre.data.replace(/\s/g,""))
		arbre.parentNode.removeChild(arbre);
}

/* Nettoyer l'arbre Xml de ses noeuds superflus */
function XmlNettoyer(noeud){
	var balise = noeud.getElementsByTagName("*"); // Récupérer la balise Html liée

	for(i = 0; i < balise.length; i++){
		noeudPrec = balise[i].previousSibling; // Positionnement sur la balise précédente
		if((noeudPrec) && (noeudPrec.nodeType == 3)) // Supprimer le noeud s'il est vide
			XmlSupprimer(noeudPrec);
		noeudSuiv = balise[i].nextSibling; // Positionnement sur la balise suivante
		if((noeudSuiv) && (noeudSuiv.nodeType == 3))
			XmlSupprimer(noeudSuiv);
	}
	return(noeud);
}

/* Récupérer le contenu d'un fichier Xml */
function XmlLire(fichier){
	var urlFic = ""
	var objRequest = GetXHR();

	if(fichier.indexOf("?",0) != -1) // Ignorer le cache lors du chargement
		urlFic = fichier + "&nocache=" + Math.random();
	else
		urlFic = fichier + "?nocache=" + Math.random();
	objRequest.open("GET",urlFic,false); // Requête GET asynchrone
	objRequest.send(null); // Exécution de requête sans retour de données
	return(objRequest.responseXML);
}

/* Récupérer le contenu d'un fichier chargé en Ajax */
function AjaxLire(fichier, zoneCible){
	var urlFic = "";
	var objRequest = GetXHR();

	objRequest.onreadystatechange = function(){
		if(objRequest.readyState == 4){ // Transfert de données terminé
			if(GetId(zoneCible)){
				if(objRequest.status == 200) // Succès de la requête
					GetId(zoneCible).innerHTML = objRequest.responseText;
				else
					GetId(zoneCible).innerHTML = "ERREUR " + objRequest.status + ": " + objRequest.statusText;
			}
		}
	}
	if(fichier.indexOf("?",0) != -1) // Ignorer le cache lors du chargement
		urlFic = fichier + "&nocache=" + Math.random();
	else
		urlFic = fichier + "?nocache=" + Math.random();
	objRequest.open("GET",urlFic,true); // Requête GET asynchrone
	objRequest.send(null); // Exécution de requête sans retour de données
}

/* Supprimer les balises de script */
function ScriptCleaner(strHtml){
	return(strHtml.replace(/<\/?[^>]+>/gi,""));
}

/* Exécuter les scripts d'un fichier chargé en Ajax */
function ScriptExecuter(position){
	var All = GetId(position).getElementsByTagName("*");

	for(i = 0; i < All.length; i++){ // Récupérer les scripts
		All[i].id = All[i].getAttribute("id");
		All[i].name = All[i].getAttribute("name");
		if(GetVersionIe() == 0)
			All[i].className = All[i].getAttribute("class");
	}
	var AllScripts = GetId(position).getElementsByTagName("script");

	for(i = 0; i < AllScripts.length; i++){
		if((AllScripts[i].src) && (AllScripts[i].src != "")) // Interpréter les scripts en mode synchrone
			eval(getFileContent(AllScripts[i].src));
		else
			eval(AllScripts[i].innerHTML);
	}
}

/* Ouvrir l'aperçu avant impression */
function PrintOuvrir(){
	window.print();
}

/**GESTION DES PAGES**/
/* Afficher le bloc selon l'état d'un item */
function BlocMontrer(itemSelect, objCible){
	var itemStatus = false;

	if(itemSelect.type == "checkbox") // Récupérer le statut de l'item selon sa nature
		itemStatus = itemSelect.checked;
	else if(itemSelect.type == "radio"){
		if(GetName(itemSelect.name)[0].checked != GetName(itemSelect.name)[1].checked){
			if(GetName(itemSelect.name)[1].checked == true)
				itemStatus = true;
		}
	}
	if(itemStatus == true){ // Afficher le bloc
		if(GetVersionIe() > 0)
			CssChanger("remove",GetId(objCible),"navAccessiWeb");
		else
			GetId(objCible).removeAttribute("class");
	}else // Cacher le bloc
		CssChanger("add",GetId(objCible),"navAccessiWeb");
	MenuCaler(); // Recaler le menu de gauche
}

/* Caler le menu de gauche */
function MenuCaler(){
	var MenuBox = $("#CadrePage").find("#Contenu").find("#MenuGauche").find(".menuBox");
	var logo = $("#CadrePage").find("#Contenu").find("#MenuGauche").find("img").innerHeight();
	var entete = $("#CadrePage").find("#Entete").innerHeight();
	var cadrepage = $("#CadrePage").innerHeight();
	var result = cadrepage - (entete + logo);

	MenuBox.height(result);
}

/* Initialiser jQuery */
$(document).ready(
	function(){
		MenuCaler();
	}
);