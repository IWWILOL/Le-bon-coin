<?php

session_start();

require '../db.php';


if (!isset($_SESSION['user_id'])) {

header('Location: ../Authentification/connexion.php');

exit;

}


$user_id = $_SESSION['user_id'];


$stmt = mysqli_prepare($conn, "

SELECT m.annonce_id, m.expediteur_id, m.destinataire_id, m.contenu, m.created_at,

a.titre AS annonce_titre,

eu.nom AS expediteur_nom, du.nom AS destinataire_nom

FROM messages m

JOIN annonces a ON m.annonce_id = a.id

JOIN users eu ON m.expediteur_id = eu.id

JOIN users du ON m.destinataire_id = du.id

WHERE m.expediteur_id = ? OR m.destinataire_id = ?

ORDER BY m.created_at DESC

");

mysqli_stmt_bind_param($stmt, "ii", $user_id, $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$tousLesMessages = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_stmt_close($stmt);


// Regrouper par fil de discussion (1 fil = 1 annonce + 1 autre utilisateur)

$discussions = [];

foreach ($tousLesMessages as $msg) {

$autreId = ($msg['expediteur_id'] == $user_id) ? $msg['destinataire_id'] : $msg['expediteur_id'];

$autreNom = ($msg['expediteur_id'] == $user_id) ? $msg['destinataire_nom'] : $msg['expediteur_nom'];

$cle = $msg['annonce_id'] . '-' . $autreId;

if (!isset($discussions[$cle])) {

$discussions[$cle] = [

'annonce_id' => $msg['annonce_id'],

'annonce_titre' => $msg['annonce_titre'],

'autre_id' => $autreId,

'autre_nom' => $autreNom,

'dernier_message' => $msg['contenu'],

'date' => $msg['created_at'],

];

}

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

h2 {

color: #993556;

}

.list-group-item:hover {

background-color: #FBEAF0;

}

</style>

<body>

<div class="container mt-4">

<h2>Mes discussions</h2>


<?php if (empty($discussions)): ?>

<p>Aucune discussion pour le moment. Contactez un vendeur depuis une annonce pour dÃƒÂ©marrer une conversation.</p>

<?php endif; ?>


<div class="list-group">

<?php foreach ($discussions as $d): ?>

<a href="discussion.php?annonce_id=<?= (int) $d['annonce_id'] ?>&user_id=<?= (int) $d['autre_id'] ?>"

class="list-group-item list-group-item-action">

<div class="d-flex justify-content-between">

<strong><?= htmlspecialchars($d['annonce_titre']) ?></strong>

<small><?= htmlspecialchars($d['date']) ?></small>

</div>

<div>Avec : <?= htmlspecialchars($d['autre_nom']) ?></div>

<div class="text-muted text-truncate"><?= htmlspecialchars($d['dernier_message']) ?></div>

</a>

<?php endforeach; ?>

</div>

</div>

</body>

</html>