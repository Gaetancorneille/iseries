<?php
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer l'ID de la série et de la saison depuis l'URL
$series_id = isset($_GET['series_id']) ? intval($_GET['series_id']) : null;
$season_id = isset($_GET['season_id']) ? intval($_GET['season_id']) : null;

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

// Récupérer les informations de la série
$sql = 'SELECT * FROM series WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$series_id]);
$series = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$series) {
    die('Série non trouvée.');
}

// Récupérer les saisons de la série
$sql = 'SELECT * FROM seasons WHERE series_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$series_id]);
$seasons = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Définir la saison par défaut (saison 1)
$defaultSeasonId = $seasons[0]['id'] ?? null;

// Récupérer les épisodes de la saison sélectionnée
$episodes = [];
if ($season_id) {
    $sql = 'SELECT * FROM episodes WHERE season_id = ? ORDER BY episode_number';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$season_id]);
    $episodes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streaming - <?php echo htmlspecialchars($series['title']); ?></title>
    <link rel="stylesheet" href="streamin.css">
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
        <li><i class="fas fa-poll"></i><a href="sondage.php">Sondage</a></li>
        <li><i class="fas fa-newspaper"></i><a href="article.php">Articles</a></li>
        <li><i class="fas fa-tv"></i><a href="streaming.php">Streaming</a></li>
    </ul>
</nav>
    <main>
    <section class="serie-streaming">
            <h1><?php echo htmlspecialchars($series['title']); ?></h1>
        <h1><img src="<?php echo htmlspecialchars($series['photo_url']); ?>" alt="Photo de la série"></h1>
            <p><?php echo htmlspecialchars($series['description']); ?></p>
            <form action="streaming.php" method="get">
                <input type="hidden" name="series_id" value="<?php echo htmlspecialchars($series_id); ?>">
                <label for="season">Sélectionner une saison:</label>
                <select id="season" name="season_id" onchange="this.form.submit()">
                    <option value="">-- Choisir une saison --</option>
                    <?php foreach ($seasons as $season): ?>
                        <option value="<?php echo htmlspecialchars($season['id']); ?>" <?php echo $season_id == $season['id'] ? 'selected' : ''; ?>>
                            Saison <?php echo htmlspecialchars($season['season_number']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
    </section>
    <section class="épisodes">
            <?php if ($season_id): ?>
                <h2>Épisodes de la Saison <?php echo htmlspecialchars($season_id); ?></h2>
                <ul>
                    <?php foreach ($episodes as $episode): ?>
                        <li>
                            <h3><?php echo htmlspecialchars($episode['title']); ?> (Épisode <?php echo htmlspecialchars($episode['episode_number']); ?>)</h3>
                            <a href="<?php echo htmlspecialchars($episode['video_url']); ?>" target="_blank">Regarder</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?></section>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-menus">
                <ul>
                    <li><a href="index.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Accueil</a></li>
                    <li><a href="articlephp?user_id=<?php echo htmlspecialchars($user_id); ?>">Articles</a></li>
                    <li><a href="sondage2.php?user_id=<?php echo htmlspecialchars($user_id); ?>">Sondages</a></li>
                    <li><a href="streamingphp?user_id=<?php echo htmlspecialchars($user_id); ?>">Streaming</a></li>
                    <li><a href="#" onclick="return showAlert('À propos de notre site')">À propos</a></li>
                    <li><a href="#" onclick="return showAlert('Contactez-nous pour toute question.')">Contact</a></li>
                    <li><a href="#" onclick="return showAlert('Consultez notre politique de confidentialité.')">Politique de confidentialité</a></li>
                    <li><a href="#" onclick="return showAlert('Lisez nos termes et conditions.')">Termes et conditions</a></li>
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
</body>
</html>
