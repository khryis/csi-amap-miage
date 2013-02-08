<?php

session_start();

require_once("../include/library.php");
require_once("../include/dbconnexion.php");
require_once("../param/param.php"); 

if(($_SERVER['REQUEST_METHOD'] == "POST")and(isset($_POST['connexion']))) {
    if ((isset($_POST['username']))and(isset($_POST['password']))and(!empty($_POST['username']))and(!empty($_POST['password']))){
        
        $USERNAME = $_POST['username'];
        $password = $_POST['password'];

        //On se connecte en tant que anyEAT car on veut recupérer un user dans la base alors que personne n'est connecté ---> à voir visiteur
        $LOGIN = 'anyEAT';
        $MDP = 'anygonz';
        $CONNEXION = connexion($LOGIN,$MDP);
        
        // On recupère les informations du user dans le cas ou on ne se connecte pas en tant que anyEAT
        echo '1<br/>';
        if ($USERNAME != 'anyEAT') {
            echo '2<br/>';
            $TYPE = getUser($CONNEXION, $USERNAME, $password);
            if (($TYPE == 1)OR($TYPE ==2 )OR($TYPE == 3)OR($TYPE == 4)){
                echo '3<br/>';
                $_SESSION['typeuser'] = $TYPE;

                sybase_close($CONNEXION);
                $LOGIN = $IDENTIFIANT[$TYPE]['login'];
                $MDP = $IDENTIFIANT[$TYPE]['mdp'];

                $CONNEXION = connexion($LOGIN, $MDP);

                $_SESSION['login'] = $LOGIN;
                $_SESSION['mdp'] = $MDP;
                $_SESSION['connexion'] = $CONNEXION;
                $_SESSION['typeuser'] = $TYPE;
                $_SESSION['username'] =  $USERNAME;
            }else{
                echo '3bis<br/>';
                $CONNEXION = 0;
                //header('location:index.php');
                //exit();
            } 
        }elseif($USERNAME == 'anyEAT'){
            echo '4<br/>';
            $_SESSION['login'] = $LOGIN;
            $_SESSION['mdp'] = $MDP;
            $_SESSION['connexion'] = $CONNEXION;
            $_SESSION['typeuser'] = $TYPE;
            $_SESSION['username'] =  $USERNAME;
        }
        

        if($CONNEXION){
            $_SESSION['is_logged_in'] = 1;
        }else{
            $_SESSION['is_logged_in'] = 0;
        }
    }else{

    }
}
	

if(!isset($_SESSION['is_logged_in'])) {
  header("location:logout.php");
} else {
  header("location:../index.php");
}
  
?>