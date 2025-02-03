<?php
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Stocke l'URL de la page actuelle pour la redirection après la connexion
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    
    exit();
}

// Récupérer l'ID utilisateur depuis la session
$user_id = $_SESSION['user_id'];

// Récupérer l'ID utilisateur depuis l'URL ou la session
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : $_SESSION['user_id'];

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

// Assurez-vous que l'utilisateur ID dans l'URL correspond à l'ID de la session
if ($user_id != $_SESSION['user_id']) {
    header('Location: login.php');
    exit();
}

$dsn = 'mysql:host=localhost;dbname=stage';
$username = 'root';
$password = '';
$surveyId = isset($_GET['survey_id']) ? $_GET['survey_id'] : null;
$userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// Assurez-vous de valider et d'échapper les données récupérées pour éviter les injections SQL et autres failles
$surveyId = intval($surveyId);  // Pour un ID numérique
$userId = intval($userId);      // Pour un ID numérique

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die('Vous devez être connecté pour voter.');
    }

    $surveyId = $_POST['survey_id'];
    $optionId = $_POST['vote_id'];
    $userId = $_SESSION['user_id'];

    // Vérifier si l'utilisateur a déjà voté
    $stmt = $pdo->prepare('SELECT * FROM survey_votes WHERE user_id = ? AND survey_id = ?');
    $stmt->execute([$userId, $surveyId]);
    if ($stmt->rowCount() > 0) {
        die('Vous avez déjà voté pour ce sondage.');
    }

    // Enregistrer le vote
    $stmt = $pdo->prepare('INSERT INTO survey_votes (user_id, survey_id, vote_id) VALUES (?, ?, ?)');
    $stmt->execute([$userId, $surveyId, $optionId]);

    // Mettre à jour le nombre de votes
    $stmt = $pdo->prepare('UPDATE survey_answers SET votes = votes + 1 WHERE id = ?');
    $stmt->execute([$optionId]);

    header('Location: sondagess.php?survey_id=' . $surveyId);
    exit;
}

// Récupérer l'ID du sondage depuis l'URL
$surveyId = $_GET['survey_id'] ?? null;

if ($surveyId) {
    // Récupérer la question du sondage
    $stmt = $pdo->prepare('SELECT question FROM surveys WHERE id = ?');
    $stmt->execute([$surveyId]);
    $question = $stmt->fetchColumn();

    if (!$question) {
        $question = "Sondage non trouvé.";
    }
    // Récupérer les réponses du sondage
    $stmt = $pdo->prepare('SELECT * FROM survey_answers WHERE survey_id = ?');
    $stmt->execute([$surveyId]);
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer le total des votes
    $stmt = $pdo->prepare('SELECT SUM(votes) AS total_votes FROM survey_answers WHERE survey_id = ?');
    $stmt->execute([$surveyId]);
    $totalVotes = $stmt->fetchColumn();

    // Récupérer les votes de chaque option
    $stmt = $pdo->prepare('SELECT * FROM survey_answers WHERE survey_id = ?');
    $stmt->execute([$surveyId]);
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $result = [];
    foreach ($answers as $answer) {
        $voteCount = $answer['votes'];
        $percentage = $totalVotes > 0 ? ($voteCount / $totalVotes) * 100 : 0;
        $result[] = [
            'vote_id' => $answer['id'],
            'answer' => $answer['answer'],
            'vote_count' => $voteCount,
            'percentage' => number_format($percentage, 2)
        ];
    }

    // Trouver la réponse dominante
    usort($result, function ($a, $b) {
        return $b['vote_count'] - $a['vote_count'];
    });

    $leadingAnswer = $result[0]['answer'] ?? 'Aucune réponse';
} else {
    die('ID du sondage non spécifié.');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sondage Séries TV</title>
    <link rel="stylesheet" href="sond.css">
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
        <li><i class="fas fa-home"></i><a href="index.html">Accueil</a></li>
        <li><i class="fas fa-poll"></i><a href="sondage.html">Sondage</a></li>
        <li><i class="fas fa-newspaper"></i><a href="article.html">Articles</a></li>
        <li><i class="fas fa-tv"></i><a href="streaming.html">Streaming</a></li>
    </ul>
</nav>
    <main>
    <div class="survey-container">
    <h2><?php echo htmlspecialchars($question); ?></h2>
        <form action="sondagess.php" method="post">
            <input type="hidden" name="survey_id" value="<?php echo htmlspecialchars($surveyId); ?>">
            <ul>
                <?php foreach ($result as $item): ?>
                    <li>
                        <label>
                            <input type="radio" name="vote_id" value="<?php echo htmlspecialchars($item['vote_id']); ?>" required>
                            <?php echo htmlspecialchars($item['answer']); ?> 
                            (<?php echo htmlspecialchars($item['vote_count']); ?> votes, <?php echo htmlspecialchars($item['percentage']); ?>%)
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <button type="submit">Voter</button>
        </form>
        <p>Total des votes : <?php echo htmlspecialchars($totalVotes); ?></p>
        <p>Réponse dominante : <?php echo htmlspecialchars($leadingAnswer); ?></p>
        <a href="sondagess.php">Voir tous les sondages</a>
        </div>
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
