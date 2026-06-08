<?php
session_start();
$_SESSION['user_id'] = 1;
require 'connexion.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM annonces WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$annonce = $stmt->fetch();

if (isset($_POST['modifier'])) {
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $etat = $_POST['etat'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE annonces SET titre = ?, prix = ?, etat = ?, description = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$titre, $prix, $etat, $description, $id, $_SESSION['user_id']]);

    header('Location: mes-annonces.php');
    exit;
}
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
    <h2>Modifier l'annonce</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($annonce['titre']) ?>">
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" name="prix" class="form-control" value="<?= htmlspecialchars($annonce['prix']) ?>">
        </div>
        <div class="mb-3">
            <label>État</label>
            <select name="etat" class="form-control">
                <option value="neuf" <?= $annonce['etat'] == 'neuf' ? 'selected' : '' ?>>Neuf</option>
                <option value="bon etat" <?= $annonce['etat'] == 'bon etat' ? 'selected' : '' ?>>Bon état</option>
                <option value="correct" <?= $annonce['etat'] == 'correct' ? 'selected' : '' ?>>Correct</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"><?= htmlspecialchars($annonce['description']) ?></textarea>
        </div>
        <button type="submit" name="modifier" class="btn btn-warning">Modifier</button>
    </form>
</div>
</body>
</html>