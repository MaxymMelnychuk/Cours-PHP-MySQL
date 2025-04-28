<?php 
require_once("connexion.php");

///// EXEC







// Création d'un livre
if ($_POST && isset($_POST["create"])) {
    $name = $_POST["name"];
    $atk = $_POST["atk"];
    $def = $_POST["def"];
    $description = $_POST["description"];

    try {
        $stmt = $pdo->prepare("INSERT INTO cards (name, atk, def, description) 
        VALUES( :name, :atk, :def, :description)");

        $stmt->execute([
            "name" => $name,
            "atk" => $atk,
            "def" => $def,
            "description" => $description
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Suppression d'un livre
if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $idcard = $_GET['idcard'];

    try {
        $stmt = $pdo->prepare("DELETE FROM cards WHERE idcard = :idcard");
        $stmt->execute(["idcard" => $idcard]);
        echo "Le pokemon a bien été supprimé !";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Modification d'un livre (lorsqu'on clique sur "Modifier")
if (isset($_GET['action']) && $_GET['action'] == 'modify' && isset($_GET['idcard'])) {
    $idcard = $_GET['idcard'];
    // Récupérer les informations du livre à modifier
    $stmt = $pdo->prepare("SELECT * FROM cards WHERE idcard = :idcard");
    $stmt->execute(["idcard" => $idcard]);
    $pokemonToModify = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mise à jour du livre modifié
if ($_POST && isset($_POST["update"])) {
    $idcard = $_POST["idcard"];
    $name = $_POST["name"];
    $atk = $_POST["atk"];
    $def = $_POST["def"];
    $description = $_POST["description"];

    try {
        $stmt = $pdo->prepare("UPDATE cards SET name = :name, atk = :atk, def = :def, description = :description WHERE idcard = :idcard");
        $stmt->execute([
            "idcard" => $idcard,
            "name" => $name,
            "atk" => $atk,
            "def" => $def,
            "description" => $description,
        ]);
        // Afficher un message pour confirmer la mise à jour
        echo '<p class="margin">Le pokemon a bien été modifié !</p>';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}




// Trier les livres
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'name':
            $stmt = $pdo->query("SELECT * FROM cards ORDER BY name ASC");
            break;
        case 'atk':
            $stmt = $pdo->query("SELECT * FROM cards ORDER BY atk DESC");
            break;
        case 'def':
            $stmt = $pdo->query("SELECT * FROM cards ORDER BY def DESC");
            break;
        case 'default':
            $stmt = $pdo->query("SELECT * FROM cards");
            break;
        case 'echo':
            $stmt = $pdo->query("SELECT * FROM cards");
            break;
        default:
            $stmt = $pdo->query("SELECT * FROM cards");
            break;
    }
} else {
    $stmt = $pdo->query("SELECT * FROM cards");
}

$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
<div class="flex">
<a href="../exercices/index.php">Livres</a>
<a href="../exercices/inscription.php">S'inscrire</a>
</div>

<?php

?>

<table border="1">
    <thead>
        <th>Name</th>
        <th>ATK</th>
        <th>DEF</th>
        <th>Description</th>
        <th>Supprimer</th>
        <th>Modifier</th>
    </thead>
    <tbody>
        <?php
        foreach ($cards as $card) {
            echo "<tr>";
            echo "<td>" . $card["name"] . "</td>";
            echo "<td>" . $card["atk"] . "</td>";
            echo "<td>" . $card["def"] . "</td>";
            echo "<td>" . $card["description"] . "</td>";
            echo "<td><a href='?idcard=" . $card["idcard"] . "&action=delete'>Supprimer</a></td>";
            echo "<td><a href='?idcard=" . $card["idcard"] . "&action=modify'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Formulaire de création -->
<br><br>
<form class="form" method="POST">

<h2>Crée un pokemon</h2>

    <div class="create">
    
        <div class="write">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="name">
        </div>
        
        <div class="write">
            <label for="atk">ATK:</label>
            <input type="number" name="atk" id="atk" placeholder="atk">
        </div>

        <div class="write">
            <label for="def">DEF:</label>
            <input type="number" name="def" id="def" placeholder="def">  
        </div>

        <div class="write">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" placeholder="description">
        </div>
        
        <a class="validation">Enregister</a>
        <div class="hidden ">
            <div class="confirm">Valider modifications ?
            <div class="buttons">
                <input class="green"  type="submit" name="create" value="Oui">
                <button class="red validation">Non</button>
            </div>
        </div>
        
</div>
       
    </div>
    
    <div class="trier">
        <a class="tri" href="?action=name">Trier par name</a> |
        <a class="tri" href="?action=atk">Trier par atk</a> |
        <a class="tri" href="?action=def">Trier par def</a> |
        <a class="tri" href="?action=default">Par défaut</a>
    </div>


</form>




<!-- Formulaire de modification si on est en mode "modify" -->
<?php if (isset($pokemonToModify)): ?>
    <h2>Modifier un pokemon</h2>
    <form class="form1 " method="POST">
        <input  type="hidden" name="idcard" value="<?php echo $pokemonToModify['idcard']; ?>">

        <div class="write">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $pokemonToModify['name']; ?>" placeholder="Name">
        </div>

        <div class="write">
            <label for="atk">ATK:</label>
            <input type="number" name="atk" id="atk" value="<?php echo $pokemonToModify['atk']; ?>" placeholder="ATK">
        </div>

        <div class="write">
            <label for="def">DEF:</label>
            <input type="number" name="def" id="def" value="<?php echo $pokemonToModify['def']; ?>" placeholder="DEF">
        </div>

        <div class="write">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" value="<?php echo $pokemonToModify['description']; ?>" placeholder="Description">
        </div>

        <a class="validation2">Enregister</a>
        <div class="hidden2 ">
            <div class="confirm">Valider modifications ?
            <div class="buttons">
            <input class="green" type="submit" name="update" value="Oui">
                <button class="red validation2">Non</button>
            </div>
        </div>
        
       
    </form>
<?php endif; ?>



<script src="script.js">
    

</script>

</body>
</html>
