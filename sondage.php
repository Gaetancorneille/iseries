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
    $vote = $_POST['vote'];

    $sql = "INSERT INTO survey_answers (votes) VALUES ('$vote')";
    
    
    
    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['nickname'] = $Pseudo;
       echo 'votre vote est enregistré';
    
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

?>