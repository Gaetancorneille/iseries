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
    <title>Termes et Conditions - iSéries TV</title>
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
<img src="logo-removebg-preview.png" alt="Site Logo" class="logo">
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
        <h1>Termes et Conditions</h1>
        <h3>Bienvenue sur **iSéries TV**. En utilisant notre site, vous acceptez de vous conformer aux termes et conditions suivants :</h3>
        <section class="overview">
            <h2>1. Utilisation du Site</h2>
            <p>Vous acceptez d'utiliser notre site uniquement à des fins légales et conformément à toutes les lois applicables. Vous ne devez pas utiliser le site d'une manière qui pourrait endommager, désactiver ou altérer le site ou nuire à l'utilisation de toute autre personne.</p>
        </section>
        <section class="overview">
            <h2>2. Propriété Intellectuelle</h2>
            <p>Tous les contenus disponibles sur **iSéries TV**, y compris les textes, images, vidéos et autres éléments, sont la propriété de **iSéries TV** ou de ses concédants de licence. Vous ne devez pas reproduire, distribuer ou créer des œuvres dérivées de notre contenu sans notre autorisation.</p>
        </section>
        <section class="overview">
            <h2>3. Droits sur les Images et Vidéos</h2>
            <p>Nous tenons à préciser que **iSéries TV** ne détient aucun droit de propriété sur les images, vidéos, extraits de séries ou tout autre contenu visuel diffusé sur notre site. Ces éléments sont la propriété de leurs titulaires de droits respectifs, tels que les studios de production, les chaînes de télévision, ou les créateurs de contenu. Les images et vidéos sont utilisées à des fins d'illustration et d'information seulement. Nous faisons tout notre possible pour créditer correctement les sources lorsque cela est possible. Si vous êtes titulaire des droits d'une image ou d'une vidéo publiée sur notre site et que vous souhaitez qu'elle soit retirée, veuillez nous contacter à support@istartseries.com.</p>
        </section>
        <section class="overview">
            <h2>4. Liens Externes</h2>
            <p>Notre site peut contenir des liens vers des sites externes. Nous ne sommes pas responsables du contenu ou des pratiques de confidentialité de ces sites. L'accès à des sites tiers est à vos propres risques.</p>
        </section>
        <section class="overview">
            <h2>5. Modifications des Termes</h2>
            <p>Nous nous réservons le droit de modifier ces termes et conditions à tout moment. Les modifications entreront en vigueur dès leur publication sur notre site. Il est de votre responsabilité de consulter régulièrement ces termes pour rester informé des éventuels changements.</p>
        </section>
        <section class="overview">
            <h2>6. Responsabilités</h2>
            <p>Nous nous efforçons de maintenir notre site à jour et fonctionnel, mais nous ne garantissons pas qu'il sera exempt d'erreurs ou d'interruptions. Nous ne serons pas responsables des dommages directs ou indirects résultant de l'utilisation de notre site.</p>
        </section>
        <section class="overview">
            <h2>7. Droit Applicable</h2>
            <p>Ces termes et conditions sont régis par les lois camerounaises. Tout litige relatif à l'utilisation de notre site sera soumis à la compétence exclusive des tribunaux camerounais.</p>
        </section>
        <section class="overview">
            <p>Pour toute question concernant nos termes et conditions, veuillez nous contacter à support@istartseries.com</p>
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