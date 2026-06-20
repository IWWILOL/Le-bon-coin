<?php
require 'connexion.php';
$stmt = $pdo->prepare("SELECT * FROM annonces ORDER BY created_at DESC");
$stmt->execute();
$annonces = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Dernières annonces</h2>
    <div class="row">
    <?php foreach($annonces as $annonce): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="uploads/<?= $annonce['image'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title"><?= $annonce['titre'] ?></h5>
                    <p class="card-text"><?= $annonce['description'] ?></p>
                    <p><strong><?= $annonce['prix'] ?> €</strong> — <?= $annonce['etat'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
</body>
</html>