<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../Authentification/connexion.php');
    exit;
}
$sql ="SELECT id, question, reponse1, reponse2, reponse3, reponse4,
reponse4, bonne_reponse FROM questions ORDER BY id DESC ";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des questions</title>
</head>
<body>
     <h1>Gestion des questions</h1>

    <p><a href="ajouter-question.php">+ Ajouter une question</a></p>

    <table class="table-styled">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Réponse 1</th>
                <th>Réponse 2</th>
                <th>Réponse 3</th>
                <th>Réponse 4</th>
                <th>Bonne réponse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($q = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $q['id'] ?></td>
                    <td><?= htmlspecialchars($q['question']) ?></td>
                    <td><?= htmlspecialchars($q['reponse1']) ?></td>
                    <td><?= htmlspecialchars($q['reponse2']) ?></td>
                    <td><?= htmlspecialchars($q['reponse3']) ?></td>
                    <td><?= htmlspecialchars($q['reponse4']) ?></td>
                    <td>Réponse <?= $q['bonne_reponse'] ?></td>
                    <td>
                        <a href="modifier-question.php?id=<?= $q['id'] ?>">Modifier</a>
                        |
                        <a href="supprimer-question.php?id=<?= $q['id'] ?>" onclick="return confirm('Supprimer cette question ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>