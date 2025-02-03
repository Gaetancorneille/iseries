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
    <title>Les Meilleurs Moments de Bones</title>
    <link rel="stylesheet" href=" Styles généraux .css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <h1>Les Meilleurs Moments de Bones</h1>
            <section class="overview">
                <h2>Aperçu de la série</h2>
                <p>Bones, la série télévisée créée par Hart Hanson, a captivé les téléspectateurs avec ses intrigues passionnantes, ses personnages attachants et son mélange unique de drame criminel et de comédie. Depuis sa première diffusion en 2005, la série a gagné une place spéciale dans le cœur des fans grâce à ses nombreux moments mémorables. Dans cet article, nous revisitons les meilleurs moments de Bones qui ont marqué les esprits et défini la série...</p>
            </section>
            <section class="synopsis">
                <h2>La Rencontre entre Brennan et Booth</h2>
                Le premier épisode de Bones introduit les deux personnages principaux, le Dr Temperance Brennan, une anthropologue légiste, et l'agent spécial Seeley Booth du FBI. Leur rencontre est un moment clé, marquant le début d'une relation professionnelle et personnelle qui évoluera au fil des saisons. La dynamique entre le scepticisme de Booth et le rationalisme de Brennan crée une alchimie fascinante, posant les bases d'une collaboration fructueuse et d'une amitié profonde.</p>
            </section>
            <section class="themes">
                <h2>L'Épisode "The Body in the Bag" (Saison 1, Épisode 1)</h2>
                <p>Le tout premier épisode, intitulé "The Body in the Bag", est un moment fort pour les fans de la série. Il présente non seulement le meurtre mystérieux, mais aussi la manière dont Brennan et Booth travaillent ensemble pour résoudre l'affaire. La scène où Brennan découvre le cadavre dans un sac est à la fois choquante et intrigante, établissant le ton pour les enquêtes complexes à venir.</p>
            </section>
            <section class="impact">
                <h2>La Déclaration de Booth</h2>
                <p>Au cours de la saison 4, l'épisode "The End in the Beginning" nous offre une scène émotive où Booth déclare ses sentiments pour Brennan. Ce moment marquant, dans lequel Booth exprime son désir de voir leur relation évoluer, est un tournant crucial dans leur relation et a laissé les fans en haleine. C’est un moment où les barrières entre eux commencent à se fissurer, laissant entrevoir un avenir plus personnel.</p>
            </section>
            <section class="revivals">
                <h2> Le Mariage de Angela et Hodgins</h2>
                <p>Le mariage d'Angela Montenegro et de Jack Hodgins est un autre moment mémorable de la série. L'épisode "The Wedding in the Funeral" (Saison 5, Épisode 16) est rempli de moments touchants et de surprises inattendues. Leur mariage est un témoignage de leur amour véritable, malgré les obstacles qu'ils ont affrontés. La cérémonie est un mélange parfait de romantisme et de humour, capturant l'essence de la série.</p>
            </section>
            <section class="revivals">
                <h2> La Naissance de Christine</h2>
                <p>La naissance de la fille de Booth et Brennan, Christine, est un événement significatif dans la série. L'épisode "The Doctor in the Den" (Saison 6, Épisode 1) marque ce moment joyeux et émouvant. La scène où Booth tient Christine dans ses bras pour la première fois est particulièrement émouvante et illustre la profondeur de son amour pour sa famille.</p>
            </section>
            <section class="revivals">
                <h2> La Résolution de l'Arche de l'Ennemi</h2>
                <p>L'arc narratif impliquant le "Gravedigger" (le fossoyeur) est l'un des plus captivants de la série. Dans l'épisode "The Hole in the Heart" (Saison 6, Épisode 22), la confrontation entre Booth et le Gravedigger atteint son paroxysme. La tension est à son comble lorsque Booth, accompagné de ses collègues, se lance dans une course contre la montre pour sauver une vie. La résolution de cette intrigue est un moment de haute intensité qui démontre la force du lien entre les personnages.</p>
            </section>
            <section class="revivals">
                <h2> Le Retour de Max Brennan</h2>
                <p>Le personnage de Max Brennan, le père de Temperance, joue un rôle important dans la série. Son retour dans l'épisode "The Blackout in the Blizzard" (Saison 7, Épisode 13) apporte une dimension émotionnelle supplémentaire. La complexité de la relation entre Brennan et son père est explorée, révélant des aspects plus profonds de sa personnalité et de son passé.</p>
            </section>
            <section class="revivals">
                <h2> L'Affrontement avec le Maître Espion</h2>
                <p>L'épisode "The Change in the Game" (Saison 6, Épisode 22) voit l'affrontement avec un maître espion, mettant en avant les compétences de Brennan en tant que détective et Booth en tant qu'agent du FBI. La scène finale de l'épisode, où la vérité est révélée, est pleine de suspense et d'émotion. C’est un exemple parfait de la manière dont la série combine habilement le drame criminel avec des moments intenses.</p>
            </section>
            <section class="revivals">
                <h2> Le Dernier Adieu</h2>
                <p>La série se termine avec une conclusion émouvante dans l'épisode "The Beginning in the End" (Saison 12, Épisode 12). Ce dernier épisode récapitule les moments clés de la série et permet aux fans de dire adieu à leurs personnages préférés. La fin est à la fois satisfaisante et poignante, offrant une conclusion réfléchie à l'histoire de Booth et Brennan.</p>
            </section>
            <section class="revivals">
                <h2> L'Évolution de la Relation entre Booth et Brennan</h2>
                <p>Au fil des saisons, la relation entre Booth et Brennan évolue considérablement. Les moments de tension, de complicité et d'amour entre eux sont les piliers de la série. Les scènes où ils commencent à reconnaître leurs sentiments l'un pour l'autre et à s'ouvrir aux vulnérabilités sont parmi les plus mémorables. Leur voyage ensemble est un témoignage de l'évolution de leur relation, allant de collègues à partenaires de vie.</p>
            </section>
            <section class="conclusion">
                <h2>Conclusion</h2>
                <p>Bones est une série qui a marqué les esprits avec ses moments inoubliables, ses intrigues captivantes et ses personnages profondément attachants. Les meilleurs moments de la série, de la première rencontre entre Brennan et Booth à la conclusion émouvante, illustrent la richesse et la profondeur de l'histoire. Ces moments emblématiques continueront à résonner avec les fans longtemps après la fin de la série, faisant de Bones un classique du genre criminel et dramatique.</p>
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
                <p><a href="https://t.me/OnceUponATime_VF/3">Télécharger Bones</a></p>
            </section>
            <section class="streaming-preview">
            <h2>Regardez Bones en ligne</h2>
            <div class="stream" onclick="window.location.href='streaming.php?series_id=11&user_id=<?php echo htmlspecialchars($user_id); ?>'">
                <img src="bones.jpg" alt="Streaming"style="max-width: 35%; height: auto;">
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
</body>
</html>
