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

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/uploads/' . $image);
    } else {
        $image = $annonce['image'];
    }

    $stmt = $pdo->prepare("UPDATE annonces SET titre = ?, prix = ?, etat = ?, description = ?, image = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$titre, $prix, $etat, $description, $image, $id, $_SESSION['user_id']]);

    header('Location: mes-annonces.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier une annonce</title>
</head>
<body>
<h2>Modifier l'annonce</h2>
<form action="" method="POST" enctype="multipart/form-data">
    <label>Titre</label>
    <input type="text" name="titre" value="<?= $annonce['titre'] ?>">
    <br>
    <label>Prix</label>
    <input type="number" name="prix" value="<?= $annonce['prix'] ?>">
    <br>
    <label>État</label>
    <select name="etat">
        <option value="neuf" <?= $annonce['etat'] == 'neuf' ? 'selected' : '' ?>>Neuf</option>
        <option value="bon etat" <?= $annonce['etat'] == 'bon etat' ? 'selected' : '' ?>>Bon état</option>
        <option value="correct" <?= $annonce['etat'] == 'correct' ? 'selected' : '' ?>>Correct</option>
    </select>
    <br>
    <label>Description</label>
    <textarea name="description"><?= $annonce['description'] ?></textarea>
    <br>
    <label>Image actuelle</label><br>
    <img src="uploads/<?= $annonce['image'] ?>" width="150"><br>
    <label>Changer l'image</label>
    <input type="file" name="image" accept="image/*">
    <br>
    <button type="submit" name="modifier">Modifier</button>
    <a href="mes-annonces.php">Annuler</a>
</form>
</body>
</html>