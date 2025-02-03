<?php
session_start(); // Démarre la session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
// Vérifie si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - iStart Séries TV</title>
    <link rel="stylesheet" href="article.css">
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
            <li><i class="fas fa-poll"></i><a href="sondage - Copie.html">Sondage</a></li>
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
        <section class="site-description">
            <h1>Découvrez nos articles</h1>
        </section>
        <section class="hot-news">
            <h2>Actualités sur les séries</h2>
            <div class="news-container">
                <article>
                    <img src="Screenshot_20231017-211543.jpg" alt="News Image 1">
                    <h3>Mercredi le phénomène culte revient bientot!</h3>
                    <p>Il semblerait que la plateforme de streaming au N rouge ait programmé une deuxième saison pour la série Mercredi pour le plus grand bonheur des internautes.</p>
                    <a href="articlemercredi.html">Lire la suite</a>
                </article>
                <article>
                    <img src="20240208_102901.jpg" alt="News Image 2">
                    <h3>Sweet Magnolias: Une suite trop lointaine?</h3>
                    <p>La série feel good </p>
                <a href="al'ombredesmagnolias.html">Lire la suite</a>
                </article>
                <article>
                    <img src="20240208_102925.jpg" alt="News Image 3">
                    <h3>Dynastie le remake un triomphe sur NETFLIX</h3>
                    <p>Ca fait déjà quelques années que la série est disponible sur la plateforme de streaminhg...</p>
                <a href="articledynatie.html">Lire la suite</a>
                </article>
            </div>
        </section>
        <section class="article-previews">
            <h2>Analyses et Critiques</h2>
            <div class="article-container">
                <div class="article">
                    <img src="charmed.png" alt="Image de l'article 1">
                    <div class="article-content">
                        <h3>Analyse de Charmed</h3>
                        <p>"Charmed" est une série télévisée américaine fantastique créée par Constance M. Burge et diffusée pour la première fois le 7 octobre 1998 sur The WB. La série a connu un grand succès et s'est poursuivie pendant huit saisons jusqu'au 21 mai 2006. "Charmed" raconte l'histoire de trois sœurs – Prue, Piper et Phoebe Halliwell – qui découvrent qu'elles sont des sorcières dotées de pouvoirs magiques. Ensemble, elles forment le "Pouvoir des Trois" et utilisent leurs dons pour combattre les forces du mal.</p>
                        <a href="article1.html">Lire la suite</a>
                    </div>
                </div>
                <div class="article">
                    <img src="onceuponatime.png" alt="Image de l'article 2">
                    <div class="article-content">
                        <h3>Les secrets de Once Upon a Time</h3>
                        <p>"Once Upon a Time" est une série télévisée américaine de fantasy diffusée sur ABC de 2011 à 2018. Créée par Edward Kitsis et Adam Horowitz, la série réinvente des contes de fées classiques en les transposant dans le monde moderne, tout en maintenant des récits parallèles dans les royaumes enchantés. Elle suit les aventures d'Emma Swan et des habitants de Storybrooke, une petite ville du Maine où les personnages de contes de fées sont piégés sans souvenirs de leurs véritables identités.</p>
                        <a href="article2.html">Lire la suite</a>
                    </div>
                </div>
                <div class="article">
                    <img src="Madamemonsieur.jpg" alt="Image de l'article 2">
                    <div class="article-content">
                        <h3>Madame...Monsieur: Quand le drame urbain rencontre la réalité Camerounaise</h3>
                        <p>Madame Monsieur est une série télévisée africaine créée par Ebenezer Kepombia. Actuellement dans sa troisième saison, la série raconte les aventures et mésaventures des personnages dans leur quotidien, mêlant drame, comédie et romance.

