<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "istart_series_tv";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$survey_id = 1; // ID du sondage dont vous voulez afficher les résultats

// Récupérer le sondage et les options avec les votes
$surveyQuery = "SELECT * FROM surveys WHERE id='$survey_id'";
$surveyResult = $conn->query($surveyQuery);
$survey = $surveyResult->fetch_assoc();

$optionsQuery = "SELECT * FROM survey_options WHERE survey_id='$survey_id'";
$optionsResult = $conn->query($optionsQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Résultats du sondage - iStart Séries TV</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Résultats du sondage: <?php echo $survey['question']; ?></h2>
        <table>
            <tr>
                <th>Option</th>
                <th>Votes</th>
            </tr>
            <?php while($option = $optionsResult->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $option['option_text']; ?></td>
                    <td><?php echo $option['votes']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
