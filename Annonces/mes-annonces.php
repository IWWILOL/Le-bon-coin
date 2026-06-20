<?php
 session_start();
 $_SESSION['user_id'] = 1;
 require 'connexion.php';
 $stmt=$pdo->prepare("SELECT * FROM annonces WHERE user_id=?");
 $stmt->execute([$_SESSION['user_id']]);
 $annonces=$stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style-annonces.css">
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
</style>
<body>
<div class="container mt-4">
    <h2>Mes annonces</h2>
    <div class="row">
<?php foreach($annonces as $annonce): ?>
   <div class="col-md-4 mb-4">
        <div class="card h-100" onclick="window.location='annonce.php?id=<?= $annonce['id'] ?>'" style="cursor:pointer;">
            <img src="uploads/<?= $annonce['image'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
            <div class="card-body">
                <h5 class="card-title"><?= $annonce['titre'] ?></h5>
                <p class="card-text"><?= $annonce['description'] ?></p>
                <p><strong><?= $annonce['prix'] ?> € </strong> </p>
                <p><strong><?= $annonce['etat'] ?></strong></p>
             </div>
              <div class="card-footer d-flex justify-content-between" onclick="event.stopPropagation()">
                <a href="modifier-annonce.php?id=<?= $annonce['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                <a href="supprimer-annonce.php?id=<?= $annonce['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette annonce ?')">Supprimer</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>