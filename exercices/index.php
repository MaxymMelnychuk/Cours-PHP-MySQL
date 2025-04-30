<?php 
require_once("connexion.php");



// Création d'un livre au click
if ($_POST && isset($_POST["create"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $date_publication = $_POST["date_publication"];
    $availability = $_POST["availability"];

    try { //inserer dans la BDD ce qu'on avait mit dans input
        $stmt = $pdo->prepare("INSERT INTO book (title, author, date_publication, availability) 
        VALUES( :title, :author, :date_publication, :availability)");

        $stmt->execute([
            "title" => $title,
            "author" => $author,
            "date_publication" => $date_publication,
            "availability" => $availability
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Suppression d'un livre au click
if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $idbook = $_GET['id_book'];

    try { //suppresion de la BDD
        $stmt = $pdo->prepare("DELETE FROM book WHERE idbook = :idbook");
        $stmt->execute(["idbook" => $idbook]);
        echo "Le livre a bien été supprimé !";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}



// Trier les livres
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'title':
            $stmt = $pdo->query("SELECT * FROM book ORDER BY title ASC");
            break;
        case 'date':
            $stmt = $pdo->query("SELECT * FROM book ORDER BY date_publication DESC");
            break;
        case 'author':
            $stmt = $pdo->query("SELECT * FROM book ORDER BY author ASC");
            break;
        case 'default':
            $stmt = $pdo->query("SELECT * FROM book");
            break;
        case 'two':
            $stmt = $pdo->query("SELECT * FROM book WHERE date_publication > '2000-01-01'");
            break;
        case 'dispo':
            $stmt = $pdo->query("SELECT * FROM book ORDER BY availability DESC");
            break;
        default:
            $stmt = $pdo->query("SELECT * FROM book");
            break;
    }
} else {
    $stmt = $pdo->query("SELECT * FROM book");
}

//recuper les livres
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
<a href="../projet-axe/index.php">Projet axe</a>
</div>

<h1 >Mes livres en BDD</h1>

<table border="1">
    <thead>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Date</th>
        <th>Disponibilité</th>
        <th>Supprimer</th>
    </thead>
    <tbody>
        <?php //pour chaque livre je vais afficher titre, auteur, etc. et action, soit supprimer soit modifier
        foreach ($books as $book) {
            echo "<tr>";
            echo "<td>" . $book["title"] . "</td>";
            echo "<td>" . $book["author"] . "</td>";
            echo "<td>" . $book["date_publication"] . "</td>";
            echo "<td>" . $book["availability"] . "</td>";
            echo "<td><a href='?id_book=" . $book["idbook"] . "&action=delete'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- form pour crée un livre -->
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

        <div class="write">
            <label for="availability">Disponibilité:</label>
            <input type="number" name="availability" id="availability" placeholder="Disponibilité">
        </div>
        
        <input type="submit" name="create" value="Créer livre">
    </div>
    <!-- trier des livres -->
    <div class="trier">
        <a class="tri" href="?action=title">Trier par titre</a> |
        <a class="tri" href="?action=date">Trier par date</a> |
        <a class="tri" href="?action=author">Trier par auteur</a> |
        <a class="tri" href="?action=two">Trier apres années 2000</a> |
        <a class="tri" href="?action=dispo">Trier par disponibilité</a> |
        <a class="tri" href="?action=default">Par défaut</a>
    </div>
</form>


</body>
</html>
