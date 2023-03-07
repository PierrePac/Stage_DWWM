<?php

//Création des variables
    //variable Localhost
define ("SERVEUR", "localhost");
define ("USER","root");
define ("MDP","");
define ("BD", "ambulancesrdv") ;

   function connectBd(){
    try {
        $db = new PDO('mysql:host='.SERVEUR.';dbname='.BD,USER,MDP);
        $db->exec("SET CHARACTER SET utf8");
    }
    catch (Exception $e)
    {
        $db ='Erreur : ' .$e->getMessage().'<br />';
        $db = 'N° : ' .$e->getCode() ;
    }
    return $db;
    }
   

    function disconnectSession(){
        if(isset($_SESSION['societe_nom'])){
            $dataSocNom = str_replace(" ","",$_SESSION['societe_nom']);
            $_SESSION = array();
            session_destroy();
            header('location:../../'.$dataSocNom.'/index.php');
        } else{
            $_SESSION = array();
            session_destroy();
            header('location:../index.php');
        }
    }

?>