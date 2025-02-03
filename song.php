<?php
session_start();

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

// Récupérer les paramètres depuis l'URL
$surveyId = isset($_GET['survey_id']) ? intval($_GET['survey_id']) : null;
$userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;

// Vérifier que les paramètres sont valides
if ($surveyId === null || $userId === null) {
}

// Traitement du vote
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer_id'])) {
    $answerId = intval($_POST['answer_id']);

    // Vérifier si l'option_id existe
    $sql = 'SELECT COUNT(*) FROM survey_answers WHERE id = ? AND survey_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$answerId, $surveyId]);
    $optionExists = $stmt->fetchColumn();

    if (!$optionExists) {
        
    }

    // Vérifier si l'utilisateur a déjà voté pour ce sondage
    $sql = 'SELECT COUNT(*) FROM survey_votes WHERE survey_id = ? AND user_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$surveyId, $userId]);
    $existingVote = $stmt->fetchColumn();

    if ($existingVote > 0) {
        // Mettre à jour le vote existant
        $sql = 'UPDATE survey_votes SET option_id = ? WHERE survey_id = ? AND user_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$answerId, $surveyId, $userId]);
    } else {
        // Ajouter un nouveau vote
        $sql = 'INSERT INTO survey_votes (user_id, survey_id, vote_id) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $surveyId, $answerId]);
    }

    // Rediriger pour éviter le double envoi du formulaire
    header('Location: sondage.php?survey_id=' . $surveyId . '&user_id=' . $userId);
    exit();
}

// Récupérer la question du sondage
$sql = 'SELECT question FROM surveys WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$surveyId]);
$survey = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer les réponses du sondage
$sql = 'SELECT * FROM survey_answers WHERE survey_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$surveyId]);
$answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les votes de l'utilisateur
$sql = 'SELECT option_id FROM survey_votes WHERE survey_id = ? AND user_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$surveyId, $userId]);
$userVotes = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Récupère une colonne dans un tableau

// Traitement des votes pour chaque réponse
$votesCount = [];
foreach ($answers as $answer) {
    $optionId = $answer['id'];
    
    $sql = 'SELECT COUNT(*) FROM survey_votes WHERE survey_id = ? AND option_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$surveyId, $optionId]);
    $votesCount[$optionId] = $stmt->fetchColumn();
}

$totalVotes = array_sum($votesCount);

// Trouver la réponse dominante
$leadingOptionId = array_keys($votesCount, max($votesCount));
$leadingOption = null;
foreach ($answers as $answer) {
    if (in_array($answer['id'], $leadingOptionId)) {
        $leadingOption = $answer;
        break;
    }
}
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
        <h1>Résultats du sondage</h1>
    </header>
    <main>
        <div class="survey-container">
            <?php if ($survey): ?>
                <h2><?php echo htmlspecialchars($survey['question']); ?></h2>
            <?php else: ?>
                <p>Question du sondage non trouvée.</p>
            <?php endif; ?>

            <form method="post" action="song.php">
                <ul id="answers">
                    <?php foreach ($answers as $answer): ?>
                        <?php
                            $optionId = $answer['id'];
                            $votes = isset($votesCount[$optionId]) ? $votesCount[$optionId] : 0;
                            $percentage = $totalVotes > 0 ? ($votes / $totalVotes) * 100 : 0;
                        ?>
                        <li>
                            <input type="radio" id="option-<?php echo $optionId; ?>" name="answer_id" value="<?php echo $optionId; ?>" <?php echo in_array($optionId, $userVotes) ? 'checked' : ''; ?>>
                            <label for="option-<?php echo $optionId; ?>"><?php echo htmlspecialchars($answer['answer']); ?></label>
                            <span class="vote-count"><?php echo $votes; ?> votes (<?php echo round($percentage, 2); ?>%)</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <input type="submit" value="Voter">
            </form>

            <p>Total des votes : <span id="total-votes"><?php echo $totalVotes; ?></span></p>
            <p>Réponse dominante : <span id="leading-answer"><?php echo $leadingOption ? htmlspecialchars($leadingOption['answer']) : 'Aucune pour le moment'; ?></span></p>
        </div>
    </main>
    <footer>
        <a href="deconnexion.php">Déconnexion</a>
    </footer>
</body>
</html>
