<?php
 session_start();
 $_SESSION['user_id'] = 1;
 require 'connexion.php';
 $stmt=$pdo->prepare("SELECT * FROM annonces WHERE user_id=?");
 $stmt->execute([$_SESSION['user_id']]);
 $_annonces=$stmt->fetchAll();
?>
<?php require 'header.php'; ?>

<div class="container mt-4">
    <h2>Mes annonces</h2>
    <?php foreach($annonces as $annonce): ?>
        <p> <?=$annonce['titre'] ?> </p>
        <p> <?=$annonce['prix'] ?>$</p>
        <p> <?=$annonce['etat'] ?> </p>
        <p> <?=$annonce['description'] ?> </p>
        <img src="uploads/<?= $annonce['image'] ?>">
    <?php endforeach; ?>    
</div>
<?php require 'footer.php'; ?>