<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stage";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête pour sélectionner toutes les données de la table users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs - iStart Séries TV</title>
    <link rel="stylesheet" type="text/css" href="stylo.css">
</head>
<body>
    <div class="container">
        <h2>Liste des utilisateurs</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Pseudo</th><th>Genre</th></tr>";
            // Affichage des données de chaque ligne
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["nickname"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 résultats";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
