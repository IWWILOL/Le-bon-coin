<?php
session_start();
require "../db.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Authentification/connexion.php");
    exit();
}
$user_id = $_SESSION['user_id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM tentatives WHERE utilisateur_id = ? ORDER BY id ASC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$tentatives = mysqli_fetch_all($result, MYSQLI_ASSOC);

$stmt2 = mysqli_prepare($conn, "SELECT AVG(score) AS moyenne FROM tentatives WHERE utilisateur_id = ?");
mysqli_stmt_bind_param($stmt2, "i", $user_id);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$moyenne = mysqli_fetch_assoc($result2)['moyenne'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique QCM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://i.pinimg.com/736x/37/7d/b6/377db6cea8ba77dc96fa49a4c9e08a15.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        h1, h2 { color: #993556; }
        .container { background-color: pink; border-radius: 16px; padding: 30px; }
        thead { background-color: #993556; color: white; }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Historique de mes QCM</h1>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Tentative</th>
                <th>Date</th>
                <th>Score</th>
                <th>Résultat</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($tentatives as $index => $tentative): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $tentative['date'] ?></td>
                <td><?= $tentative['score'] ?>/20</td>
                <td>
                    <?php if($tentative['score'] >= 10): ?>
                        <span class="badge bg-success">Réussi</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Échoué</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Moyenne générale : <?= round($moyenne, 2) ?>/20</h2>
    <a href="../index.php" class="btn btn-sm mt-2" style="background-color: #993556; color: white;">Retour à l'accueil</a>
</div>
</body>
</html>