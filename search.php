<?php
session_start(); // Démarre la session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
// Vérifie si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['user_id']);

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

// Récupérer le mot-clé de la requête GET
$query = isset($_GET['query']) ? '%' . $_GET['query'] . '%' : '';

// Rechercher dans la table `series`
$sql_series = "SELECT id, title, description, photo_url FROM series WHERE title LIKE ?";
$stmt_series = $pdo->prepare($sql_series);
$stmt_series->execute([$query]);
$series_results = $stmt_series->fetchAll(PDO::FETCH_ASSOC);
// Rechercher dans la table `actors` avec jointure sur `series`
$sql_actors = "
    SELECT actors.id, actors.name, actors.bio, actors.photo_url, GROUP_CONCAT(series.title SEPARATOR ', ') AS series_titles
    FROM actors
    LEFT JOIN actor_series ON actors.id = actor_series.actor_id
    LEFT JOIN series ON actor_series.series_id = series.id
    WHERE actors.name LIKE ?
    GROUP BY actors.id";
$stmt_actors = $pdo->prepare($sql_actors);
$stmt_actors->execute([$query]);
$actors_results = $stmt_actors->fetchAll(PDO::FETCH_ASSOC);


// Rechercher dans la table `articles`
$sql_articles = "SELECT id, title FROM articles WHERE title LIKE ?";
$stmt_articles = $pdo->prepare($sql_articles);
$stmt_articles->execute([$query]);
$articles_results = $stmt_articles->fetchAll(PDO::FETCH_ASSOC);

// Rechercher dans la table `survey_answers` pour les sondages
$sql_surveys = "SELECT DISTINCT s.id, s.question FROM surveys s
                JOIN survey_answers sa ON s.id = sa.survey_id
                WHERE sa.answer LIKE ?";
$stmt_surveys = $pdo->prepare($sql_surveys);
$stmt_surveys->execute([$query]);
$surveys_results = $stmt_surveys->fetchAll(PDO::FETCH_ASSOC);

// Rechercher dans la table `streaming` pour le nom
$sql_streaming = "SELECT id, title FROM series WHERE title LIKE ?";
$stmt_streaming = $pdo->prepare($sql_streaming);
$stmt_streaming->execute([$query]);
$streaming_results = $stmt_streaming->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la Recherche "<?php echo htmlspecialchars($query); ?>"</title>
    <link rel="stylesheet" href="search.css"> <!-- Inclure ton fichier CSS -->
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
        <h1>Résultats de la Recherche "<?php echo htmlspecialchars($query); ?>"</h1>
    
        <h2>Séries</h2>
        <?php if ($series_results): ?>
            <ul>
                <?php foreach ($series_results as $series): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($series['title']); ?></h3>
                        
                        <?php if (!empty($series['photo_url'])): ?>
                            <img src="<?php echo htmlspecialchars($series['photo_url']); ?>" alt="<?php echo htmlspecialchars($series['title']); ?>" style="max-width: 35%; height: auto;">
                        <?php endif; ?>
                        <p><?php echo htmlspecialchars($series['description']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune série trouvée.</p>
        <?php endif; ?>
        <h2>Acteurs</h2>
        <?php if ($actors_results): ?>
            <ul>
                <?php foreach ($actors_results as $actor): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($actor['name']); ?></h3>
                        
                        <?php if (!empty($actor['photo_url'])): ?>
                            <img src="<?php echo htmlspecialchars($actor['photo_url']); ?>" alt="<?php echo htmlspecialchars($actor['name']); ?>" style="max-width: 35%; height: auto;">
                        <?php endif; ?>
                        <p><?php echo htmlspecialchars($actor['bio']); ?></p>
                        <p><strong>Séries :</strong> <?php echo htmlspecialchars($actor['series_titles']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun acteur trouvé.</p>
        <?php endif; ?>
        <h2>Articles</h2>
        <?php if ($articles_results): ?>
            <ul>
                <?php foreach ($articles_results as $article): ?>
                    <li><a href="article.php?id=<?php echo htmlspecialchars($article['id']); ?>&user_id=<?php echo htmlspecialchars($user_id); ?>">
                        <?php echo htmlspecialchars($article['title']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun article trouvé.</p>
        <?php endif; ?>

        <h2>Sondages</h2>
        <?php if ($surveys_results): ?>
            <ul>
                <?php foreach ($surveys_results as $survey): ?>
                    <li><a href="sondagess.php?survey_id=<?php echo htmlspecialchars($survey['id']); ?>&user_id=<?php echo htmlspecialchars($user_id); ?>">
                        <?php echo htmlspecialchars($survey['question']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun sondage trouvé.</p>
        <?php endif; ?>

        <h2>Streaming</h2>
        <?php if ($streaming_results): ?>
            <ul>
                <?php foreach ($streaming_results as $streaming): ?>
                    <li><a href="streaming.php?series_id=<?php echo htmlspecialchars($streaming['id']); ?>&user_id=<?php echo htmlspecialchars($user_id); ?>">
                        <?php echo htmlspecialchars($streaming['title']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun contenu de streaming trouvé.</p>
        <?php endif; ?>
    </main>
</body>
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
</html>
