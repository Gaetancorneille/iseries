<?php
session_start(); // Démarre la session

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

// Récupération des données du formulaire
$nickname = $_POST['Pseudo'];
$password = $_POST['password'];

// Vérification des identifiants
$sql = "SELECT id, password FROM users WHERE nickname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nickname);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    
    if (password_verify($password, $hashed_password)) {
        // Stocker l'ID utilisateur dans la session
        $_SESSION['user_id'] = $user_id;

        // Rediriger vers la page précédente ou vers une page spécifique
        $redirectUrl = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.php';
        unset($_SESSION['redirect_url']); // Supprimer l'URL de redirection de la session
        header('Location: ' . $redirectUrl . '?user_id=' . $_SESSION['user_id']);
        exit();    
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Identifiants incorrects.";
}

$stmt->close();
$conn->close();
?>
