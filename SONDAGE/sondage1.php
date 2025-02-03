<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Stocke l'URL de la page actuelle
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login - Copie.html'); // Redirige vers la page de connexion
    exit();
}

// Gérer les votes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedAnswer = $_POST['answer'];
    $sql = "UPDATE survey_answers SET votes = votes + 1 WHERE answer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedAnswer);
    $stmt->execute();
    $stmt->close();
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
</head>
<body>
    <header>
        <img src="logo-removebg-preview.png" alt="Site Logo" class="logo">
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
    <div class="survey-container">
        <h1><p id="question">C'est le temps des élections. Qui serait le meilleur président?</p></h1>
        <form id="vote-form" action="sondage1.php" method="post">
            <ul id="answers">
                <li><input type="radio" name="vote" value="1" data-option-id="1"> David Palmer (24h Chrono) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="2" data-option-id="2"> Fitzerald Thomas Grant III (Scandal) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="3" data-option-id="3"> Lyndon B. Johnson (All the Way) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="4" data-option-id="4"> Paul Kincaid (Hostages) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="5" data-option-id="5"> Jed Bartlet (A la Maison Blanche) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="6" data-option-id="6"> Elias Martinez (The Event) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="7" data-option-id="7"> Hunter Franklin (The Oval) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="8" data-option-id="8"> Caroline Reynolds (Prison Break) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="9" data-option-id="9"> Mellie Grant (Scandal) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="10" data-option-id="10"> Olivia Marsdin (Supergirl) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="11" data-option-id="11"> Claire Haas (Quantico) <span class="vote-count">0 votes</span></li>
                <li><input type="radio" name="vote" value="12" data-option-id="12"> Thomas Adam Kirkman (Designated Survivor) <span class="vote-count">0 votes</span></li>
            </ul>
            <button type="submit">Voter</button>
        </form>
        <p>Total des votes : <span id="total-votes">0</span></p>
        <p>Réponse dominante : <span id="leading-answer">Aucune pour le moment</span></p>
        <a href="sondage.html">Voir tous les sondages</a>
    </div>
    <script src="sonde.js"></script>
    <footer>
        <div class="footer-container">
            <div class="footer-menus">
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="article.html">Articles</a></li>
                    <li><a href="sondage.html">Sondages</a></li>
                    <li><a href="streaming.html">Streaming</a></li>
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
    
</body>
</html>