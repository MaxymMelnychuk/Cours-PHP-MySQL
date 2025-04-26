<?php 
require_once("connexion.php");

///// EXEC

// Création d'un livre
if ($_POST && isset($_POST["create"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $date_publication = $_POST["date_publication"];

    try {
        $stmt = $pdo->prepare("INSERT INTO book (title, author, date_publication) 
        VALUES( :title, :author, :date_publication)");

        $stmt->execute([
            "title" => $title,
            "author" => $author,
            "date_publication" => $date_publication
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Suppression d'un livre
if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $idbook = $_GET['id_book'];

    try {
        $stmt = $pdo->prepare("DELETE FROM book WHERE idbook = :idbook");
        $stmt->execute(["idbook" => $idbook]);
        echo "Le livre a bien été supprimé !";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Modification d'un livre (lorsqu'on clique sur "Modifier")
if (isset($_GET['action']) && $_GET['action'] == 'modify' && isset($_GET['id_book'])) {
    $idbook = $_GET['id_book'];
    // Récupérer les informations du livre à modifier
    $stmt = $pdo->prepare("SELECT * FROM book WHERE idbook = :idbook");
    $stmt->execute(["idbook" => $idbook]);
    $bookToModify = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mise à jour du livre modifié
if ($_POST && isset($_POST["update"])) {
    $idbook = $_POST["idbook"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $date_publication = $_POST["date_publication"];

    try {
        $stmt = $pdo->prepare("UPDATE book SET title = :title, author = :author, date_publication = :date_publication WHERE idbook = :idbook");
        $stmt->execute([
            "idbook" => $idbook,
            "title" => $title,
            "author" => $author,
            "date_publication" => $date_publication
        ]);
        // Afficher un message pour confirmer la mise à jour
        echo '<p class="margin">Le livre a bien été modifié !</p>';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Trier les livres
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'trier':
            $stmt = $pdo->query("SELECT * FROM book ORDER BY title ASC");
            break;
        case 'date':
            $stmt = $pdo->query("SELECT * FROM book ORDER BY date_publication DESC");
            break;
        case 'default':
            $stmt = $pdo->query("SELECT * FROM book");
            break;
        default:
            $stmt = $pdo->query("SELECT * FROM book");
            break;
    }
} else {
    $stmt = $pdo->query("SELECT * FROM book");
}

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<a href="inscription.php">Inscription</a>
<a href="login.php">Connexion</a>
</div>

<h1 >Mes livres en BDD</h1>

<table border="1">
    <thead>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Date</th>
        <th>Supprimer</th>
        <th>Modifier</th>
    </thead>
    <tbody>
        <?php
        foreach ($books as $book) {
            echo "<tr>";
            echo "<td>" . $book["title"] . "</td>";
            echo "<td>" . $book["author"] . "</td>";
            echo "<td>" . $book["date_publication"] . "</td>";
            echo "<td><a href='?id_book=" . $book["idbook"] . "&action=delete'>Supprimer</a></td>";
            echo "<td><a href='?id_book=" . $book["idbook"] . "&action=modify'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Formulaire de création -->
<br><br>
<form class="form" method="POST">
<h2>Crée un livre</h2>
    <div class="create">
    
        <div class="write">
            <label for="title">Titre:</label>
            <input type="text" name="title" id="title" placeholder="Titre">
        </div>
        
        <div class="write">
            <label for="author">Auteur:</label>
            <input type="text" name="author" id="author" placeholder="Auteur">
        </div>

        <div class="write">
            <label for="date_publication">Date:</label>
            <input type="date" name="date_publication" id="date_publication">
        </div>
        
        <input type="submit" name="create" value="Créer livre">
    </div>
    
    <div class="trier">
        <a class="tri" href="?action=trier">Trier par titre</a> |
        <a class="tri" href="?action=date">Trier par date</a> |
        <a class="tri" href="?action=default">Par défaut</a>
    </div>
</form>

<!-- Formulaire de modification si on est en mode "modify" -->
<?php if (isset($bookToModify)): ?>
    <h2>Modifier le livre</h2>
    <form class="form1" method="POST">
        <input type="hidden" name="idbook" value="<?php echo $bookToModify['idbook']; ?>">

        <div class="write">
            <label for="title">Titre:</label>
            <input type="text" name="title" id="title" value="<?php echo $bookToModify['title']; ?>" placeholder="Titre">
        </div>

        <div class="write">
            <label for="author">Auteur:</label>
            <input type="text" name="author" id="author" value="<?php echo $bookToModify['author']; ?>" placeholder="Auteur">
        </div>

        <div class="write">
            <label for="date_publication">Date:</label>
            <input type="date" name="date_publication" id="date_publication" value="<?php echo $bookToModify['date_publication']; ?>">
        </div>
        
        <input type="submit" name="update" value="Enregistrer les modifications">
    </form>
<?php endif; ?>

</body>
</html>
