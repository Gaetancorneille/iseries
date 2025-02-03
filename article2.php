<?php
session_start(); // Démarre la session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
// Vérifie si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les secrets de Once Upon a Time</title>
    <link rel="stylesheet" href=" Styles généraux .css">
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
        <?php if ($isLoggedIn): ?>
            <li><a href="logout.php">Déconnexion</a></li>
        <?php else: ?>
            <li><a href="login - copie.html">Connexion</a></li>
            <li><a href="register.html">Inscription</a></li>
        <?php endif; ?>
    </ul>
</nav>
    <main>
        <article>
            <h1>Les secrets de Once Upon a Time</h1>
            <section class="overview">
                <h2>Aperçu de la série</h2>
                <p>"Once Upon a Time" est une série télévisée américaine de fantasy diffusée sur ABC de 2011 à 2018. Créée par Edward Kitsis et Adam Horowitz, la série réinvente des contes de fées classiques en les transposant dans le monde moderne, tout en maintenant des récits parallèles dans les royaumes enchantés. Elle suit les aventures d'Emma Swan et des habitants de Storybrooke, une petite ville du Maine où les personnages de contes de fées sont piégés sans souvenirs de leurs véritables identités.</p>
            </section>
<section class="synopsis">
                <h2>Synopsis et Contexte</h2>
                <p>La série commence avec Emma Swan, une chasseuse de primes à la vie solitaire, qui découvre qu'elle est la fille de Blanche-Neige et du Prince Charmant. Son fils biologique, Henry, qu'elle a abandonné dix ans auparavant, vient la chercher pour lui annoncer qu'elle est la seule capable de briser une malédiction jetée par la Méchante Reine, Regina, qui maintient tous les personnages de contes de fées dans le monde réel sans souvenirs de leur passé magique.</p>
                <p>À mesure que l'histoire progresse, les téléspectateurs découvrent des mondes parallèles et des réalités alternatives, mêlant les intrigues de divers contes de fées et légendes.</p>
            </section>
            <section class="cast">
                <h2>Acteurs Principaux</h2>
                <div class="actor">
                    <img src="emma.png" alt="Emma Swan">
                    <p>Jennifer Morrison (Emma Swan)</p>
                </div>
                <div class="actor">
                    <img src="regina.png" alt="Regina Mills">
                    <p>Lana Parrilla (Regina Mills/Evil Queen)</p>
                </div>
                <div class="actor">
                    <img src="henry.png" alt="Henry Mills">
                    <p>Jared S. Gilmore (Henry Mills)</p>
                </div>
                <div class="actor">
                    <img src="rumpel.png" alt="Mr. Gold">
                    <p>Robert Carlyle (Mr. Gold/Rumpelstilstkin)</p>
                </div>
            </section>
            <section class="cast">
                <h2>Acteurs Secondaires</h2>
                <div class="actor">
                    <img src="crochet.png" alt="Captain Hook">
                    <p>Colin O'Donoghue (Kylian Jones/Captain Hook)</p>
                </div>
                <div class="actor">
                    <img src="blanche.png" alt="Mary Margaret Blanchard">
                    <p>Ginnifer Goodwin (Mary Margaret Blanchard/Blanche Neige)</p>
                </div>
            </section>
            <section class="themes">
                <h2>Thèmes et Influence</h2>
                <p>"Once Upon a Time" explore de nombreux thèmes universels tels que l'amour, la rédemption, la quête de l'identité et la lutte entre le bien et le mal. La série puise son inspiration dans une multitude de sources, notamment les contes de fées des frères Grimm, les légendes arthuriennes, les mythologies grecque et nordique, et les classiques de Disney. Chaque épisode est riche en références culturelles, revisitant les histoires bien connues sous un angle nouveau et souvent plus sombre.</p>
            </section>
            <section class="impact">
                <h2>Impact Culturel</h2>
                <p>La série a eu un impact significatif sur la culture populaire, captivant une large audience grâce à sa réinvention créative des contes de fées. "Once Upon a Time" a contribué à revitaliser l'intérêt pour les récits de fantasy et a inspiré de nombreux autres médias à explorer des adaptations modernes de contes classiques. Les personnages emblématiques comme la Méchante Reine, Rumplestiltskin, et Hook sont devenus des figures cultes, suscitant une grande quantité de fanfictions, de cosplays et de discussions en ligne.</p>
            </section>
            <section class="revivals">
                <h2>Revivals et Réévaluations</h2>
                <p>Bien que "Once Upon a Time" ait pris fin en 2018, la série continue de susciter l'intérêt grâce aux plateformes de streaming, permettant à de nouvelles générations de téléspectateurs de découvrir l'univers enchanteur de Storybrooke. La série a été réévaluée au fil des ans, et certains critiques ont souligné la manière dont elle a traité des thèmes complexes et des personnages féminins forts. Des discussions ont également émergé concernant la diversité et la représentation dans la série, ouvrant la voie à des analyses plus nuancées de ses mérites et de ses défauts.</p>
            </section>
            <section class="conclusion">
                <h2>Conclusion</h2>
                <p>"Once Upon a Time" demeure une série emblématique qui a su redéfinir les contes de fées pour un public moderne. En mélangeant les intrigues classiques avec des éléments contemporains, la série a offert une vision unique et magique de récits bien-aimés. Son influence continue de se faire sentir dans la culture populaire, attestant de son succès et de son impact durable. Pour les fans de fantasy et de récits enchanteurs, "Once Upon a Time" reste une œuvre incontournable, riche en aventures et en émotions.</p>
            </section>
         <section class="trailer">
    <h2>Vidéo Trailer</h2>
    <video id="trailerVideo" controls poster="20230717_090239.jpg">
        <source src="Ndikhokhele_Bawo_-_Wits_Choir_2020_Welcome_Concert(240p).mp4" type="video/mp4">
        Votre navigateur ne supporte pas la lecture de vidéos.
        <a href="Ndikhokhele_Bawo_-_Wits_Choir_2020_Welcome_Concert(240p).mp4">Télécharger la vidéo ici.</a>
    </video>
</section>
            <section class="telegram">
                <h2>Télécharger via Telegram</h2>
                <p><a href="https://t.me/OnceUponATime_VF/3">Télécharger Once Upon A Time</a></p>
            </section>
            <section class="streaming-preview">
            <h2>Regardez Once Upon A Time en ligne</h2>
            <div class="stream" onclick="window.location.href='streaming.php?series_id=7&user_id=<?php echo htmlspecialchars($user_id); ?>'">
                <img src="Screenshot_20231017-210437.jpg" alt="Streaming">
                <h3>Découvrez les séries en streaming</h3>
            </div>
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
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const video = document.getElementById('trailerVideo');

        video.addEventListener('play', () => {
            console.log('La vidéo a commencé à être lue.');
        });

        video.addEventListener('ended', () => {
            console.log('La vidéo est terminée.');
        });
    });
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
