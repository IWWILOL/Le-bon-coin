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
</head>
<body>
<div class="container mt-4">
    <h2>Mes annonces</h2>
    <?php foreach($annonces as $annonce): ?>
        <p> <?=$annonce['titre'] ?> </p>
        <p> <?=$annonce['prix'] ?>$</p>
        <p> <?=$annonce['etat'] ?> </p>
        <p> <?=$annonce['description'] ?> </p>
        <img src="uploads/<?= $annonce['image'] ?>" width="200"> 
        <hr>
    <?php endforeach; ?>    
</div>
</body>
</html>