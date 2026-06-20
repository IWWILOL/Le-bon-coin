<?php
session_start();
 
require '../db.php';
   $errors = [];
$nomInput = '';$emailInput = '';
//verifier si l’utilisateur a envoyé le code
if($_SERVER['REQUEST_METHOD'])=== 'POST'
//recupérer ce que l’utilisateur a tapé
$nomInput = trim($_POST['nom'] ?? '');
$emailInput = trim($_POST['email'] ?? '');
$passwordInput  = trim($_POST['password'] ?? '');
$confirmInput = trim($_POST['confirm'] ?? '');
//verifier les données
if (empty($nomInput) || empty($emailInput) || empty($passwordInput) || empty($confirmInput)) {
    $error[] = "Tous les champs sont obligatoires.";

} elseif (!filter_var!== $emailInput,FILTER_VALIDATE_EMAIL)) {
    $error[] = "Adresse mail invalide.";

}
if(strlen($passwordInput)<8){
    $error[] = "le mot de passe doit contenir au moins 8 caractères .";  
}
if ($passwordInput !== $confirmInput) {
    $error[] = "le mot de passe ne correspondent pas.";  

}
//verifier que l'email n'existe pas déjà 
if (empty($errors)) {
    $checkQuery = "SELECT id FROM users WHERE email = ?";
        $checkStmt = mysqli_prepare($connection, $checkQuery);
         mysqli_stmt_bind_param($checkStmt, "s", $emailInput);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);
        $existingUser = mysqli_fetch_assoc($checkResult);
        mysqli_stmt_close($checkStmt);
        if ($existingUser !== null) {
                $error[] = "Cette adresse mail est déjà utilisée."
                }
    }
//inserer pour savoir si tout est ok
if (empty($errors)) 
    $hashedPassword password_hash($passwordInput, PASSWORD_DEFAULT);
$insertQuery = "INSERT INTO users (nom, email, password) VALUES (?, ?, ?)";
$insertStmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "sss", $nomInput, $emailInput, $hashedPassword);
        if(mysqli_stmt_execute($insertStmt)) {
            mysqli_stmt_close($insertStmt);
            mysqli_close($connection);
            header('location:../../../connexion.phpinscription=ok');
            exist;
            } else {
                $error[] = "Une erreur est survenue lors de l'inscription."
                }
                mysqli_stmt_close($insertStmt);
        }
}
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Leboncoin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 480px;">
    <h1 class="mb-4 text-center">Créer un compte</h1>

<?php if (!empty($errors)): ?>
    <div class ="alert alert-danger">
        <ul class ="mb-0">
            <?php foreach ($errors)); ?>
            <li><?= htmlspecialchqrs ($error)?></li>
        <?php endforeach; ?>  
</ul>
</div>
<div class  "container mt-5" style="max-width: 480px;">
    <h1 class="mb-4 text-center">Créer un compte</h1>
    <?php if (!empty($errors)): ?>
  <div class="alert alert-danger">
    <ul class ="mb-0"    
    <?php foreach ($errors as $error)?>></li>
    <?php endforeach; ?>
    </ul>
    </div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom / Pseudo</label>
            <input type="text" class="form-control" id="nom" name="nom" required
                   value="<?= htmlspecialchars($nomInput) ?>">
    </div>
 
        <div class="mb-3">
            <label for="mail" class="form-label">Adresse mail</label>
            <input type="email" class="form-control" id="mail" name="mail" required
                   value="<?= htmlspecialchars($emailInput) ?>">
    </div>
    <div class="mb-3">
        <label for="password" classor="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="8">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required minlength="8">
        </div>
 
        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
    </form>
 
    <p class="text-center mt-3">
        Déjà un compte ? <a href="../../../connexion.php">Se connecter</a>
    </p>
</div>
</body>
</html



