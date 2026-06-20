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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style-annonces.css">
    <title>Modifier une annonce</title>
</head>
<style>
    body {
    background-image: url('https://i.pinimg.com/736x/37/7d/b6/377db6cea8ba77dc96fa49a4c9e08a15.jpg');
    background-size: cover;
    font-family: Arial, sans-serif;
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
    <div class="container mt-4" style="max-width: 600px;">
   <h2>Modifier l'annonce</h2>
       <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="titre" class="form-control" value="<?= $annonce['titre'] ?>">
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" name="prix" class="form-control" value="<?= $annonce['prix'] ?>">
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
            <textarea name="description" class="form-control"><?= $annonce['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Image actuelle</label><br>
            <img src="uploads/<?= $annonce['image'] ?>" width="150" class="mb-2"><br>
            <label>Changer l'image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" name="modifier" class="btn btn-warning">Modifier</button>
        <a href="mes-annonces.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
