<?php
session_start();
require '../db.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM annonces WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$annonce = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

    if (!$annonce) {
    die("Annonce introuvable.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
    background-image: url('https://i.pinimg.com/736x/37/7d/b6/377db6cea8ba77dc96fa49a4c9e08a15.jpg');
    background-size: cover;
    font-family: Arial, sans-serif;
}
</style>
<body>
<div class="container mt-4">
    <a href="mes-annonces.php" class="btn btn-secondary mb-3">← Retour</a>
    <div class="row">
        <div class="col-md-6">
            <img src="uploads/<?= htmlspecialchars($annonce['image']) ?>" class="rounded" style="width: 100%; height: 450px; object-fit: cover;">
        </div>
        <div class="col-md-6">
            <h2><?= htmlspecialchars($annonce['titre']) ?></h2>
            <h4 class="text-success"><?= htmlspecialchars($annonce['prix']) ?> €</h4>
            <p><strong>État :</strong> <?= htmlspecialchars($annonce['etat']) ?></p>
            <p><?= nl2br(htmlspecialchars($annonce['description'])) ?></p>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $annonce['user_id']): ?>
                <a href="modifier-annonce.php?id=<?= $annonce['id'] ?>" class="btn btn-warning">Modifier</a>
                <a href="supprimer-annonce.php?id=<?= $annonce['id'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer cette annonce ?')">Supprimer</a>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>