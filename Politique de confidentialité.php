<?php
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Stocke l'URL de la page actuelle pour la redirection après la connexion
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login - Copie.html');
    exit();
}

// Récupérer l'ID utilisateur depuis la session
$user_id = $_SESSION['user_id'];

// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=stage';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de confidentialité - iSéries-TV</title>
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function showAlert(message) {
            alert(message);
            return false; // Prevents the default link behavior
        }
    </script>
</head>
<body>
    <header >
<img src="logo1-removebg-preview.png" alt="Site Logo" class="logo">
<div class="search-container">
            <form action="search.php?user_id=<?php echo htmlspecialchars($user_id); ?>" method="GET">
              <input type="text" id="search-bar" name="query" placeholder="Rechercher..." required>
              <button id="search-button"><i class="fas fa-search"></i></button>
            </form>
        </div>
   </header>        
   <nav>
    <ul>
        <li><i class="fas fa-home"></i><a href="index.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Accueil</a></li>
        <li><i class="fas fa-newspaper"></i><a href="article.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Articles</a></li>
        <li><i class="fas fa-poll"></i><a href="sondage2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Sondages</a></li>
        <li><i class="fas fa-tv"></i><a href="streaming2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Streaming</a></li>
    </ul>
</nav>
    <main>
    <article>
        <h1>Politique de Confidentialité</h1>
        <h3>Chez **iSéries-TV**, la confidentialité de vos données personnelles est une priorité. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations lorsque vous utilisez notre site.</h3>
        <section class="overview">
        <h2>Informations Collectées</h2>
            <p>Nous collectons des informations personnelles que vous nous fournissez lorsque vous vous inscrivez à notre newsletter, remplissez un formulaire de contact ou participez à nos sondages. Ces informations peuvent inclure votre nom, adresse e-mail et autres détails pertinents.</p>
        </section>
        <section class="overview">
            <h2>Utilisation des Informations</h2>
            <p>Les informations que nous collectons sont utilisées pour :</p>
            <p>- Vous envoyer des mises à jour et des newsletters sur nos services.</p>
            <p>- Répondre à vos questions et demandes.</p>
            <p>- Améliorer notre site et nos services en fonction de vos préférences.</p>
        </section>
        <section class="overview">
        <h2>Protection des Données</h2>
            <p>Nous mettons en place des mesures de sécurité pour protéger vos données contre tout accès non autorisé, modification ou divulgation. Cependant, aucune méthode de transmission sur Internet ou méthode de stockage électronique n'est complètement sécurisée.</p>
        </section>
        <section class="overview">
        <h2>Cookies</h2>
            <p>Nous utilisons des cookies pour améliorer votre expérience sur notre site. Vous pouvez choisir de désactiver les cookies dans les paramètres de votre navigateur.</p>
        </section>
        <section class="overview">
        <h2>Modifications de la Politique</h2>
            <p>Nous pouvons mettre à jour cette politique de confidentialité de temps en temps. Nous vous informerons de tout changement en publiant la nouvelle version sur cette page.</p>
        </section>
        <section class="overview">
            <p>Pour toute question concernant notre politique de confidentialité, veuillez nous contacter à support@istartseries.com.</p>
        </section>
    </article>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-menus">
                <ul>
                    <li><i class="fas fa-home"></i><a href="index.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Accueil</a></li>
                    <li><i class="fas fa-newspaper"></i><a href="article.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Articles</a></li>
                    <li><i class="fas fa-poll"></i><a href="sondage2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Sondages</a></li>
                    <li><i class="fas fa-tv"></i><a href="streaming2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Streaming</a></li>
                    <li><a href="À propos.php?user_id=<?php echo htmlspecialchars($user_id); ?>">À propos</a></li>
                    <li><a href="Contact.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Contact</a></li>
                    <li><a href="Politique de confidentialité.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Politique de confidentialité</a></li>
                    <li><a href="Termes et conditions.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Termes et conditions</a></li>
                </ul>
            </div>
            <div class="footer-socials">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 iSéries-TV. Tous droits réservés.</p>
        </div>
    </footer>
    
</body>
</html>