La série se distingue par la richesse de ses personnages et la complexité de leurs relations. Chaque personnage apporte une dimension unique à l'intrigue, qu'il s'agisse des conflits familiaux, des histoires d'amour tumultueuses ou des défis professionnels. Les costumes colorés et les décors authentiques ajoutent une touche de réalisme et d'attrait visuel à la série, captivant les spectateurs à chaque épisode.
</p>
                        <a href="article3.html">Lire la suite</a>
                    </div>
                </div>
                <div class="article">
                    <img src="Screenshot_20231017-210654.jpg" alt="Image de l'article 2">
                    <div class="article-content">
                        <h3>Les meilleurs moments de Bones</h3>
                        <p>Bones est une série télévisée américaine qui mélange les genres policier et comédie dramatique. Créée par Hart Hanson, elle est inspirée des romans de Kathy Reichs, une anthropologue judiciaire. La série suit le Dr Temperance Brennan, une anthropologue judiciaire brillante mais socialement maladroite, interprétée par Emily Deschanel, et son partenaire, l'agent spécial du FBI Seeley Booth, joué par David Boreanaz. Ensemble, ils résolvent des enquêtes criminelles complexes en analysant des restes humains. Bones est appréciée pour ses intrigues captivantes, son humour subtil, et la chimie entre les personnages principaux. La série a duré douze saisons, de 2005 à 2017.</p>
                        <a href="article4.html">Lire la suite</a>
                    </div>
                </div>
                <div class="article">
                    <img src="Screenshot_20231017-211345.jpg" alt="Image de l'article 2">
                    <div class="article-content">
                        <h3>Suits: Avocats sur Mesure</h3>
                        <p>Suits est une série télévisée américaine créée par Aaron Korsh. Diffusée de 2011 à 2019, elle se déroule principalement dans un cabinet d'avocats prestigieux à New York. La série suit Mike Ross, un jeune homme brillant mais sans diplôme en droit, interprété par Patrick J. Adams, qui parvient à travailler comme associé pour Harvey Specter, un avocat talentueux et charismatique joué par Gabriel Macht. Ensemble, ils naviguent dans des affaires juridiques complexes tout en essayant de maintenir le secret de Mike. Suits est connue pour ses dialogues incisifs, ses intrigues captivantes, et la dynamique entre ses personnages principaux, incluant Meghan Markle et Sarah Rafferty.</p>
                        <a href="article4.html">Lire la suite</a>
                    </div>
                </div>
                <div class="article">
                    <img src="Screenshot_20231017-210531.jpg" alt="Image de l'article 2">
                    <div class="article-content">
                        <h3>Les moments inoubliables de Friends</h3>
                        <p>Friends est une série télévisée américaine créée par David Crane et Marta Kauffman. Diffusée de 1994 à 2004, elle suit la vie de six amis vivant à New York : Rachel, Ross, Monica, Chandler, Joey et Phoebe. Interprétés respectivement par Jennifer Aniston, David Schwimmer, Courteney Cox, Matthew Perry, Matt LeBlanc et Lisa Kudrow, ces personnages évoluent à travers leurs relations amoureuses, professionnelles, et personnelles. Friends est acclamée pour son humour, ses situations comiques et la chimie entre ses acteurs. La série est devenue un phénomène culturel, influençant des générations de téléspectateurs et restant populaire même après des décennies.</p>
                        <a href="article6.html">Lire la suite</a>
                    </div>
                </div>
                <div class="article">
                    <img src="ma grande famille.jpg" alt="Image de l'article 2">
                    <div class="article-content">
                        <h3>Ma Grande Famille: Un  portrait authentique de la vie quotidienne en Côte d'Ivoire</h3>
                        <p>Ma Grande Famille est une série télévisée ivoirienne créée par Akissi Delta. Diffusée à partir de 2002, elle est devenue très populaire en Côte d'Ivoire et dans toute l'Afrique francophone. La série dépeint les aventures et les mésaventures de plusieurs familles vivant ensemble dans une grande maison, explorant des thèmes comme les relations familiales, les conflits de génération, et les défis de la vie quotidienne. Les personnages sont divers et colorés, reflétant la richesse culturelle ivoirienne. Avec son humour, ses intrigues captivantes, et ses situations réalistes, Ma Grande Famille a marqué les esprits et reste un classique de la télévision africaine.</p>
                        <a href="article7.html">Lire la suite</a>
                    </div>
                </div>

            </div>
        </section>
    </main>
    
    <footer>
        <div class="footer-container">
            <div class="footer-menus">
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="article.html">Articles</a></li>
                    <li><a href="sondage.html">Sondages</a></li>
                    <li><a href="streaming.html">Streaming</a></li>
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
    
    <script src="script.js"></script>
</body>
</html>