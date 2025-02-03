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
    <title>Sondage - iSéries TV</title>
    <link rel="stylesheet" href="sondage.css">
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
        <section class="intro">
            <p>Un petit clic pour un sondage !</p>
        </section>
    
        <section class="survey-list">
            <h2>Découvrez nos Sondages</h2>
            <ul>
                <li><a href="sondagess.php?survey_id=2&user_id=<?php echo urlencode($user_id); ?>">C'est le temps des élections. Qui serait le meilleur président?</a></li>
                <li><a href="sondagess.php?survey_id=3&user_id=<?php echo urlencode($user_id); ?>">Les examens approchent à grands pas... Qui appeler pour vous aider à réviser ?</a></li>
                <li><a href="sondagess.php?survey_id=4&user_id=<?php echo urlencode($user_id); ?>">Quelle est votre série TV préférée 1?</a></li>
                <li><a href="sondagess.php?survey_id=5&user_id=<?php echo urlencode($user_id); ?>">Quel est votre personnage principal préféré dans les séries télévisées ?</a></li>
                <li><a href="sondagess.php?survey_id=6&user_id=<?php echo urlencode($user_id); ?>">Quelle série télévisée vous a le plus surpris par ses rebondissements ?</a></li>
                <li><a href="sondagess.php?survey_id=7&user_id=<?php echo urlencode($user_id); ?>">Quel duo de personnages de série trouvez-vous le plus iconique ?</a></li>
                <li><a href="sondagess.php?survey_id=8&user_id=<?php echo urlencode($user_id); ?>">Quelle série télévisée vous a fait le plus rire ?</a></li>
                <li><a href="sondagess.php?survey_id=9&user_id=<?php echo urlencode($user_id); ?>">Quelle série télévisée vous a le plus ému ?</a></li>
                <li><a href="sondagess.php?survey_id=10&user_id=<?php echo urlencode($user_id); ?>">Quel est le meilleur méchant dans une série télévisée ?</a></li>
                <li><a href="sondagess.php?survey_id=11&user_id=<?php echo urlencode($user_id); ?>">Quelle série télévisée vous a le plus déçu à la fin ?</a></li>
                <li><a href="sondagess.php?survey_id=12&user_id=<?php echo urlencode($user_id); ?>">Quelle série télévisée avez-vous binge-watchée le plus rapidement ?</a></li>
                <li><a href="sondagess.php?survey_id=13&user_id=<?php echo urlencode($user_id); ?>">Quel personnage de série aimeriez-vous avoir comme ami ?</a></li>
                <li><a href="sondagess.php?survey_id=14&user_id=<?php echo urlencode($user_id); ?>">Quelle série vous a le plus captivé dès le premier épisode ?</a></li>
                <li><a href="sondagess.php?survey_id=15&user_id=<?php echo urlencode($user_id); ?>">Quel personnage secondaire de série mérite plus de reconnaissance ?</a></li>
            </ul>
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
    <script>
        const searchBar = document.getElementById('search-bar');
const searchButton = document.getElementById('search-button');
const resultsContainer = document.getElementById('results-container');
const resultsList = document.getElementById('results');

const data = [
    { type: 'Série', name: 'Breaking Bad' },
    { type: 'Série', name: 'Game of Thrones' },
    { type: 'Série', name: 'Friends' },
    { type: 'Article', name: 'Les meilleures séries de 2024' },
    { type: 'Article', name: 'Interview avec Bryan Cranston' },
    { type: 'Episode', name: 'Breaking Bad S01E01' },
    { type: 'Episode', name: 'Game of Thrones S01E01' },
    { type: 'Sondage', name: 'Quelle est votre série préférée ?' },
    { type: 'Acteur', name: 'Bryan Cranston' },
    { type: 'Acteur', name: 'Emilia Clarke' }
];

searchButton.addEventListener('click', () => {
    const query = searchBar.value.toLowerCase();
    const filteredData = data.filter(item => item.name.toLowerCase().includes(query));

    resultsList.innerHTML = '';
    if (filteredData.length) {
        filteredData.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.type}: ${item.name}`;
            resultsList.appendChild(li);
        });
        resultsContainer.style.display = 'block';
    } else {
        const li = document.createElement('li');
        li.textContent = 'Aucun résultat trouvé';
        resultsList.appendChild(li);
        resultsContainer.style.display = 'block';
    }
});
    </script>
</body>
</html>