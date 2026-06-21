<?php

session_start();

require '../db.php';


if (!isset($_SESSION['user_id'])) {

header('Location: ../Authentification/connexion.php');

exit;

}


$user_id = $_SESSION['user_id'];


// Ajouter une annonce aux favoris (depuis annonce.php par ex.)

if (isset($_GET['ajouter'])) {

$annonce_id = (int) $_GET['ajouter'];

$stmt = mysqli_prepare($conn, "INSERT IGNORE INTO favoris (user_id, annonce_id) VALUES (?, ?)");

mysqli_stmt_bind_param($stmt, "ii", $user_id, $annonce_id);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header('Location: favoris.php');

exit;

}


// Retirer une annonce des favoris

if (isset($_GET['retirer'])) {

$annonce_id = (int) $_GET['retirer'];

$stmt = mysqli_prepare($conn, "DELETE FROM favoris WHERE user_id = ? AND annonce_id = ?");

mysqli_stmt_bind_param($stmt, "ii", $user_id, $annonce_id);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header('Location: favoris.php');

exit;

}


// Liste des favoris de l'utilisateur connectÃƒÂ©

$stmt = mysqli_prepare($conn, "

SELECT annonces.id, annonces.titre, annonces.prix, annonces.etat, annonces.image

FROM favoris

JOIN annonces ON favoris.annonce_id = annonces.id

WHERE favoris.user_id = ?

ORDER BY favoris.id DESC

");

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$favoris = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_stmt_close($stmt);

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

h2 {

color: #993556;

}

</style>

<body>

<div class="container mt-4">

<h2>Mes favoris</h2>


<?php if (empty($favoris)): ?>

<p>Vous n'avez pas encore d'annonce en favoris.</p>

<?php endif; ?>


<div class="row">

<?php foreach ($favoris as $annonce): ?>

<div class="col-md-4 mb-4">

<div class="card h-100">

<a href="../Annonces/annonce.php?id=<?= (int) $annonce['id'] ?>">

<img src="../Annonces/uploads/<?= htmlspecialchars($annonce['image']) ?>" class="card-img-top" style="height:200px; object-fit:cover;">

</a>

<div class="card-body">

<h5 class="card-title"><?= htmlspecialchars($annonce['titre']) ?></h5>

<p><strong><?= htmlspecialchars($annonce['prix']) ?> Ã¢Â‚Â¬</strong></p>

<p><?= htmlspecialchars($annonce['etat']) ?></p>

</div>

<div class="card-footer">

<a href="favoris.php?retirer=<?= (int) $annonce['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Retirer cette annonce des favoris ?')">Retirer des favoris</a>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</body>

</html>