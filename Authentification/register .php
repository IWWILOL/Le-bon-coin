<?php
session_start();

require '../db.php';

$errors = [];
$nomInput = '';
$emailInput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nomInput = trim($_POST['nom'] ?? '');
    $emailInput = trim($_POST['mail'] ?? '');
    $passwordInput = trim($_POST['password'] ?? '');
    $confirmInput = trim($_POST['confirm_password'] ?? '');

    if (empty($nomInput) || empty($emailInput) || empty($passwordInput) || empty($confirmInput)) {
        $errors[] = "Tous les champs sont obligatoires.";
    }

    if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Adresse mail invalide.";
    }

    if (strlen($passwordInput) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    if ($passwordInput !== $confirmInput) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // Vérifier que l'email n'existe pas déjà (requête préparée, cf. cours backend 10.3)
    if (empty($errors)) {
        $checkQuery = "SELECT id FROM users WHERE email = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, "s", $emailInput);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);
        $existingUser = mysqli_fetch_assoc($checkResult);
        mysqli_stmt_close($checkStmt);

        if ($existingUser !== null) {
            $errors[] = "Cette adresse mail est déjà utilisée.";
        }
    }

    // Insertion si tout est ok
    if (empty($errors)) {
        $hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO users (nom, email, password) VALUES (?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "sss", $nomInput, $emailInput, $hashedPassword);

        if (mysqli_stmt_execute($insertStmt)) {
            mysqli_stmt_close($insertStmt);
            mysqli_close($conn);
            header('Location: connexion.php?inscription=ok');
            exit;
        } else {
            $errors[] = "Une erreur est survenue lors de l'inscription.";
        }
        mysqli_stmt_close($insertStmt);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Leboncoin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style ="background-color: #ffe4ec;">
    <nav class="navbar-expand-lg navbar-dark" style="background-color: #ef4c7d;">
        <div class="container-fluid">
    
      <a class="navbar-brand" href="#">Invader</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuNavbar">
                <a href="connexion.php" class="btn btn-light ms-auto">Se connecter</a>
            </div>
        </div>
    </nav>
 
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <form method="post" class="bg-white p-5 rounded shadow" style="width: 480px;">
 
            <h2 class="text-center mb-4">Créer un compte</h2>
 
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
 
            <div class="mb-3">
                <label class="form-label">Nom / Pseudo</label>
                <input type="text" class="form-control" name="nom" required
                       value="<?= htmlspecialchars($nomInput) ?>">
            </div>
 
            <div class="mb-3">
                <label class="form-label">Adresse mail</label>
                <input type="email" class="form-control" name="mail" required
                       value="<?= htmlspecialchars($emailInput) ?>">
            </div>
 
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" required minlength="8">
            </div>
 
            <div class="mb-4">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" name="confirm_password" required minlength="8">
            </div>
 
            <button type="submit" class="btn w-100" style="background-color: #e75480; color: white;">S'inscrire</button>
 
        </form>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
   