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
        <h2>Désolé <?php echo $_SESSION['nickname']; ?>!</h2>
        <p>Ce mot de passe est incorrect</p>
        <a href="login.html">Réessayer</a>
        <a href="form.html">S'inscrire</a>
        <a href="mot_de_passe_oublié.html">Mot de passe oublié</a>
    </div>
</body>
</html>
