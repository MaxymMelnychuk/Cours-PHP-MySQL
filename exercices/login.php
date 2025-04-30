<?php
require_once("connexion.php");




// quand on va clicker sur login, il va chercher si user existe dans la base donéee
if ($_POST) {
    // Récupération et nettoyage des données du formulaire
    $email = $_POST["email"];
    $password = trim($_POST["password"]);

    if ($email && $password) {
        // Recherche de l'utilisateur dans la base de données
        $stmt = $pdo->query("SELECT * FROM user WHERE email = '$email' ");
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe avec password_verify
        if ($user && password_verify($password, $user["password"])) {
            // Création de la session utilisateur
            $_SESSION["iduser"] = $user["iduser"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["username"] = $user["username"];
            header("location:profil.php");
        } else {
            echo "La connexion a échoué !";
        }

        // Redirection si l'utilisateur est déjà connecté
        if(isset($_SESSION["iduser"])) {
            header("location:profil.php");
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>

<body>


<a href="index.php">Library</a>
    <h1>Login</h1>
   
    <?php if (!isset($_SESSION["iduser"])) { ?>
        <form  method="POST">

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password :</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
        <div class="register_form">
            <p>Don't have an account ?</p>
            <a href="inscription.php">Sign up</a>
            
        </div>

        </form>

    <?php } ?>

</body>

</html>
