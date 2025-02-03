<?php
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
// Vérifie si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - iSéries-TV</title>
    <link rel="stylesheet" href="styleacceuil2.css">
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
            <li><i class="fas fa-poll"></i><a href="sondage2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Sondage</a></li>
            <li><i class="fas fa-tv"></i><a href="streaming2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Streaming</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="login - copie.html">Connexion</a></li>
                <li><a href="FORM - Copie.html">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>
        <section class="intro">
            <h1>Bienvenue sur iSéries le meilleur site dédié aux séries TV!</h1>
            <p>Découvrez des analyses, des critiques et des informations exclusives sur vos séries préférées.</p>
        </section>
        <section class="articles-preview">
            <h2><a href="article.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Découvrez quelques-uns de nos articles</a></h2>
            <div class="article-nav">
                <button class="nav-arrow" id="prev-arrow">&#9664;</button>
                <div class="articles-container">
                    <div class="article" onclick="window.location.href='article1.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                        <img src="charmed.png" alt="Article 1">
                        <h3>Analyse de Charmed</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article2.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                        <img src="onceuponatime.png" alt="Article 2">
                        <h3>Les secrets de Once Upon a Time</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article5.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                        <img src="Screenshot_20231017-210654.jpg" alt="Article 5">
                        <h3>Les meilleurs moments de Bones</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article4.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                        <img src="Screenshot_20231017-211345.jpg" alt="Article 4">
                        <h3>Suits: Avocats sur Mesure</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article3.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                        <img src="Madamemonsieur.jpg" alt="Article 3">
                        <h3>Madame...Monsieur: Quand le drame urbain rencontre la réalité Camerounaise</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article6.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                        <img src="Screenshot_20231017-210531.jpg" alt="Article 6">
                        <h3>Les moments inoubliables de Friends</h3>
                    </div>
                    
                    <div class="article" onclick="window.location.href='article7.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                        <img src="ma grande famille.jpg" alt="Article 7">
                        <h3>Ma Grande Famille: Un  portrait authentique de la vie quotidienne en Cote d'Ivoire</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                        <h3>Découvrez tous nos articles</h3>
                    </div>
                </div>
                <button class="nav-arrow" id="next-arrow">&#9654;</button>
            </div>
        </section>
<section class="surveys-preview">
            <h2>Participer à nos sondages</h2>
            <div class="survey" onclick="window.location.href='sondage2.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                <img src="photosondage.png" alt="Survey">
                <h3>Quel est votre genre de série préféré ?</h3>
            </div>
        </section>
        <section class="streaming-preview">
            <h2>Regardez vos séries en ligne</h2>
            <div class="stream" onclick="window.location.href='streaming2.php?user_id=<?php echo htmlspecialchars($user_id); ?>'">
                <img src="STRAM.PNG" alt="Streaming">
                <h3>Découvrez les séries en streaming</h3>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-menus">
                <ul>
                    <li><a href="index.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Accueil</a></li>
                    <li><a href="article.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Articles</a></li>
                    <li><a href="sondage2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Sondages</a></li>
                    <li><a href="streaming2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Streaming</a></li>
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

    <script src="scripts.js"></script>
</body>
</html>