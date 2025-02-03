<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$isLoggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - iStart Séries-TV</title>
    <link rel="stylesheet" href="styleacceuil2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header >
<img src="logo-removebg-preview.png" alt="Site Logo" class="logo">
        </div>
        <div class="search-container">
            <input type="text" id="search-bar" placeholder="Rechercher...">
            <button id="search-button"><i class="fas fa-search"></i></button>
        </div>
        <div id="results-container">
            <h2>Résultats de la recherche :</h2>
            <ul id="results"></ul>
        </div>
    </header>
    <nav>
        <ul>
            <li><i class="fas fa-home"></i><a href="index.php">Accueil</a></li>
            <li><i class="fas fa-poll"></i><a href="sondage.html">Sondage</a></li>
            <li><i class="fas fa-newspaper"></i><a href="article.php">Articles</a></li>
            <li><i class="fas fa-tv"></i><a href="streaming - Copie.html">Streaming</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="login - copie.html">Connexion</a></li>
                <li><a href="register.html">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>
        <section class="intro">
            <h1>Bienvenue sur iStart le meilleur site dédié aux séries TV!</h1>
            <p>Découvrez des analyses, des critiques et des informations exclusives sur vos séries préférées.</p>
        </section>
        <section class="articles-preview">
            <h2>Découvrez quelques-uns de nos articles</h2>
            <div class="article-nav">
                <button class="nav-arrow" id="prev-arrow">&#9664;</button>
                <div class="articles-container">
                    <div class="article" onclick="window.location.href='article1.html'">
                        <img src="charmed.png" alt="Article 1">
                        <h3>Analyse de Charmed</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article2.html'">
                        <img src="onceuponatime.png" alt="Article 2">
                        <h3>Les secrets de Once Upon a Time</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article6.html'">
                        <img src="Madamemonsieur.jpg" alt="Article 6">
                        <h3>Madame...Monsieur: Quand le drame urbain rencontre la réalité Camerounaise</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article3.html'">
                        <img src="Screenshot_20231017-210654.jpg" alt="Article 3">
                        <h3>Les meilleurs moments de Bones</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article4.html'">
                        <img src="Screenshot_20231017-211345.jpg" alt="Article 4">
                        <h3>Suits: Avocats sur Mesure</h3>
                    </div>
                    <div class="article" onclick="window.location.href='article5.html'">
                        <img src="Screenshot_20231017-210531.jpg" alt="Article 5">
                        <h3>Les moments inoubliables de Friends</h3>
                    </div>
                    
                    <div class="article" onclick="window.location.href='article7.html'">
                        <img src="ma grande famille.jpg" alt="Article 7">
                        <h3>Ma Grande Famille: Un  portrait authentique de la vie quotidienne en Cote d'Ivoire</h3>
                    </div>
                </div>
                <button class="nav-arrow" id="next-arrow">&#9654;</button>
            </div>
        </section>
<section class="surveys-preview">
            <h2>Participer à nos sondages</h2>
            <div class="survey" onclick="window.location.href='sondage.html'">
                <img src="photosondage.png" alt="Survey">
                <h3>Quel est votre genre de série préféré ?</h3>
            </div>
        </section>
        <section class="streaming-preview">
            <h2>Regardez vos séries en ligne</h2>
            <div class="stream" onclick="window.location.href='streaming.html'">
                <img src="STRAM.PNG" alt="Streaming">
                <h3>Découvrez les séries en streaming</h3>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-menus">
                <ul>
                    <li><a href="index-.html">Accueil</a></li>
                    <li><a href="article - Copie.html">Articles</a></li>
                    <li><a href="sondage1.php">Sondages</a></li>
                    <li><a href="streaming - Copie.html">Streaming</a></li>
                    <li><a href="A_propos.html">À propos</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="politique_et_confiedentialité.html">Politique de confidentialité</a></li>
                    <li><a href="termes_et_conditions.html">Termes et conditions</a></li>
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
            <p>&copy; 2024 iStart Séries-TV. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>