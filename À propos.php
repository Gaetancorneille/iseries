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
    <title>À propos d'iSéries-TV</title>
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
        <h1>À propos</h1>
        <h3>Bienvenue sur **iSéries-TV**, votre destination incontournable pour tout ce qui concerne les séries télévisées ! Notre site est dédié aux passionnés de séries, offrant des critiques, des articles détaillés, des vidéos, et des informations complètes sur vos séries préférées.</h3>
        <section class="overview">
            <h2>Notre Mission</h2>
            <p>Nous avons pour mission de vous fournir un contenu de qualité sur les séries TV, en mettant en avant les dernières nouveautés, des critiques approfondies et des informations pertinentes sur vos shows favoris. Que vous soyez un amateur de drames, de comédies, de science-fiction ou de fantastique, nous avons quelque chose pour vous.</p>
        </section>
        <section class="overview">
            <h2>Notre Équipe</h2>
            <p>Notre équipe est composée de passionnés de séries TV qui s'efforcent de vous offrir une expérience enrichissante et divertissante. Nous nous engageons à fournir des critiques honnêtes, des mises à jour régulières et un contenu engageant pour tous les fans de séries.</p>
        </section>
        <section class="overview">
            <p>Merci de nous rejoindre dans cette aventure passionnante. Nous espérons que vous apprécierez votre visite sur **iStart Séries TV**</p>
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