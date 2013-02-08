<?php
  session_start();
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
}*/
  sybase_close($CONNEXION);

  session_destroy();

  header("location:../index.php");
?>