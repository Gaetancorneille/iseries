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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $Pseudo = $_POST['Pseudo'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (first_name, last_name, nickname, password, gender) VALUES ('$nom', '$prenom', '$Pseudo', '$password', '$gender')";
    
    
    
    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['nickname'] = $Pseudo;
        header("Location: welcom.php");
    
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

?>
