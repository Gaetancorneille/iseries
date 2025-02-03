<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo "Vous devez être connecté pour voter.";
    exit();
}

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

// Récupération des données du vote
$answer = $_POST['survey_id'];
$nickname = $_SESSION['user'];

// Vérifie si l'utilisateur a déjà voté
$sql = "SELECT * FROM survey_votes WHERE user_id = ? AND survey_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nickname, $answer_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // L'utilisateur a déjà voté pour cette réponse
    echo "Vous avez déjà voté pour cette réponse.";
} else {
    // Enregistrement du vote
    $sql = "INSERT INTO survey_votes (user_id) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nickname, $option_id);
    
    if ($stmt->execute()) {
        // Mise à jour du nombre de votes pour la réponse
        $sql = "UPDATE survey_answers SET votes = votes + 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $answer_id);
        $stmt->execute();
        
        echo "Vote enregistré avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement du vote.";
    }
}

$stmt->close();
$conn->close();
?>
