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
    <title>Streaming - iSéries TV </title>
    <link rel="stylesheet" href="stream.css">
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
        <section class="streaming-content">
            <h1>Séries en Streaming</h1>
            <div class="series-grid">
                <div class="series-card">
                    <img src="20240210_085940.jpg" alt="Série 2">
                    <h2>The Flash</h2>
                    <a href="streaming.php?series_id=2&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="20240210_090018.jpg" alt="Série 3">
                    <h2>The Vampire Diaries</h2>
                    <a href="streaming.php?series_id=7&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="Screenshot_20231017-211543.jpg" alt="Série 4">
                    <h2>Mercredi</h2>
                    <a href="streaming.php?series_id=4&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="20240208_102817.jpg" alt="Série 5">
                    <h2>Empire</h2>
                    <a href="streaming.php?series_id=5&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="20240208_102901.jpg" alt="Série 2">
                    <h2>Sweet Magnolias</h2>
                    <a href="streaming.php?series_id=6&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="charmed.png" alt="Série 8">
                    <h2>Charmed</h2>
                    <a href="streaming.php?series_id=1&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="onceuponatime.png" alt="Série 2">
                    <h2>Once Upon a Time</h2>
                    <a href="streaming.php?series_id=3&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="Madamemonsieur.jpg" alt="Série 2">
                    <h2>Madame...Monsieur</h2>
                    <a href="streaming.php?series_id=8&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="Screenshot_20231017-211345.jpg" alt="Série 2">
                    <h2>Suits: Avocats sur Mesure</h2>
                    <a href="streaming.php?series_id=9&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="Screenshot_20231017-210531.jpg" alt="Série 2">
                    <h2>Friends</h2>
                    <a href="streaming.php?series_id=10&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="bones.jpg" alt="Série 2">
                    <h2>Bones</h2>
                    <a href="streaming.php?series_id=11&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
                </div>
                <div class="series-card">
                    <img src="Screenshot_20231017-210257.jpg" alt="Série 2">
                    <h2>The Big Bang Theory</h2>
                    <a href="streaming.php?series_id=12&user_id=<?php echo htmlspecialchars($user_id); ?>" class="watch-button">Regarder</a>
            </div>
        </section>
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