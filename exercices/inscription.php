<?php

require_once("connexion.php");


// Validation du nom d'utilisateur
function username($username) {
    // Vérifie si le nom d'utilisateur contient au moins 4 caractères
    if (strlen($username) > 4) {
        // echo '<p style="color: green;">Username good</p>';
        return true;
    } else {
        echo '<p style="color: red;">Username doit contenir au moins 4 caractere</p>';
        return false;
    }
}

// Validation du mot de passe
function logIn($password, $passwordRepeat) {
    // Vérifie si le mot de passe respecte les critères de sécurité
    if (strlen($password) > 8 && preg_match('/[a-zA-Z0-9!@#$%^&*()_+={}\[\]:;,.<>?]/', $password)) {
        // Vérifie si les deux mots de passe correspondent
        if ($password == $passwordRepeat) {
            // echo '<p style="color: green;">Mot de passe correct</p>';
            return true;
        }
        else {
            echo '<p style="color: red;">Les mot de passes ne rassemblent pas</p>';
            return false;
        }
    } else {
        echo '<p style="color: red;">Mot de passe doit contenir au moins 8 caracteres, 1 minuscule, majuscule, et caractere special</p>';
        return false;
    }
}

// Validation finale et inscription
function accepting($username, $password, $passwordRepeat, $pdo) {
    // Vérification des validations
    $isUsernameValid = username($username);        
    $isPasswordValid = logIn($password, $passwordRepeat); 
    
    if ($isUsernameValid && $isPasswordValid) {
        echo '<p style="color: green;">Formulaire envoyée</p>';

        if($_POST){
            // Récupération des données du formulaire
            $email = $_POST["email"];
            $password = $_POST["password"];
            $username = $_POST["username"];
        
            // Préparation et exécution de la requête d'insertion
            $sql = "INSERT INTO user (email, password, username) VALUES(:email, :password, :username)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'username' => $username
            ]);
        
            echo "Votre user a été cocrrectement inséré en BDD";
        }
    } else {
        // echo '<p style="color: red;">NOOOO</p>';
        return false;
    }
}






if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Récupère et convertit les valeurs du formulaire
    $username = $_POST["username"];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
   
 
    $accept = accepting($username, $password, $passwordRepeat, $pdo);
    
   
   
    
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Login</title>
</head>
<body>
<a href="index.php">Library</a>
<h2>Sign up</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div>
            <label for="username">Username :</label><br>
            <input type="text" id="username" name="username" required><br><br>
        </div>

        <div>
            <label for="password">Password :</label><br>
            <input type="password" id="password" name="password" required><br><br>
        </div>

        <div>
            <label for="passwordRepeat">Password repeat :</label><br>
            <input type="passwordRepeat" id="passwordRepeat" name="passwordRepeat" required><br><br>
        </div>

        <div>
            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email" required><br><br>
        </div>
        <!-- au click, s'execute la fonction accepting -->
        <button onclick="accepting()" type="submit">Sign up</button>

        <div class="register_form">
            <p>Already have account ?</p>
            <a href="login.php">Login</a>
            <p><?php ; ?>
            <?php ; ?></p>
        </div>
        
    </form>


        
        
        </script>
</body>
</html>