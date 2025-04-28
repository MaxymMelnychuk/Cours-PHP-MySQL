<?php

///// PROFILE.PHP
require_once("connexion.php");


if(!isset($_SESSION["iduser"])) {
    header("location:login.php");
}

// Déconnexion
if (isset($_GET["action"]) && $_GET["action"] == "deconnexion") {
    session_unset();
    session_destroy();
    header("location:login.php");
    exit;
}



if(isset($_GET["action"]) && $_GET["action"] == "deconnexion") {
    // je vide ma session
    unset($_SESSION["iduser"]);
    unset($_SESSION["email"]);
    unset($_SESSION["username"]);
    header("location:login.php"); // redirection sans paramètre
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