<?php
session_start();
require '../db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Authentification/connexion.php');
    exit;
}
$reponses_user = $_POST['reponse'];
$score = 0;
foreach ($reponses_user as $question_id => $reponse_utilisateur) {
    $sql = "SELECT bonne_reponse FROM questions WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $question_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $question = mysqli_fetch_assoc($result);
    if ($reponse_utilisateur == $question['bonne_reponse']) {
        $score++;
    }
}
$note = $score * 2;
$stmt = mysqli_prepare($conn, "INSERT INTO tentatives (utilisateur_id, score) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "id", $_SESSION['user_id'], $note);
mysqli_stmt_execute($stmt);
$tentative_id = mysqli_insert_id($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Résultats</title>
</head>
<style>
body {
    background-image: url('https://i.pinimg.com/736x/37/7d/b6/377db6cea8ba77dc96fa49a4c9e08a15.jpg');
    background-size: cover;
    font-family: Arial, sans-serif;
}
h2 {
    color: #993556;
}
.container {
    background-color: pink;
    border-radius: 16px;
    padding: 30px;
}
label {
    color: #993556;
    font-weight: bold;
}
.form-control {
    border: 1px solid #D4537E;
    border-radius: 10px;
}

.form-control:focus {
    border-color: #993556;
    outline: none;
    box-shadow: none;
}
</style>
<body>
    <h1>Vos résultats</h1>
    <h2>Note : <?php echo $note; ?> / 20</h2>
    <p>Bonnes réponses : <?php echo $score; ?> / 10</p>
    






    <h3>Questions incorrectes :</h3>
<?php foreach ($reponses_user as $question_id => $reponse_utilisateur): ?>
    <?php
    $sql = "SELECT * FROM questions WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $question_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $question = mysqli_fetch_assoc($result);
    if ($reponse_utilisateur != $question['bonne_reponse']):
    ?>
        <div>
            <p><strong>Question :</strong> <?php echo htmlspecialchars($question['question']); ?></p>
            <p>Votre réponse : <?php echo htmlspecialchars($reponse_utilisateur); ?></p>
            <p>Bonne réponse : <?php echo htmlspecialchars/*la ligne qui affiche le texte de la bonne réponse */($question['reponse' . $question['bonne_reponse']]); ?></p>
        </div>
    <?php endif; ?>
<?php endforeach; ?> 
<?php if ($note >= 10): 
    if ($note >= 10) {
    $_SESSION['qcm_reussi'] = true;
}?>
    <p>Félicitations ! Vous avez réussi le QCM. Vous pouvez maintenant publier votre annonce.</p>
    <a href="../index.php" class="btn btn-sm mb-3" style="background-color: #993556; color: white;">Publier mon annonce</a>
<?php else: ?>
    <p>Vous n'avez pas la moyenne. Repassez le QCM !</p>
    <a href="qcm.php" class="btn btn-sm mb-3" style="background-color: #993556; color: white;">Repasser le QCM</a>
<?php endif; ?>
</body>
</html>