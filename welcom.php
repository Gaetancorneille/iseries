<?php
session_start();
if (!isset($_SESSION['nickname'])) {

    header("Location: inscription.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue - iStart Séries TV</title>
    <link rel="stylesheet" type="text/css" href="styly.css">
</head>
<body>
    <div class="container">
        <h2>Bienvenue, <?php echo $_SESSION['nickname']; ?>!</h2>
        <p>Nous sommes ravis de vous accueillir sur iStart Séries TV.</p>
        <a href="index - copie.html">Aller à la page d'Accueil</a>
        <a href="logout.php">Déconnexion</a>
    </div>
</body>
</html>
