<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Authentification/connexion.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$annonce_id = (int) ($_GET['annonce_id'] ?? 0);
$autre_id = (int) ($_GET['user_id'] ?? 0);

// Envoyer un nouveau message
if (isset($_POST['envoyer'])) {
    $contenu = trim($_POST['contenu']);
    if ($contenu !== '' && $annonce_id > 0 && $autre_id > 0 && $autre_id !== $user_id) {
        $stmt = mysqli_prepare($conn, "INSERT INTO messages (annonce_id, expediteur_id, destinataire_id, contenu) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iiis", $annonce_id, $user_id, $autre_id, $contenu);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: discussion.php?annonce_id=$annonce_id&user_id=$autre_id");
    exit;
}

// Infos de l'annonce concernée
$stmt = mysqli_prepare($conn, "SELECT titre FROM annonces WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $annonce_id);
mysqli_stmt_execute($stmt);
$annonceInfo = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

// Infos de l'autre utilisateur
$stmt = mysqli_prepare($conn, "SELECT nom FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $autre_id);
mysqli_stmt_execute($stmt);
$autreInfo = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$annonceInfo || !$autreInfo) {
    die("Discussion introuvable.");
}

// Tous les messages de ce fil (cette annonce, entre ces deux utilisateurs précisément)
$stmt = mysqli_prepare($conn, "
    SELECT * FROM messages
    WHERE annonce_id = ?
    AND ((expediteur_id = ? AND destinataire_id = ?) OR (expediteur_id = ? AND destinataire_id = ?))
    ORDER BY created_at ASC
");
mysqli_stmt_bind_param($stmt, "iiiii", $annonce_id, $user_id, $autre_id, $autre_id, $user_id);
mysqli_stmt_execute($stmt);
$messages = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
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
h2 { color: #993556; }
.bulle {
    max-width: 70%;
    padding: 10px 14px;
    border-radius: 14px;
    margin-bottom: 8px;
}
.bulle-moi {
    background-color: #e75480;
    color: white;
    margin-left: auto;
}
.bulle-autre {
    background-color: white;
    color: #333;
}
</style>
<body>
<div class="container mt-4" style="max-width: 700px;">
    <a href="messagerie.php" class="btn btn-secondary btn-sm mb-3">← Mes discussions</a>
    <h2><?= htmlspecialchars($annonceInfo['titre']) ?></h2>
    <p>Discussion avec <strong><?= htmlspecialchars($autreInfo['nom']) ?></strong></p>

    <div class="d-flex flex-column mb-3" style="background: rgba(255,255,255,0.6); border-radius: 12px; padding: 16px;">
        <?php foreach ($messages as $msg): ?>
            <div class="bulle <?= $msg['expediteur_id'] == $user_id ? 'bulle-moi' : 'bulle-autre' ?>">
                <?= nl2br(htmlspecialchars($msg['contenu'])) ?>
                <div style="font-size: 11px; opacity: 0.7;"><?= htmlspecialchars($msg['created_at']) ?></div>
            </div>
        <?php endforeach; ?>
        <?php if (empty($messages)): ?>
            <p class="text-muted">Aucun message pour l'instant. Lancez la discussion !</p>
        <?php endif; ?>
    </div>

    <form method="POST" class="d-flex gap-2">
        <textarea name="contenu" class="form-control" rows="2" placeholder="Écrire un message..." required></textarea>
        <button type="submit" name="envoyer" class="btn btn-primary">Envoyer</button>
    </form>
</div>
</body>
</html>