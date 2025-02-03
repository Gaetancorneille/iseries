<?php
session_start();
require 'database.php';
// Assurer que l'utilisateur est connecté
// Vérifie si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['user']);


$survey_id = $_GET['survey_id'] ?? null;
$user_id = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote_id'])) {
    $vote_id = $_POST['vote_id'];

    // Vérifier si l'utilisateur a déjà voté
    $stmt = $pdo->prepare("SELECT * FROM survey_votes WHERE user_id = ? AND survey_id = ?");
    $stmt->execute([$user_id, $survey_id]);
    $existing_vote = $stmt->fetch();

    if ($existing_vote) {
        // Mise à jour du vote existant
        $stmt = $pdo->prepare("UPDATE survey_votes SET vote_id = ? WHERE id = ?");
        $stmt->execute([$vote_id, $existing_vote['id']]);
    } else {
        // Insertion d'un nouveau vote
        $stmt = $pdo->prepare("INSERT INTO survey_votes (user_id, survey_id, vote_id) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $survey_id, $vote_id]);
    }

    // Mise à jour du nombre de votes pour l'option sélectionnée
    $stmt = $pdo->prepare("UPDATE survey_answers SET votes = votes + 1 WHERE id = ?");
    $stmt->execute([$vote_id]);

    // Réduction du nombre de votes pour l'ancienne option, le cas échéant
    if ($existing_vote) {
        $stmt = $pdo->prepare("UPDATE survey_answers SET votes = votes - 1 WHERE id = ?");
        $stmt->execute([$existing_vote['vote_id']]);
    }

    header("Location: sondages.php?survey_id=" . $survey_id);
    exit();
}

// Récupérer les réponses du sondage
$stmt = $pdo->prepare("SELECT * FROM survey_answers WHERE survey_id = ?");
$stmt->execute([$survey_id]);
$answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le total des votes
$stmt = $pdo->prepare("SELECT SUM(votes) AS total_votes FROM survey_answers WHERE survey_id = ?");
$stmt->execute([$survey_id]);
$total_votes = $stmt->fetchColumn();

// Récupérer la réponse dominante
$stmt = $pdo->prepare("SELECT id, MAX(votes) AS max_votes FROM survey_answers WHERE survey_id = ?");
$stmt->execute([$survey_id]);
$dominant_answer_id = $stmt->fetch()['id'];

// Récupérer les détails de la réponse dominante
$stmt = $pdo->prepare("SELECT * FROM survey_answers WHERE id = ?");
$stmt->execute([$dominant_answer_id]);
$dominant_answer = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sondage</title>
    <link rel="stylesheet" href="sond.css">
</head>
<body>
    <header>
        <!-- Votre en-tête ici -->
    </header>

    <main>
        <div class="survey-container">
            <h1>Résultats du sondage</h1>
            <form action="sondages.php?survey_id=<?php echo $survey_id; ?>" method="POST">
                <ul id="answers">
                    <?php foreach ($answers as $answer): ?>
                        <li>
                            <input type="radio" id="option_<?php echo $answer['id']; ?>" name="option_id" value="<?php echo $answer['id']; ?>" required>
                            <label for="option_<?php echo $answer['id']; ?>"><?php echo htmlspecialchars($answer['answer']); ?></label>
                            <span class="vote-count">
                                <?php
                                $vote_count = $answer['votes'];
                                $percentage = $total_votes ? round(($vote_count / $total_votes) * 100, 2) : 0;
                                echo "$vote_count votes ($percentage%)";
                                ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p>Total des votes : <span id="total-votes"><?php echo $total_votes; ?></span></p>
                <p>Réponse dominante : <span id="leading-answer"><?php echo htmlspecialchars($dominant_answer['answer']); ?></span></p>
                <button type="submit">Voter</button>
            </form>
        </div>
    </main>

    <footer>
        <!-- Votre pied de page ici -->
    </footer>
</body>
</html>
