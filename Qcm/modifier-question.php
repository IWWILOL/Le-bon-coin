<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../Authentification/connexion.php');
    exit;
}
$erreur = '';
$id = $_GET['id'] ?? $_POST['id'] ?? null;
if (!$id) {
    header( 'location: admin_questions.php');
    exist;
 } 
 // Si le formulaire est envoyé (POST) donc on met à jour  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question      = $_POST['question'] ?? '';
    $reponse1      = $_POST['reponse1'] ?? '';
    $reponse2      = $_POST['reponse2'] ?? '';
    $reponse3      = $_POST['reponse3'] ?? '';
    $reponse4      = $_POST['reponse4'] ?? '';
    $bonne_reponse = $_POST['bonne_reponse'] ?? '';
    if ($question && $reponse1 && $reponse2 && $reponse3 && $reponse4 && $bonne_reponse) {
        $sql = "UPDATE questions
        SET question = ?, reponse1 = ?, reponse2 = ?, reponse3 = ?, reponse4 = ?, bonne_reponse = ?
                WHERE id = ?";
                $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssii", $question, $reponse1, $reponse2, $reponse3, $reponse4, $bonne_reponse, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('Location: admin_questions.php');
        exit;
    } else {
        $erreur = "Merci de remplir tous les champs.";
    }
}
//on va chercher la question existante pour pré-remplir le formulaire
$sql = "SELECT * FROM questions WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$q = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
if (!$q) {
    header ('Location: admin_questions.php');
    exist;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifier une question</title>
</head>
<body>
    <h1>Modifier la question</h1>
      <?php if ($erreur): ?>
        <p style="color:red;"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="post" action="modifier-question.php">
        <input type="hidden" name="id" value="<?= $q['id'] ?>">

        <label for="question">Question :</label>
        <textarea id="question" name="question" required><?= htmlspecialchars($q['question']) ?></textarea>

        <label for="reponse1">Réponse 1 :</label>
        <input type="text" id="reponse1" name="reponse1" value="<?= htmlspecialchars($q['reponse1']) ?>" required>

        <label for="reponse2">Réponse 2 :</label>
        <input type="text" id="reponse2" name="reponse2" value="<?= htmlspecialchars($q['reponse2']) ?>" required>

        <label for="reponse3">Réponse 3 :</label>
        <input type="text" id="reponse3" name="reponse3" value="<?= htmlspecialchars($q['reponse3']) ?>" required>

        <label for="reponse4">Réponse 4 :</label>
        <input type="text" id="reponse4" name="reponse4" value="<?= htmlspecialchars($q['reponse4']) ?>" required>

        <label for="bonne_reponse">Numéro de la bonne réponse (1 à 4) :</label>
        <input type="number" id="bonne_reponse" name="bonne_reponse" min="1" max="4" value="<?= $q['bonne_reponse'] ?>" required>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
