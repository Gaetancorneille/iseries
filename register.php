<?php
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
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$nickname = $_POST['Pseudo'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];
$gender = $_POST['gender'];

// Vérification des mots de passe
if ($password !== $confirm_password) {
    echo "Les mots de passe ne correspondent pas.";
    exit();
}

// Hashage du mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertion des données dans la base de données
$sql = "INSERT INTO users (first_name, last_name, nickname, password, gender) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nom, $prenom, $nickname, $hashed_password, $gender);

if ($stmt->execute()) {
    echo "Inscription réussie !";
    // Stocker l'ID utilisateur dans la session
    $_SESSION['user_id'] = $user_id;

    // Rediriger vers la page précédente ou vers une page spécifique
    $redirectUrl = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'login - Copie.html';
    unset($_SESSION['redirect_url']); // Supprimer l'URL de redirection de la session
    header('Location: ' . $redirectUrl . '?user_id=' . $_SESSION['user_id']);
    exit();    
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
