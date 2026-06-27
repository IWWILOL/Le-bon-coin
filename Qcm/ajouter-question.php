<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../Authentification/connexion.php');
    exit;
}
$erreur = '';
//la le formulaire est envoyer en POST 
if($_SERVER['REQUEST_METHOD']=== 'POST') {
    $question     = $_POST['question'] ?? '';
    $reponse1     = $_POST['reponse1'] ?? '';
    $reponse2     = $_POST['reponse2'] ?? '';
    $reponse3     = $_POST['reponse3'] ?? '';
    $reponse4     = $_POST['reponse4'] ?? '';
    $bonne_reponse = $_POST['bonne_reponse'] ?? '';
 if ($question && $reponse1 && $reponse2 && $reponse3 && $reponse4 && $bonne_reponse) {
        $sql = "INSERT INTO questions (question, reponse1, reponse2, reponse3, reponse4, bonne_reponse)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $question, $reponse1, $reponse2, $reponse3, $reponse4, $bonne_reponse);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('Location: admin_questions.php');
        exit;
    } else {
        $erreur = "Merci de remplir tous les champs.";
    }
}
   
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une question</title>
</head>
<body>
    <h1>Ajouter une question</h1>
    <?php if ($erreur): ?>
        <p style="color:red;"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="post" action="ajouter-question.php">
        <label for="question">Question :</label>
        <textarea id="question" name="question" required></textarea>

        <label for="reponse1">Réponse 1 :</label>
        <input type="text" id="reponse1" name="reponse1" required>

        <label for="reponse2">Réponse 2 :</label>
        <input type="text" id="reponse2" name="reponse2" required>

        <label for="reponse3">Réponse 3 :</label>
        <input type="text" id="reponse3" name="reponse3" required>

        <label for="reponse4">Réponse 4 :</label>
        <input type="text" id="reponse4" name="reponse4" required>

        <label for="bonne_reponse">Numéro de la bonne réponse (1 à 4) :</label>
        <input type="number" id="bonne_reponse" name="bonne_reponse" min="1" max="4" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>