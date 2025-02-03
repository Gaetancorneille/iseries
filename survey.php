<?php
$conn = new mysqli('localhost', 'root', '', 'stage');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT title, content FROM articles WHERE id = '1'");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - iStart Séries-TV</title>
    <link rel="stylesheet" href="styleacceuil2.css">
</head>
<body>
    <header>
        <img src="logo-removebg-preview.png" alt="Site Logo" class="logo">
        <!-- Navigation and other header elements -->
    </header>
    <main>
        <article>
            <h1><?php echo htmlspecialchars($article['title']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
        </article>
    </main>
    <footer>
        <!-- Footer elements -->
    </footer>
</body>
</html>
