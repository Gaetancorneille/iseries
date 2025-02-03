<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$db = 'stage';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des votes
$sql = "SELECT * FROM survey_answers";
$result = $conn->query($sql);

$answers = [];
while ($row = $result->fetch_assoc()) {
    $answers[] = $row;
}

echo json_encode(['answers' => $answers]);

$conn->close();
?>
