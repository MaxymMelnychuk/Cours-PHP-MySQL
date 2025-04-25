<?php

require_once("connexion.php");

///// EXEC

if ($_POST) {
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


if (isset($_GET['action']) && $_GET['action'] == 'modify' && isset($book)) {
    if ($_POST) {
        // Récupère les nouvelles valeurs
        $newTitle = $_POST['title'];
        $newAuthor = $_POST['author'];
        $newDate = $_POST['date_publication'];

        // Assurez-vous que vous avez une requête préparée pour éviter les injections SQL
        $stmt = $pdo->prepare("UPDATE book SET title = :title, author = :author, date_publication = :date_publication WHERE idbook = :idbook");
        
        // Exécution de la mise à jour en passant les valeurs
        $stmt->execute([
            'title' => $newTitle,
            'author' => $newAuthor,
            'date_publication' => $newDate,
            'idbook' => $book['idbook']  // Identifie le livre à mettre à jour
        ]);
        
        // Optionnel: Message de confirmation ou redirection
        echo "Livre mis à jour avec succès!";
    }
    }


// trier par date

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'trier':
            // Trier par titre (ordre croissant)
            $stmt = $pdo->query("SELECT * FROM book ORDER BY title ASC");
            break;

        case 'date':
            // Trier par date de publication (ordre décroissant)
            $stmt = $pdo->query("SELECT * FROM book ORDER BY date_publication DESC");
            break;

        case 'default':
            // Si aucune action, afficher tous les livres
            $stmt = $pdo->query("SELECT * FROM book");
            break;

        default:
            // Si aucune des actions ci-dessus, afficher tous les livres
            $stmt = $pdo->query("SELECT * FROM book");
            break;
    }
} else {
    // Par défaut, afficher tous les livres
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

    <h1>Mes livres en BDD</h1>

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
                echo "<td> <a href='?id_book=". $book["idbook"] . "&action=delete'> Supprimer </a> </td>";
                echo "<td> <a href='?id_book=". $book["idbook"] . "&action=modify'> Modifier </a> </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <br>
    <form method="POST">
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
            
            <input type="submit" value="Créer livre">

        </div>
        
        <div class="trier">
            <a class="tri" href="?action=trier">Trier par titre</a> |
            <a class="tri" href="?action=date">Trier par date</a> |
            <a class="tri" href="?action=default">Par defaut</a>
        </div>
    </form>

    

</body>

</html>
