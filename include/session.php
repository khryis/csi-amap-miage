<?php 

session_start();

/*
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
        }elseif($USERNAME != 'anyEAT'){
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
*/

/*
print_r($_POST);
echo '<br/>';
print_r($_SESSION);
echo '<br/>';
print_r($_COOKIE);
echo '<br/>';
*/

/*
$nettoyer = false;
if (isset($_POST['deconnexion'])){
    $nettoyer = true;
}elseif (!isset($_SESSION['is_logged_in'])) {
    $nettoyer = true;
}elseif(isset($_SESSION['is_logged_in'])){
    if ($_SESSION['is_logged_in']!=1) {
        $nettoyer = true;
    }
}
if(isset($_GET['logout'])){
    if ($_GET['logout'] == 'true') {
        $nettoyer =true;
    }
}  

if ($nettoyer){
    //unset($_SESSION['username']);
    //unset($_SESSION['login']);
    //unset($_SESSION['typeuser']);
    $_SESSION = array();
    session_destroy();
    //setcookie('PHPSESSID');
    session_start();
    //session_regenerate_id(true);
} */

//print_r($_POST);
//echo '<br/>';
//print_r($_SESSION);
//echo '<br/>';
//print_r($_COOKIE);
//echo '<br/>';

/*
if(isset($_GET['logout'])){
    if($_GET['logout']=='true'){
        header('location:auth/logout.php');
    }
}*/


if (isset($_SESSION['login'])) $LOGIN = $_SESSION['login'];
if (isset($_SESSION['mdp'])) $MDP = $_SESSION['mdp'];
if (isset($_SESSION['connexion'])) $CONNEXION = $_SESSION['connexion'];
if (isset($_SESSION['typeuser'])) $TYPE = $_SESSION['typeuser'];
if (isset($_SESSION['username'])) $USERNAME = $_SESSION['username'];
if (isset($_SESSION['is_logged_in'])) $IS_LOGGED_IN =  $_SESSION['is_logged_in'];

if ($LOGIN and $MDP)
    $CONNEXION = connexion($LOGIN,$MDP);

/*
echo 'login : '.$LOGIN.'<br/>';
echo 'connexion : '.$CONNEXION.'<br/>';
echo 'type : '.$TYPE.'</br/>';
echo 'username : '.$USERNAME.'<br/>';
*/


?>