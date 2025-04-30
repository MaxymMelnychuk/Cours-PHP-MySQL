<?php


require_once("connexion.php");
//on ce connecte avec BDD

// si trouve pas iduser, il redirige vers le login
if(!isset($_SESSION["iduser"])) {
    header("location:login.php");
}


// je vide ma session
if(isset($_GET["action"]) && $_GET["action"] == "deconnexion") {
    
    unset($_SESSION["iduser"]);
    unset($_SESSION["email"]);
    unset($_SESSION["username"]);
    header("location:login.php"); 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profil.css">
    <title>Document</title>
</head>
<body>
    <div class="profil">
        <a href="index.php">Library</a>
    <?php

        echo "<h1> Salut,  " . $_SESSION["username"] . "</h1>";
    
    ?>
    
    <a href="?action=deconnexion">Se déconnecter</a>
    </div>



</body>
</html>